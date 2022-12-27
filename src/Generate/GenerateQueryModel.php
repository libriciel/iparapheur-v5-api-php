<?php

namespace IparapheurV5Client\Generate;

use Exception;

class GenerateQueryModel
{
    public function generate(array $openApiDefinition): array
    {
        return $this->getAllFile(
            $this->normalize($openApiDefinition)
        );
    }

    public function generateQueryModel(array $openApiDefinition): array
    {
        return $this->getQueryModelFile(
            $this->normalize($openApiDefinition)
        );
    }

    public function getTransType(string $inputType): string
    {
        $transtype = [
            'string' => 'string',
            'float' => 'float',
            'integer' => 'int',
            'boolean' => 'bool',
            'number' => 'float',
            'array' => 'array',
        ];
        return $transtype[
            $inputType
        ];
    }

    public function normalize(array $openApiDefinition): array
    {
        $result = [];
        foreach ($openApiDefinition['paths'] as $path => $pathProperties) {
            $queryStructure = new QueryStructure();
            $queryStructure->path = $path;
            foreach ($pathProperties as $method => $methodProperties) {
                $queryStructure->method = $method;
                $queryStructure->operationId = $methodProperties['operationId'];
                if (count($methodProperties['tags']) !== 1) {
                    throw new Exception("$path $method tag is not unique");
                }
                $queryStructure->tagName = $this->getTagInCamelCase($methodProperties['tags'][0]);
                if (isset($methodProperties['responses']['200']['content']['application/json']['schema']['$ref'])) {
                    $queryStructure->returnType = $this->extractDataTypeFromRef(
                        $methodProperties['responses']['200']['content']['application/json']['schema']['$ref']
                    );
                } elseif (
                    isset($methodProperties['responses']['200']['content']['application/pdf']) ||
                    isset($methodProperties['responses']['200']['content']['application/octet-stream']) ||
                    isset($methodProperties['responses']['200']['content']['text/plain'])
                ) {
                    $queryStructure->returnType = 'ResponseInterface';
                } elseif (
                    isset($methodProperties['responses']['200']['content']['application/json']['schema']['type'])
                ) {
                    $queryStructure->returnType = $this->getTransType(
                        $methodProperties['responses']['200']['content']['application/json']['schema']['type']
                    );
                } else {
                    $queryStructure->returnType = 'void';
                }
            }
            if (isset($methodProperties['parameters'])) {
                foreach ($methodProperties['parameters'] as $parameter) {
                    if ($parameter['in'] === 'path' && isset($parameter['schema']['type'])) {
                        $properties = new Properties();
                        $properties->name = $parameter['name'];
                        $properties->type = $parameter['schema']['type'];
                        $queryStructure->pathInput[] = $properties;
                    }
                    if ($parameter['in'] === 'path' && isset($parameter['schema']['$ref'])) {
                        $properties = new Properties();
                        $properties->name = $parameter['name'];
                        $properties->type = $this->extractDataTypeFromRef($parameter['schema']['$ref']);
                        $queryStructure->pathInput[] = $properties;
                    }
                    if ($parameter['in'] === 'query' && isset($parameter['schema']['type'])) {
                        $properties = new Properties();
                        $properties->name = $parameter['name'];
                        $properties->type = $this->getTransType($parameter['schema']['type']);
                        if ($parameter['schema']['type'] === 'array') {
                            $properties->subType = $this->getTransType($parameter['schema']['items']['type']);
                        }
                        $queryStructure->queryInput[] = $properties;
                    }
                }
            }
            if (isset($methodProperties['requestBody']['content']['application/json']['schema']['$ref'])) {
                $queryStructure->requestBodyType = $this->extractDataTypeFromRef(
                    $methodProperties['requestBody']['content']['application/json']['schema']['$ref']
                );
            }
            $result[$queryStructure->tagName][$queryStructure->operationId] = $queryStructure;
        }
        return $result;
    }

    private function getTagInCamelCase(string $input): string
    {
        return ucfirst(str_replace(' ', '', ucwords(str_replace('-', ' ', $input))));
    }

    private function getAllFile(array $input): array
    {
        $result = [];
        foreach ($input as $tagName => $tagProperties) {
            $content = "<?php\n\n" . 'namespace IparapheurV5Client\Api;' . "\n\n";
            $content .= "use IparapheurV5Client\GenericObjectApi;\n";
            $content .= "use IparapheurV5Client\Exception\IparapheurV5Exception;\n";
            $content .= "use Psr\Http\Message\ResponseInterface;\n";

            $addToModel = [];
            /**
             * @var QueryStructure $queryProperties
             */
            foreach ($tagProperties as $queryProperties) {
                if (! in_array($queryProperties->returnType, ['void', 'string', 'ResponseInterface', 'int'])) {
                    $addToModel[$queryProperties->returnType] = '';
                }
            }
            foreach ($tagProperties as $queryProperties) {
                foreach ($queryProperties->pathInput as $queryInputProperties) {
                    if (
                        ! in_array(
                            $queryInputProperties->type,
                            ['int','bool', 'string', 'ResponseInterface', 'array']
                        )
                    ) {
                        $addToModel[$queryInputProperties->type] = '';
                    }
                }
            }
            foreach (array_keys($addToModel) as $returnType) {
                $content .= 'use IparapheurV5Client\Model\\' . $returnType . ";\n";
            }
            foreach ($tagProperties as $queryProperties) {
                if ($queryProperties->queryInput) {
                    $type = ucfirst($queryProperties->operationId) . "Query";
                    $content .= 'use IparapheurV5Client\Model\\' . $type . ";\n";
                }
            }

            $content .= "\n";

            $content .= "class $tagName extends GenericObjectApi\n{\n";
            /**
             * @var QueryStructure $queryProperties
             */
            foreach ($tagProperties as $queryProperties) {
                $content .= "    public function {$queryProperties->operationId}(";
                foreach ($queryProperties->pathInput as $i => $property) {
                    if ($i !== 0) {
                        $content .= ",\n";
                    } else {
                        $content .= "\n";
                    }
                    $content .= "        " . $property->type . " \$" . $property->name ;
                }
                if ($queryProperties->queryInput) {
                    if ($queryProperties->pathInput) {
                        $content .= ",";
                    }
                    $type = ucfirst($queryProperties->operationId) . "Query";
                    $objectQueryName = "\${$queryProperties->operationId}Query";
                    $content .= "\n        $type $objectQueryName = null";
                } else {
                    $objectQueryName = null;
                }
                if ($queryProperties->pathInput || $queryProperties->queryInput) {
                    $content .= "\n    ";
                }
                $content .= "): {$queryProperties->returnType}";
                if ($queryProperties->pathInput || $queryProperties->queryInput) {
                    $content .= " {\n";
                } else {
                    $content .= "\n    {\n";
                }

                $path = preg_replace("#\{[^\}]*\}#", "%s", $queryProperties->path);
                $content .= "        \$path = sprintf(\n            \"$path\"";
                foreach ($queryProperties->pathInput as $i => $property) {
                    $content .= ",\n";
                    $content .= "            \$" . $property->name ;
                    if (! in_array($property->type, ['int','bool', 'string', 'ResponseInterface', 'array'])) {
                        $content .= "->value";
                    }
                }
                $content .= "\n        );\n";

                if ($queryProperties->method === 'get' && $queryProperties->returnType === 'ResponseInterface') {
                    $content .= "        return \$this->getRaw(\$path);\n";
                } elseif (
                    $queryProperties->method === 'get' &&
                    ! in_array($queryProperties->returnType, ['int', 'string', 'array'])
                ) {
                    $content .= "        return \$this->get(\$path";
                    $content .= ", {$queryProperties->returnType}::class";
                    if ($objectQueryName) {
                        $content .= ", $objectQueryName";
                    }
                    $content .= ");\n";
                } else {
                    $content .=
                        "        throw new IparapheurV5Exception('Method " .
                        $queryProperties->operationId .
                        " not implemented');\n";
                }
                $content .= "    }\n";
            }
            $content .= "}\n";
            $result[$tagName] = $content;
        }
        return $result;
    }

    private function extractDataTypeFromRef(string $ref): string
    {
        $tokens = explode('/', $ref);
        return trim(end($tokens));
    }

    private function getQueryModelFile(array $input): array
    {
        $result = [];
        foreach ($input as $tagProperties) {
            foreach ($tagProperties as $queryProperties) {
                if ($queryProperties->queryInput) {
                    $type = ucfirst($queryProperties->operationId) . "Query";
                    $content = "<?php\n\n" . 'namespace IparapheurV5Client\Model;' . "\n\n";
                    $content .= "class $type\n{\n";
                    /**
                     * @var  Properties $propertiesContent
                     */
                    foreach ($queryProperties->queryInput as $propertiesContent) {
                        if ($propertiesContent->subType !== null) {
                            $content .= "    /** @var {$propertiesContent->subType}[] */\n";
                        }
                        $content .= "    public {$propertiesContent->type} \${$propertiesContent->name};\n";
                    }
                    $content .= "}\n";
                    $result[$type] = $content;
                }
            }
        }
        return $result;
    }
}

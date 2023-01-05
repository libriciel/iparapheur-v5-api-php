<?php

namespace IparapheurV5Client\Generate;

use cebe\openapi\json\JsonPointer;
use cebe\openapi\Reader;
use cebe\openapi\spec\Parameter;
use cebe\openapi\spec\Reference;
use cebe\openapi\spec\Schema;
use IparapheurV5Client\Exception\IparapheurV5Exception;
use IparapheurV5Client\GenericObjectApi;
use PhpParser\Builder\Class_;
use PhpParser\Builder\Enum_;
use PhpParser\Builder\Property;
use PhpParser\BuilderFactory;
use PhpParser\Node;
use PhpParser\PrettyPrinter\Standard;

class GenerateClass
{
    private const DEFAULT_API_FILE_PATH = __DIR__ . "/../../openapi/iparapheur-5.0.4.json";
    private BuilderFactory $builderFactory;

    private string $openApiFilepath;

    public function __construct()
    {
        $this->builderFactory = new BuilderFactory();
        $this->setOpenApiFile(self::DEFAULT_API_FILE_PATH);
    }

    public function setOpenApiFile(string $openApiFilePath): void
    {
        $this->openApiFilepath = $openApiFilePath;
    }

    /**
     * @return string[]
     */
    public function generate(): array
    {
        $openApi = Reader::readFromJsonFile($this->openApiFilepath);

        $nodeList = [];
        if ($openApi->components !== null) {
            foreach ($openApi->components->schemas as $schemaName => $schema) {
                if ($schema instanceof Reference) {
                    throw new IparapheurV5Exception("Unable to process Reference in schema $schemaName");
                }
                $nodeList[ __DIR__ . "/../Model/$schemaName.php"] = $this->getClassFromSchema($schemaName, $schema);
            }
        }

        foreach ($openApi->paths as $path => $pathProperties) {
            foreach ($pathProperties->getOperations() as $method => $methodProperties) {
            }
        }


        $classProperties = [];
        $modelClass = [];
        foreach ($openApi->paths as $path => $pathProperties) {
            foreach ($pathProperties->getOperations() as $method => $methodProperties) {
                if (count($methodProperties->tags) !== 1) {
                    throw new IparapheurV5Exception("$path $method tag is not unique");
                }
                $tagName = $this->getTagInCamelCase($methodProperties->tags[0]);
                $classProperties[$tagName][$methodProperties->operationId] = [$path, $method,$methodProperties];
                foreach ($methodProperties->parameters as $parameter) {
                    if ($parameter instanceof Parameter && $parameter->in === 'query') {
                        $modelClass[$this->getTagInCamelCase($methodProperties->operationId) . "Query"][] = $parameter;
                    }
                }
            }
        }
        foreach ($modelClass as $operationId => $parameterList) {
            $nodeList[ __DIR__ . "/../Model/{$operationId}.php"] =
                $this->getQueryClass($operationId, $parameterList);
        }

        foreach ($classProperties as $tagName => $operations) {
            //$nodeList[ __DIR__ . "/../Api/$tagName.php"] = $this->getClassFromOperations($tagName, $operations);
        }

        $prettyPrinter = new Standard();
        $result = [];
        foreach ($nodeList as $filePath => $node) {
            $result[$filePath] = $prettyPrinter->prettyPrintFile(array($node));
        }
        return $result;
    }

    private function getTagInCamelCase(string $input): string
    {
        return ucfirst(str_replace(' ', '', ucwords(str_replace('-', ' ', $input))));
    }

    private function isNullable(string $class, string $properties): bool
    {
        $allNullable = [
            'FolderRepresentation' => ['dueDate'],
            'SubtypeDto' => [
                'creationWorkflowId',
                'workflowSelectionScript',
                'secureMailServerId',
                'sealCertificateId',
                'externalSignatureConfigId',
                'creationPermittedDeskIds',
                'filterableByDeskIds'
            ],
            'TypeDto' => ['signatureLocation', 'signatureZipCode'],
            'ExternalSignatureConfig' => ['login', 'password'],
        ];
        return isset($allNullable[$class]) && in_array($properties, $allNullable[$class]);
    }
    private function getClassFromSchema(string $schemaName, Schema $schema): Node
    {
        $namespace = $this->builderFactory->namespace('IparapheurV5Client\Model');
        $namespace->addStmt(
            match ($schema->type) {
                'string' => $this->getEnum($schemaName, $schema),
                'object' => $this->getClass($schemaName, $schema),
                default => throw new IparapheurV5Exception("Unknow type {$schema->type}")
            }
        );
        return $namespace->getNode();
    }

    private function getEnum(string $schemaName, Schema $schema): Enum_
    {
        $enum = $this->builderFactory
            ->enum($schemaName)
            ->setScalarType('string');
        foreach ($schema->enum as $data) {
            $enum->addStmt(
                $this->builderFactory
                    ->enumCase($data)
                    ->setValue($data)
            );
        }
        return $enum;
    }

    private function getClass(string $schemaName, Schema $schema): Class_
    {
        $class = $this->builderFactory->class($schemaName);
        foreach ($schema->properties as $attributeName => $attributeProperties) {
            if ($attributeProperties instanceof Reference) {
                throw new IparapheurV5Exception("Unable to process Reference in properties $attributeName");
            }
            $properties = $this->getType($schemaName, $attributeName, $attributeProperties);
            $class->addStmt(
                $properties
            );
        }
        return $class;
    }

    private function getType(string $schemaName, string $attributeName, Schema $attributeProperties): Property
    {
        // TODO a remplacer une fois que le parapheur aura des annotations "nullable"
        $nullable = $this->isNullable($schemaName, $attributeName);

        $properties = $this->builderFactory
            ->property($attributeName);

        $documentPosition = $attributeProperties->getDocumentPosition();
        $refType = $this->extractDataTypeFromRef($documentPosition);

        if ($refType !== $attributeName && $refType !== 'schema') {
            return $properties->setType($refType);
        }

        $type = $attributeProperties->type;
        if (in_array($type, ['string', 'float', 'integer', 'boolean', 'number'])) {
            if (
                $type === 'string' &&
                isset($attributeProperties->format) &&
                $attributeProperties->format === 'date-time'
            ) {
                return $properties->setType(($nullable ? '?' : '') . '\Datetime');
            }
            return $properties->setType(($nullable ? '?' : '') . $this->getTransType($type));
        }
        if ($attributeProperties->type === 'array' && $attributeProperties->items instanceof Schema) {
            $subtype = $attributeProperties->items->type;
            if ($attributeProperties->items->type === 'object') {
                $subtype = $this->extractDataTypeFromRef(
                    $attributeProperties->items->getDocumentPosition()
                );
            }
            $properties->setDocComment("/** @var {$subtype}[]" . ($nullable ? '|null' : '') . " */");
            $properties->setType(($nullable ? '?' : '') . 'array');
        }
        if ($attributeProperties->type === 'object' && $attributeProperties->additionalProperties instanceof Schema) {
            $subtype = $attributeProperties->additionalProperties->type;
            if ($attributeProperties->additionalProperties->type === 'object') {
                $subtype = $this->extractDataTypeFromRef(
                    $attributeProperties->additionalProperties->getDocumentPosition()
                );
            }
            $properties->setDocComment("/** @var {$subtype}[] */");
            $properties->setType('array');
        }
        return $properties;
    }

    private function extractDataTypeFromRef(string|JsonPointer|null $ref): string
    {
        if ($ref === null) {
            return "";
        }
        $tokens = explode('/', $ref);
        return trim(end($tokens));
    }

    /*private function getClassFromOperations(string $tagName, mixed $operations): Node
    {
        $class = $this->builderFactory->class($tagName);
        $class->extend('GenericObjectApi');

        $namespace = $this->builderFactory->namespace('IparapheurV5Client\Api');
        $namespace->addStmt($this->builderFactory->use(GenericObjectApi::class));
        $namespace->addStmt(
            $class
        );
        return $namespace->getNode();


        foreach ($operations->properties as $attributeName => $attributeProperties) {
            if ($attributeProperties instanceof Reference) {
                throw new IparapheurV5Exception("Unable to process Reference in properties $attributeName");
            }
            $properties = $this->getType($schemaName, $attributeName, $attributeProperties);
            $class->addStmt(
                $properties
            );
        }
    }*/

    /**
     * @param string $operationId
     * @param Parameter[] $parameterList
     */
    private function getQueryClass(string $operationId, array $parameterList): Node
    {
        $class = $this->builderFactory->class($operationId);
        foreach ($parameterList as $parameter) {
            if ($parameter->in !== 'query' || ! $parameter->schema instanceof Schema) {
                continue;
            }
            $property = $this->getType($operationId, $parameter->name, $parameter->schema);

            $class->addStmt($property);
        }

        $namespace = $this->builderFactory->namespace('IparapheurV5Client\Model');
        $namespace->addStmt(
            $class
        );
        return $namespace->getNode();
    }

    private function getTransType(string $type): string
    {
        $transtype = [
            'string' => 'string',
            'float' => 'float',
            'integer' => 'int',
            'boolean' => 'bool',
            'number' => 'float'
        ];
        return $transtype[$type];
    }
}

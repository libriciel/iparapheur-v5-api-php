<?php

namespace IparapheurV5Client\Generate;

use cebe\openapi\exceptions\IOException;
use cebe\openapi\exceptions\TypeErrorException;
use cebe\openapi\exceptions\UnresolvableReferenceException;
use cebe\openapi\json\InvalidJsonPointerSyntaxException;
use cebe\openapi\json\JsonPointer;
use cebe\openapi\Reader;
use cebe\openapi\spec\Reference;
use cebe\openapi\spec\Schema;
use IparapheurV5Client\Exception\IparapheurV5Exception;
use PhpParser\Builder\Class_;
use PhpParser\Builder\Enum_;
use PhpParser\Builder\Property;
use PhpParser\BuilderFactory;
use PhpParser\Node;
use PhpParser\PrettyPrinter\Standard;

class GenerateClass
{
    private const DEFAULT_API_FILE_PATH = __DIR__ . '/../../openapi/iparapheur-5.0.20.json';
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
     * @throws IparapheurV5Exception
     * @throws IOException
     * @throws TypeErrorException
     * @throws UnresolvableReferenceException
     * @throws InvalidJsonPointerSyntaxException
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
                $nodeList[$schemaName] = $this->getClassFromSchema($schemaName, $schema);
            }
        }
        $prettyPrinter = new Standard();
        $result = [];
        foreach ($nodeList as $schemaName => $node) {
            $result[__DIR__ . "/../Model/$schemaName.php"] = $prettyPrinter->prettyPrintFile([$node]);
        }
        return $result;
    }

    /**
     * @throws IparapheurV5Exception
     */
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

    /**
     * @throws IparapheurV5Exception
     */
    private function getClass(string $schemaName, Schema $schema): Class_
    {
        $class = $this->builderFactory->class($schemaName);
        foreach ($schema->properties as $attributeName => $attributeProperties) {
            if ($attributeProperties instanceof Reference) {
                throw new IparapheurV5Exception("Unable to process Reference in properties $attributeName");
            }
            $properties = $this->getType($attributeName, $attributeProperties);
            $class->addStmt($properties);
        }
        return $class;
    }

    private function getType(string $attributeName, Schema $attributeProperties): Property
    {
        $nullable = $attributeProperties->nullable;

        $properties = $this->builderFactory
            ->property($attributeName);

        $documentPosition = $attributeProperties->getDocumentPosition();
        $refType = $this->extractDataTypeFromRef($documentPosition);

        if ($refType !== $attributeName) {
            return $properties->setType($refType);
        }


        $type = $attributeProperties->type;
        if (\in_array($type, ['string', 'float', 'integer', 'boolean', 'number'], true)) {
            $transtype = [
                'string' => 'string',
                'float' => 'float',
                'integer' => 'int',
                'boolean' => 'bool',
                'number' => 'float',
            ];
            if (
                $type === 'string' &&
                isset($attributeProperties->format) &&
                $attributeProperties->format === 'date-time'
            ) {
                return $properties->setType(($nullable ? '?' : '') . '\Datetime');
            }
            return $properties->setType(($nullable ? '?' : '') . $transtype[$type]);
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
            return '';
        }
        $tokens = explode('/', $ref);
        return trim(end($tokens));
    }
}

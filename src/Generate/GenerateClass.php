<?php

namespace IparapheurV5Client\Generate;

use cebe\openapi\Reader;
use cebe\openapi\spec\Schema;
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
        foreach ($openApi->components->schemas as $schemaName => $schema) {
            $nodeList[$schemaName] = $this->getClassFromSchema($schemaName, $schema);
        }
        $prettyPrinter = new Standard();
        $result = [];
        foreach ($nodeList as $schemaName => $node) {
            $result[ __DIR__ . "/../Model/$schemaName.php"] = $prettyPrinter->prettyPrintFile(array($node));
        }
        return $result;
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
                'object' => $this->getClass($schemaName, $schema)
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

        $refType = $this->extractDataTypeFromRef($attributeProperties->getDocumentPosition());

        if ($refType !== $attributeName) {
            return $properties->setType($refType);
        }

        $type = $attributeProperties->type;
        if (in_array($type, ['string', 'float', 'integer', 'boolean', 'number'])) {
            $transtype = [
                'string' => 'string',
                'float' => 'float',
                'integer' => 'int',
                'boolean' => 'bool',
                'number' => 'float'
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
        if ($attributeProperties->type === 'array') {
            $subtype = $attributeProperties->items->type;
            if ($attributeProperties->items->type === 'object') {
                $subtype = $this->extractDataTypeFromRef(
                    $attributeProperties->items->getDocumentPosition()
                );
            }
            $properties->setDocComment("/** @var {$subtype}[]" . ($nullable ? '|null' : '') . " */");
            $properties->setType(($nullable ? '?' : '') . 'array');
        }
        if ($attributeProperties->type === 'object') {
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

    private function extractDataTypeFromRef(string $ref): string
    {
        $tokens = explode('/', $ref);
        return trim(end($tokens));
    }
}

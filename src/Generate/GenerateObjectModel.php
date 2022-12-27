<?php

namespace IparapheurV5Client\Generate;

use Exception;
use RuntimeException;

class GenerateObjectModel
{
    public function generate(array $openApiDefinition): array
    {
        return $this->getAllFile(
            $this->fixAllParapheurLies(
                $this->normalize($openApiDefinition)
            )
        );
    }

    private function fixAllParapheurLies(array $result): array
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
            'ExternalSignatureConfig' => ['login','password'],
        ];

        foreach ($allNullable as $structureName => $nullables) {
            foreach ($nullables as $nullable) {
                $origType = $result[$structureName]->properties[$nullable]->type;
                $result[$structureName]->properties[$nullable]->type = '?' . $origType;
                if ($result[$structureName]->properties[$nullable]->subType !== null) {
                    $result[$structureName]->properties[$nullable]->subType .= "|null";
                }
            }
        }
        return $result;
    }

    private function normalize(array $openApiDefinition): array
    {
        $result = [];
        foreach ($openApiDefinition['components']['schemas'] as $dtoId => $dtoContent) {
            $structure = new Structure();
            $structure->structureName = $dtoId;
            if ($dtoContent['type'] === 'string' && isset($dtoContent['enum'])) {
                $structure->structureType = 'enum';
                $structure->properties = [];
                foreach ($dtoContent['enum'] as $item) {
                    $properties = new Properties();
                    $properties->type = 'string';
                    $properties->name = $item;
                    $structure->properties[] = $properties;
                }
            } elseif ($dtoContent['type'] === 'object') {
                $structure->structureType = 'class';
                foreach ($dtoContent['properties'] as $propertyId => $propertyContent) {
                    $properties = new Properties();
                    $properties->name = $propertyId;
                    if (isset($propertyContent['type'])) {
                        $type = $propertyContent['type'];
                        if (in_array($type, ['string', 'float', 'integer','boolean', 'number'])) {
                            $transtype = [
                                'string' => 'string',
                                'float' => 'float',
                                'integer' => 'int',
                                'boolean' => 'bool',
                                'number' => 'float'
                            ];
                            if (
                                $type === 'string' &&
                                isset($propertyContent['format']) &&
                                $propertyContent['format'] === 'date-time'
                            ) {
                                $properties->type = '\Datetime';
                            } else {
                                $properties->type = $transtype[$type];
                            }
                        } elseif ($type === 'array' && isset($propertyContent['items']['$ref'])) {
                            $trueType = $this->extractDataTypeFromRef($propertyContent['items']['$ref']);
                            $properties->type = 'array';
                            $properties->subType = $trueType . '[]';
                        } elseif ($type === 'array' && isset($propertyContent['items']['type'])) {
                            $type = $propertyContent['items']['type'];
                            $properties->type = 'array';
                            $properties->subType = $type . '[]';
                        } elseif ($type === 'object' && isset($propertyContent['additionalProperties']['$ref'])) {
                            $trueType = $this->extractDataTypeFromRef($propertyContent['additionalProperties']['$ref']);
                            $properties->type = 'array';
                            $properties->subType = $trueType . '[]';
                        } elseif ($type === 'object' && isset($propertyContent['additionalProperties']['type'])) {
                            $type = $propertyContent['additionalProperties']['type'];
                            $properties->type = 'array';
                            $properties->subType = $type . '[]';
                        } else {
                            throw new RuntimeException("Unknown type $type for $dtoId");
                        }
                    } elseif (isset($propertyContent['$ref'])) {
                        $type = $propertyContent['$ref'];
                        $type = $this->extractDataTypeFromRef($type);
                        $properties->type = $type;
                    } else {
                        throw new RuntimeException("No type for $dtoId");
                    }
                    $structure->properties[$propertyId] = $properties;
                }
            } else {
                throw new RuntimeException("Unknow type for $dtoId");
            }
            $result[$dtoId] = $structure;
        }
        return $result;
    }

    private function getAllFile(array $input): array
    {
        $result = [];
        /**
         * @var  string $structureId
         * @var  Structure $structureContent
         */
        foreach ($input as $structureId => $structureContent) {
            $content = "<?php\n\n" . 'namespace IparapheurV5Client\Model;' . "\n\n";
            if ($structureContent->structureType === 'enum') {
                $content .= "enum $structureId: string\n{\n";
                foreach ($structureContent->properties as $propertiesContent) {
                    $content .= "    case {$propertiesContent->name} = '{$propertiesContent->name}';\n";
                }
                $content .= "}\n";
            } else {
                $content .= "class $structureId\n{\n";
                /**
                 * @var  Properties $propertiesContent
                 */
                foreach ($structureContent->properties as $propertiesContent) {
                    if ($propertiesContent->subType !== null) {
                        $content .= "    /** @var {$propertiesContent->subType} */\n";
                    }
                    $content .= "    public {$propertiesContent->type} \${$propertiesContent->name};\n";
                }
                $content .= "}\n";
            }
            $result[$structureId] = $content;
        }
        return $result;
    }

    private function extractDataTypeFromRef(string $ref): string
    {
        $tokens = explode('/', $ref);
        return trim(end($tokens));
    }
}

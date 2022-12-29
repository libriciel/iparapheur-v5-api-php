<?php

namespace IparapheurV5Client\Tests\Generate;

use IparapheurV5Client\Exception\IparapheurV5Exception;
use IparapheurV5Client\Generate\GenerateQueryModel;
use PHPUnit\Framework\TestCase;

class GenerateQueryModelTest extends TestCase
{
    public function testGenerate(): void
    {
        $jsonContent = json_decode(
            file_get_contents(__DIR__ . "/../../openapi/iparapheur-5.0.4.json") ?: "",
            true,
            512,
            JSON_THROW_ON_ERROR
        );
        if (! is_array($jsonContent)) {
            throw new IparapheurV5Exception("Unable to decode openapi file");
        }
        $generate = new GenerateQueryModel();
        $result = $generate->generate($jsonContent);
        foreach ($result as $structureId => $fileContent) {
            self::assertStringEqualsFile(__DIR__ . "/../../src/Api/{$structureId}.php", $fileContent);
        }
    }

    public function testGenerateQueryModel(): void
    {
        $jsonContent = json_decode(
            file_get_contents(__DIR__ . "/../../openapi/iparapheur-5.0.4.json") ?: "",
            true,
            512,
            JSON_THROW_ON_ERROR
        );
        if (! is_array($jsonContent)) {
            throw new IparapheurV5Exception("Unable to decode openapi file");
        }
        $generate = new GenerateQueryModel();
        $result = $generate->generateQueryModel($jsonContent);
        foreach ($result as $structureId => $fileContent) {
            self::assertStringEqualsFile(__DIR__ . "/../../src/Model/{$structureId}.php", $fileContent);
        }
    }
}

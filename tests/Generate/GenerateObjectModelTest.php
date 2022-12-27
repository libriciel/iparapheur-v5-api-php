<?php

namespace IparapheurV5Client\Tests\Generate;

use IparapheurV5Client\Exception\IparapheurV5Exception;
use IparapheurV5Client\Generate\GenerateObjectModel;
use PHPUnit\Framework\TestCase;

class GenerateObjectModelTest extends TestCase
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
        $generate = new GenerateObjectModel();
        $result = $generate->generate($jsonContent);
        //file_put_contents(__DIR__ . "/fixtures/result.json",json_encode($result));
        //self::assertJsonStringEqualsJsonFile(__DIR__ . "/fixtures/result.json", json_encode($result));
        foreach ($result as $structureId => $fileContent) {
            self::assertStringEqualsFile(__DIR__ . "/../../src/Model/{$structureId}.php", $fileContent);
        }
    }
}

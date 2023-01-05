<?php

namespace IparapheurV5Client\Tests\Generate;

use cebe\openapi\Reader;
use IparapheurV5Client\Generate\GenerateClass;
use PHPUnit\Framework\TestCase;

class GenerateClassTest extends TestCase
{
    public function testGenerate(): void
    {
        foreach ((new GenerateClass())->generate() as $structureId => $fileContent) {
            if (file_exists($structureId)) {
                self::assertStringEqualsFile($structureId, $fileContent);
            }
        }
    }
}

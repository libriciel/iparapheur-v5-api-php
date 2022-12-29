<?php

namespace IparapheurV5Client\Generate;

use cebe\openapi\spec\OpenApi;

class GenerateClass
{
    public function generate(OpenApi $openApi): array
    {
        $result = [];
        foreach ($openApi->components->schemas as $schemaName => $schema) {
            $result[$schemaName] = "";
        }
        return $result;
    }
}

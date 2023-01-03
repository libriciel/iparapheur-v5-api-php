<?php

namespace IparapheurV5Client\Model;

class DetachedSignature
{
    public string $id;
    public string $name;
    public int $contentLength;
    public MediaType $mediaType;
    public string $targetDocumentId;
    public string $targetTaskId;
}
<?php

namespace IparapheurV5Client\Model;

class ExternalSignatureParams
{
    public string $publicAnnotation;
    public string $privateAnnotation;
    /** @var string[] */
    public array $metadata;
    public string $name;
    public string $folderId;
    /** @var SignRequestMember[] */
    public array $members;
    /** @var PdfSignaturePosition[] */
    public array $documentIdsToSignaturePlacementMapping;
    /** @var ExternalSignatureFileWrapper[] */
    public array $fileWrappers;
}
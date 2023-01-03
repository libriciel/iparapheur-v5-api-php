<?php

namespace IparapheurV5Client\Model;

class DocumentDto
{
    public string $id;
    public string $name;
    public int $index;
    public int $contentLength;
    public MediaType $mediaType;
    public string $pdfVisualId;
    /** @var SignaturePlacement[] */
    public array $signaturePlacementAnnotations;
    /** @var PdfSignaturePosition[] */
    public array $signatureTags;
    /** @var PdfSignaturePosition[] */
    public array $sealTags;
    /** @var DetachedSignature[] */
    public array $detachedSignatures;
    public bool $deletable;
    public bool $isMainDocument;
}
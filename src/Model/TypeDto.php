<?php

namespace IparapheurV5Client\Model;

class TypeDto
{
    public string $id;
    public string $name;
    public string $description;
    public SignatureFormat $signatureFormat;
    public SignatureProtocol $protocol;
    public bool $signatureVisible;
    public PdfSignaturePosition $signaturePosition;
    public ?string $signatureLocation;
    public ?string $signatureZipCode;
}
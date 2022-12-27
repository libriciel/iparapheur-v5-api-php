<?php

namespace IparapheurV5Client\Model;

class SealCertificateDto
{
    public string $id;
    public string $name;
    public \Datetime $expirationDate;
    public int $usageCount;
    public string $signatureImageContentId;
}

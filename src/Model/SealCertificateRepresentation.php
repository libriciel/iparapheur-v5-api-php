<?php

namespace IparapheurV5Client\Model;

class SealCertificateRepresentation
{
    public string $id;
    public string $name;
    public \Datetime $expirationDate;
    public int $usageCount;
}

<?php

namespace IparapheurV5Client\Model;

class SignatureTaskParams
{
    public string $publicAnnotation;
    public string $privateAnnotation;
    /** @var string[] */
    public array $metadata;
    public string $certificateBase64;
    /** @var DocumentDataToSignHolder[] */
    public array $dataToSignHolderList;
}
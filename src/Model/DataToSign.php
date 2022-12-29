<?php

namespace IparapheurV5Client\Model;

class DataToSign
{
    public string $id;
    public string $digestBase64;
    public string $dataToSignBase64;
    public string $signatureValue;
}
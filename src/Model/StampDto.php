<?php

namespace IparapheurV5Client\Model;

class StampDto
{
    public string $id;
    public int $page;
    public int $x;
    public int $y;
    public int $signatureRank;
    public bool $afterSignature;
    public StampType $type;
    public string $value;
    public int $fontSize;
    public StampTextColor $textColor;
}

<?php

namespace IparapheurV5Client\Model;

class LayerDto
{
    public string $id;
    public string $name;
    /** @var StampDto[] */
    public array $stampList;
}
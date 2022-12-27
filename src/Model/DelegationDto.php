<?php

namespace IparapheurV5Client\Model;

class DelegationDto
{
    public string $id;
    public string $substituteDeskId;
    public DeskRepresentation $substituteDesk;
    public string $delegatingDeskId;
    public DeskRepresentation $delegatingDesk;
    public string $typeId;
    public TypologyRepresentation $type;
    public string $subtypeId;
    public TypologyRepresentation $subtype;
    public \Datetime $start;
    public \Datetime $end;
}

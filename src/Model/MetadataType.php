<?php

namespace IparapheurV5Client\Model;

enum MetadataType: string
{
    case TEXT = 'TEXT';
    case DATE = 'DATE';
    case INTEGER = 'INTEGER';
    case FLOAT = 'FLOAT';
    case BOOLEAN = 'BOOLEAN';
    case URL = 'URL';
}

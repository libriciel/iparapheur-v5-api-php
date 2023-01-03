<?php

namespace IparapheurV5Client\Model;

enum StampType : string
{
    case SIGNATURE = 'SIGNATURE';
    case TEXT = 'TEXT';
    case IMAGE = 'IMAGE';
    case METADATA = 'METADATA';
}
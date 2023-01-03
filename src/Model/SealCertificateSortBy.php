<?php

namespace IparapheurV5Client\Model;

enum SealCertificateSortBy : string
{
    case NAME = 'NAME';
    case ID = 'ID';
    case EXPIRATION_DATE = 'EXPIRATION_DATE';
}
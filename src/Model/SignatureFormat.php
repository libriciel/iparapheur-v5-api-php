<?php

namespace IparapheurV5Client\Model;

enum SignatureFormat : string
{
    case PKCS7 = 'PKCS7';
    case PADES = 'PADES';
    case PES_V2 = 'PES_V2';
    case XADES_DETACHED = 'XADES_DETACHED';
    case AUTO = 'AUTO';
}
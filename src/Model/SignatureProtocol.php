<?php

namespace IparapheurV5Client\Model;

enum SignatureProtocol: string
{
    case HELIOS = 'HELIOS';
    case ACTES = 'ACTES';
    case NONE = 'NONE';
}

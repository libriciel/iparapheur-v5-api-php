<?php

namespace IparapheurV5Client\Model;

enum ExternalState : string
{
    case FORM = 'FORM';
    case ACTIVE = 'ACTIVE';
    case SIGNED = 'SIGNED';
    case REFUSED = 'REFUSED';
    case EXPIRED = 'EXPIRED';
    case CREATED = 'CREATED';
    case IN_REDACTION = 'IN_REDACTION';
    case DELETED = 'DELETED';
    case SENT = 'SENT';
    case SENT_AGAIN = 'SENT_AGAIN';
    case RECEIVED_PARTIALLY = 'RECEIVED_PARTIALLY';
    case RECEIVED = 'RECEIVED';
    case NOT_RECEIVED = 'NOT_RECEIVED';
    case ERROR = 'ERROR';
}
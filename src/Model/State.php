<?php

namespace IparapheurV5Client\Model;

enum State : string
{
    case DRAFT = 'DRAFT';
    case LATE = 'LATE';
    case FINISHED = 'FINISHED';
    case CURRENT = 'CURRENT';
    case PENDING = 'PENDING';
    case DELEGATED = 'DELEGATED';
    case VALIDATED = 'VALIDATED';
    case RETRIEVABLE = 'RETRIEVABLE';
    case UPCOMING = 'UPCOMING';
    case REJECTED = 'REJECTED';
    case TRANSFERRED = 'TRANSFERRED';
    case SECONDED = 'SECONDED';
    case BYPASSED = 'BYPASSED';
    case DOWNSTREAM = 'DOWNSTREAM';
}
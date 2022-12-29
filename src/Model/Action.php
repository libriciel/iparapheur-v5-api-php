<?php

namespace IparapheurV5Client\Model;

enum Action: string
{
    case VISA = 'VISA';
    case SEAL = 'SEAL';
    case SIGNATURE = 'SIGNATURE';
    case PAPER_SIGNATURE = 'PAPER_SIGNATURE';
    case REJECT = 'REJECT';
    case EXTERNAL_SIGNATURE = 'EXTERNAL_SIGNATURE';
    case SECURE_MAIL = 'SECURE_MAIL';
    case IPNG = 'IPNG';
    case IPNG_RETURN = 'IPNG_RETURN';
    case UNDO = 'UNDO';
    case TRANSFER = 'TRANSFER';
    case SECOND_OPINION = 'SECOND_OPINION';
    case ASK_SECOND_OPINION = 'ASK_SECOND_OPINION';
    case CREATE = 'CREATE';
    case START = 'START';
    case ARCHIVE = 'ARCHIVE';
    case CHAIN = 'CHAIN';
    case RECYCLE = 'RECYCLE';
    case DELETE = 'DELETE';
    case BYPASS = 'BYPASS';
    case UPDATE = 'UPDATE';
    case READ = 'READ';
    case UNKNOWN = 'UNKNOWN';
}

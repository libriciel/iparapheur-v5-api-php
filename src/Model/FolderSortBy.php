<?php

namespace IparapheurV5Client\Model;

enum FolderSortBy : string
{
    case VALIDATION_START_DATE = 'VALIDATION_START_DATE';
    case CREATION_DATE = 'CREATION_DATE';
    case STILL_SINCE_DATE = 'STILL_SINCE_DATE';
    case LATE_DATE = 'LATE_DATE';
    case END_DATE = 'END_DATE';
    case TASK_ID = 'TASK_ID';
    case FOLDER_ID = 'FOLDER_ID';
    case FOLDER_NAME = 'FOLDER_NAME';
    case TYPE_ID = 'TYPE_ID';
    case TYPE_NAME = 'TYPE_NAME';
    case SUBTYPE_ID = 'SUBTYPE_ID';
    case SUBTYPE_NAME = 'SUBTYPE_NAME';
    case ACTION_TYPE = 'ACTION_TYPE';
}
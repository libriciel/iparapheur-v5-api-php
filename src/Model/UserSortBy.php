<?php

namespace IparapheurV5Client\Model;

enum UserSortBy : string
{
    case USERNAME = 'USERNAME';
    case ID = 'ID';
    case FIRST_NAME = 'FIRST_NAME';
    case LAST_NAME = 'LAST_NAME';
    case EMAIL = 'EMAIL';
}
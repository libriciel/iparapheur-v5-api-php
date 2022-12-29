<?php

namespace IparapheurV5Client\Model;

enum TemplateType: string
{
    case MAIL_NOTIFICATION_SINGLE = 'MAIL_NOTIFICATION_SINGLE';
    case MAIL_NOTIFICATION_DIGEST = 'MAIL_NOTIFICATION_DIGEST';
    case MAIL_ACTION_SEND = 'MAIL_ACTION_SEND';
    case DOCKET = 'DOCKET';
}

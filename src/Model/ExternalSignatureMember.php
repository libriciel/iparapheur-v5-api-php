<?php

namespace IparapheurV5Client\Model;

class ExternalSignatureMember
{
    public string $id;
    public string $firstName;
    public string $lastName;
    public string $email;
    public string $phone;
    public string $refusalReason;
    public \Datetime $startedAt;
    public \Datetime $finishedAt;
}
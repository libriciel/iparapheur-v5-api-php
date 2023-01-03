<?php

namespace IparapheurV5Client\Model;

class ErrorResponse
{
    public string $timestamp;
    public int $status;
    public string $error;
    public string $message;
    public string $path;
}
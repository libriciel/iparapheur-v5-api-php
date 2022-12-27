<?php

namespace IparapheurV5Client\Model;

enum StepDefinitionParallelType: string
{
    case OR = 'OR';
    case AND = 'AND';
}

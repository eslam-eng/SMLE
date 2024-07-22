<?php

namespace SLIM\Abbreviation\Service;
use  SLIM\Support\Services\BaseCrudService;

use  SLIM\Abbreviation\Interfaces\AbbreviationRepositoryInterface;
use  SLIM\Abbreviation\Interfaces\AbbreviationServiceInterface;

class AbbreviationService extends BaseCrudService implements AbbreviationServiceInterface
{
    protected function getRepositoryClass(): string
    {
        return  AbbreviationRepositoryInterface::class;
    }
}

<?php

namespace SLIM\Subspecialties\Service;
use  SLIM\Support\Services\BaseCrudService;

use  SLIM\Subspecialties\Interfaces\SubSpecializationServiceInterface;
use  SLIM\Subspecialties\Interfaces\SubSpecializationRepositoryInterface;

class SubSpecializationService extends BaseCrudService implements SubSpecializationServiceInterface
{
    protected function getRepositoryClass(): string
    {
        return  SubSpecializationRepositoryInterface::class;
    }
}

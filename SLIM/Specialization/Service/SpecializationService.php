<?php

namespace SLIM\Specialization\Service;
use  SLIM\Support\Services\BaseCrudService;

use  SLIM\Specialization\Interfaces\SpecializationServiceInterface;
use  SLIM\Specialization\Interfaces\SpecializationRepositoryInterface;

class SpecializationService extends BaseCrudService implements SpecializationServiceInterface
{
    protected function getRepositoryClass(): string
    {
        return  SpecializationRepositoryInterface::class;
    }
}

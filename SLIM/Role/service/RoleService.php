<?php


namespace SLIM\Role\service;


use SLIM\Role\Interfaces\RoleRepositoryInterface;
use SLIM\Role\Interfaces\RoleServiceInterface;
use SLIM\Support\Services\BaseCrudService;

class RoleService extends BaseCrudService implements RoleServiceInterface
{

    /**
     * @inheritDoc
     */
    protected function getRepositoryClass(): string
    {
        return RoleRepositoryInterface::class;

    }
}

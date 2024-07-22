<?php


namespace SLIM\Permission\Service;


use SLIM\Permission\Interfaces\PermissionRepositoryInterface;
use SLIM\Permission\Interfaces\PermissionServiceInterface;
use SLIM\Support\Services\BaseCrudService;

class PermissionService extends  BaseCrudService implements PermissionServiceInterface
{

    /**
     * @inheritDoc
     */
    protected function getRepositoryClass(): string
    {
       return  PermissionRepositoryInterface::class;
    }
}

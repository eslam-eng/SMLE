<?php


namespace SLIM\Admin\service;


use SLIM\Admin\interfaces\AdminRepositoryInterface;
use SLIM\Admin\interfaces\AdminServiceInterface;
use SLIM\Support\Services\BaseCrudService;

class AdminService extends BaseCrudService implements  AdminServiceInterface
{

    /**
     * @inheritDoc
     */
    protected function getRepositoryClass(): string
    {
       return  AdminRepositoryInterface::class;
    }
}

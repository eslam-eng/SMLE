<?php
namespace SLIM\Category\Service;

use SLIM\Category\Interfaces\CategoryRepositoryInterface;
use SLIM\Support\Services\BaseCrudService;
use  SLIM\Category\Interfaces\CategoryServiceInterfaces;

class CategoryService extends  BaseCrudService implements CategoryServiceInterfaces
{
    /**
     * @inheritDoc
     */
    protected function getRepositoryClass(): string
    {
      return CategoryRepositoryInterface::class;
    }
}

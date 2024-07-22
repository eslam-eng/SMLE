<?php


namespace SLIM\Permission\Repository;


use SLIM\Permission\Interfaces\PermissionRepositoryInterface;
use SLIM\Support\Repositories\BaseRepository;
use Spatie\Permission\Models\Permission;

class PermissionRepository extends BaseRepository implements PermissionRepositoryInterface
{

    /**
     * @inheritDoc
     */
    protected function getModelClass(): string
    {
       return Permission::class;
    }
}

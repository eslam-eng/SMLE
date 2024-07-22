<?php


namespace SLIM\Role\Repository;


use SLIM\Role\Interfaces\RoleRepositoryInterface;
use SLIM\Support\Repositories\BaseRepository;
use Spatie\Permission\Models\Role;

class RoleRepository extends  BaseRepository implements RoleRepositoryInterface
{

    /**
     * @inheritDoc
     */
    protected function getModelClass(): string
    {
       return Role::class;

    }
}

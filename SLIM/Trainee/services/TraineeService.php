<?php


namespace SLIM\Trainee\services;


use SLIM\Trainee\interfaces\TraineeRepositoryInterface;
use SLIM\Trainee\interfaces\TraineeServiceInterface;
use SLIM\Support\Services\BaseCrudService;

class TraineeService extends BaseCrudService implements TraineeServiceInterface
{

    /**
     * @inheritDoc
     */
    protected function getRepositoryClass(): string
    {
        return  TraineeRepositoryInterface::class;
    }
}

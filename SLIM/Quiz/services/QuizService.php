<?php

namespace SLIM\Quiz\services;

use SLIM\Quiz\interfaces\QuizRepositoryInterface;
use SLIM\Quiz\interfaces\QuizServiceInterface;
use SLIM\Support\Services\BaseCrudService;

class QuizService extends BaseCrudService implements QuizServiceInterface
{

    /**
     * @inheritDoc
     */
    protected function getRepositoryClass(): string
    {
        return QuizRepositoryInterface::class;
    }
}

<?php

namespace SLIM\Question\services;

use SLIM\Question\interfaces\QuestionRepositoryInterface;
use SLIM\Question\interfaces\QuestionServiceInterface;
use SLIM\Support\Services\BaseCrudService;

class QuestionService extends BaseCrudService implements QuestionServiceInterface
{

    /**
     * @inheritDoc
     */
    protected function getRepositoryClass(): string
    {
        return QuestionRepositoryInterface::class;
    }
}

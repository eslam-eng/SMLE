<?php

namespace SLIM\Question\services;

use SLIM\Question\interfaces\QuestionSuggestRepositoryInterface;
use SLIM\Question\interfaces\QuestionSuggestServiceInterface;
use SLIM\Support\Services\BaseCrudService;

class QuestionSuggestService extends BaseCrudService implements QuestionSuggestServiceInterface
{

    /**
     * @inheritDoc
     */
    protected function getRepositoryClass(): string
    {
        return QuestionSuggestRepositoryInterface::class;
    }
}

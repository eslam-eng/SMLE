<?php

namespace SLIM\Question\services;

use SLIM\Question\interfaces\QuestionNoteRepositoryInterface;
use SLIM\Question\interfaces\QuestionNoteServiceInterface;
use SLIM\Support\Services\BaseCrudService;

class QuestionNoteService extends BaseCrudService implements QuestionNoteServiceInterface
{

    /**
     * @inheritDoc
     */
    protected function getRepositoryClass(): string
    {
        return QuestionNoteRepositoryInterface::class;
    }
}

<?php


namespace SLIM\Notification\Service;


use SLIM\Notification\Interfaces\NotificationRepositoryInterface;
use SLIM\Notification\Interfaces\NotificationServiceInterface;
use SLIM\Support\Services\BaseCrudService;

class NotificationService extends BaseCrudService implements NotificationServiceInterface
{

    /**
     * @inheritDoc
     */
    protected function getRepositoryClass(): string
    {
        return NotificationRepositoryInterface::class;

    }
}

<?php


namespace SLIM\Notification\Repository;


use SLIM\Notification\App\Models\Notification;
use SLIM\Notification\Interfaces\NotificationRepositoryInterface;
use SLIM\Support\Repositories\BaseRepository;

class NotificationRepository extends BaseRepository implements NotificationRepositoryInterface
{

    /**
     * @inheritDoc
     */
    protected function getModelClass(): string
    {
        return Notification::class;
    }
}

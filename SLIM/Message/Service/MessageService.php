<?php
namespace SLIM\Message\Service;

use SLIM\Support\Services\BaseCrudService;
use  SLIM\Message\Interfaces\MessageServiceInterfaces;
use  SLIM\Message\Interfaces\MessageRepositoryInterface;

class MessageService extends  BaseCrudService implements MessageServiceInterfaces
{
    /**
     * @inheritDoc
     */
    protected function getRepositoryClass(): string
    {
      return MessageRepositoryInterface::class;
    }
}

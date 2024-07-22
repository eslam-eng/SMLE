<?php


namespace SLIM\Payment\Service;


use SLIM\Payment\Interfaces\PaymentRepositoryInterfaces;
use SLIM\Payment\Interfaces\PaymentServiceInterfaces;
use SLIM\Support\Services\BaseCrudService;

class PaymentService extends BaseCrudService implements PaymentServiceInterfaces
{

    /**
     * @inheritDoc
     */
    protected function getRepositoryClass(): string
    {
        return PaymentRepositoryInterfaces::class;
    }
}

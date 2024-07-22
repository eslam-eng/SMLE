<?php


namespace SLIM\Payment\Repository;



use SLIM\Payment\App\Models\Payment;
use SLIM\Payment\Interfaces\PaymentRepositoryInterfaces;
use SLIM\Support\Repositories\BaseRepository;

class PaymentRepository extends BaseRepository implements PaymentRepositoryInterfaces
{

    /**
     * @inheritDoc
     */
    protected function getModelClass(): string
    {
        return Payment::class;
    }
}

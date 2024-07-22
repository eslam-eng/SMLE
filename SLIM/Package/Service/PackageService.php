<?php

namespace SLIM\Package\Service;

use SLIM\Package\interfaces\PackageRepositoryInterface;
use SLIM\Package\interfaces\PackageServiceInterface;
use SLIM\Support\Services\BaseCrudService;

class PackageService extends BaseCrudService implements PackageServiceInterface
{

    /**
     * @inheritDoc
     */
    protected function getRepositoryClass(): string
    {
        return PackageRepositoryInterface::class;

    }

    public function setSpecializations($package, $specializations)
    {

        if (isset($specializations['specialist_id']))
        {
            $array = [];

            foreach ($specializations['specialist_id'] as $index => $specialization)
            {

                if (in_array($specialization, array_column($array, 'specialist_id')))
                {
                    continue;
                }

                $array[] = [
                    'specialist_id' => $specialization,
                    'monthly_price' => $specializations['monthly_price'][$index],
                    'yearly_price'  => $specializations['yearly_price'][$index]
                ];
            }

            $package->specialist()->sync($array);
        }

    }

}

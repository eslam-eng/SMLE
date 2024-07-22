<?php

namespace SLIM\Specialization\Repository;

use  SLIM\Specialization\App\Models\Specialization;
use  SLIM\Support\Repositories\BaseRepository;
use  SLIM\Specialization\Interfaces\SpecializationRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;

class SpecializationRepository extends BaseRepository  implements SpecializationRepositoryInterface
 {

    /**
     * Specify Model class name
     *
     * @return string
     */
    protected function getModelClass(): string
    {
        return Specialization::class;
    }



    protected function applyFilters(array $searchParams = []): Builder
    {

        return $this
            ->getQuery()
            ->when(isset($searchParams['name']), function (Builder $query) use ($searchParams) {
                $query->where('name', 'like', "%{$searchParams['name']}%");
            })
            ->when(isset($searchParams['is_active']), function (Builder $query) use ($searchParams) {
                $query->where('is_active', $searchParams['is_active']);
            })
            ->orderBy('id','desc');
    }

}

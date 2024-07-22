<?php

namespace SLIM\Subspecialties\Repository;

use Illuminate\Database\Eloquent\Builder;
use SLIM\Subspecialties\App\Models\SubSpecialties;
use  SLIM\Support\Repositories\BaseRepository;
use  SLIM\Subspecialties\Interfaces\SubSpecializationRepositoryInterface;

class SubSpecializationRepository extends BaseRepository  implements SubSpecializationRepositoryInterface
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    protected function getModelClass(): string
    {
        return SubSpecialties::class;
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
            ->when(isset($searchParams['specialist_id']), function (Builder $query) use ($searchParams) {
                $query->wherehas('specialist',function ($q) use($searchParams){
                    $q->where('id',$searchParams['specialist_id']);
                });
            })
            ->orderBy('id','desc');
    }
}

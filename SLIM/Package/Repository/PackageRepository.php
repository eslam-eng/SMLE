<?php


namespace SLIM\Package\Repository;


use Illuminate\Database\Eloquent\Builder;
use SLIM\Package\App\Models\Package;
use SLIM\Package\interfaces\PackageRepositoryInterface;
use SLIM\Support\Repositories\BaseRepository;

class PackageRepository extends BaseRepository implements PackageRepositoryInterface
{

    /**
     * @inheritDoc
     */
    protected function getModelClass(): string
    {
      return  Package::class;
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

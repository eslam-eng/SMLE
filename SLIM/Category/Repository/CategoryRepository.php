<?php
namespace SLIM\Category\Repository;

use Illuminate\Database\Eloquent\Builder;
use SLIM\Category\Interfaces\CategoryRepositoryInterface;
use SLIM\Support\Repositories\BaseRepository;
use SLIM\Support\Services\BaseCrudService;
use  SLIM\Category\Interfaces\CategoryServiceInterfaces;
use  SLIM\Category\App\Models\Category;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{

    /**
     * @inheritDoc
     */
    protected function getModelClass(): string
    {
          return Category::class;
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
            ->when(isset($searchParams['color']), function (Builder $query) use ($searchParams) {
                $query->where('color', $searchParams['color']);
            })
            ->orderBy('id','desc');
    }



}

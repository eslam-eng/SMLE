<?php


namespace SLIM\Admin\Repository;


use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use SLIM\Admin\interfaces\AdminRepositoryInterface;
use SLIM\Support\Repositories\BaseRepository;

class AdminRepository extends BaseRepository implements AdminRepositoryInterface
{

    /**
     * @inheritDoc
     */
    protected function getModelClass(): string
    {
        return User::class;
    }

    protected function applyFilters(array $searchParams = []): Builder
    {


        return $this
            ->getQuery()
            ->when(isset($searchParams['name']), function (Builder $query) use ($searchParams) {
                $query->where('name', 'like', "%{$searchParams['name']}%");
            })
            ->when(isset($searchParams['email']), function (Builder $query) use ($searchParams) {
                $query->where('email','LIKE','%'.$searchParams['email'].'%');
            })
            ->when(isset($searchParams['is_active']), function (Builder $query) use ($searchParams) {
                $query->where('is_active', $searchParams['is_active']);
            })
            ->when(isset($searchParams['role']), function (Builder $query) use ($searchParams) {
                $query->whereHas('roles',function ($q)use($searchParams){
                    $q->where('id',$searchParams['role']);
                });
            })

            ->orderBy('id');
    }


}

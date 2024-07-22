<?php
namespace SLIM\Message\Repository;

use Illuminate\Database\Eloquent\Builder;
use SLIM\Message\Interfaces\MessageRepositoryInterface;
use SLIM\Support\Repositories\BaseRepository;
use  SLIM\Message\App\Models\Message;

class MessageRepository extends BaseRepository implements MessageRepositoryInterface
{

    /**
     * @inheritDoc
     */
    protected function getModelClass(): string
    {
          return Message::class;
    }


    protected function applyFilters(array $searchParams = []): Builder
    {


        return $this
            ->getQuery()
            ->when(isset($searchParams['name']), function (Builder $query) use ($searchParams) {
                $query->whereHas('trainee',function ($q)use($searchParams){
                    $q->where('full_name','like', "%{$searchParams['name']}%");
                });
            })
            ->when(isset($searchParams['phone']), function (Builder $query) use ($searchParams) {
                $query->whereHas('trainee',function ($q)use($searchParams){
                    $q->where('phone','like', "%{$searchParams['phone']}%");
                });
            })
            ->when(isset($searchParams['email']), function (Builder $query) use ($searchParams) {
                $query->whereHas('trainee',function ($q)use($searchParams){
                    $q->where('email','like', "%{$searchParams['email']}%");
                });
            })
            ->when(isset($searchParams['is_read']), function (Builder $query) use ($searchParams) {
                $query->where('is_read', $searchParams['is_read']);
            })
            ->orderBy('id','desc');
    }

}

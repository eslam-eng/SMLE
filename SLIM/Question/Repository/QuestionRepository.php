<?php

namespace SLIM\Question\Repository;

use Illuminate\Database\Eloquent\Builder;
use SLIM\Question\App\Models\Question;
use SLIM\Question\interfaces\QuestionRepositoryInterface;
use SLIM\Support\Repositories\BaseRepository;

class QuestionRepository extends BaseRepository implements QuestionRepositoryInterface
{

    /**
     * @inheritDoc
     */
    protected function getModelClass(): string
    {
        return Question::class;
    }

    protected function applyFilters(array $searchParams = []): Builder
    {

        return $this
            ->getQuery()
            ->when(isset($searchParams['question']), function (Builder $query) use ($searchParams)
        {
                $query->where('question', 'like', "%{$searchParams['question']}%");
            })
            ->when(isset($searchParams['is_active']), function (Builder $query) use ($searchParams)
        {
                $query->where('is_active', $searchParams['is_active']);
            })
            ->when(isset($searchParams['sub_specialist_id']), function (Builder $query) use ($searchParams)
        {
                $query->wherehas('sub_specialist', function ($q) use ($searchParams)
            {
                    $q->where('id', $searchParams['sub_specialist_id']);
                });
            })
            ->when(isset($searchParams['specialist_id']), function (Builder $query) use ($searchParams)
        {
                $query->wherehas('specialist', function ($q) use ($searchParams)
            {
                    $q->where('id', $searchParams['specialist_id']);
                });
            })
            ->orderBy('id','desc');
    }
}

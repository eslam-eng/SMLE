<?php

namespace SLIM\Question\Repository;

use Illuminate\Database\Eloquent\Builder;
use SLIM\Question\App\Models\QuestionNote;
use SLIM\Question\interfaces\QuestionRepositoryInterface;
use SLIM\Support\Repositories\BaseRepository;

class QuestionNoteRepository extends BaseRepository implements QuestionRepositoryInterface
{

    /**
     * @inheritDoc
     */
    protected function getModelClass(): string
    {
        return QuestionNote::class;
    }

    protected function applyFilters(array $searchParams = []): Builder
    {

        return $this
            ->getQuery()
            ->when(isset($searchParams['question']), function (Builder $query) use ($searchParams)
        {
                $query->whereHas('question', function ($q) use ($searchParams)
            {
                    $q->where('question', 'like', "%{$searchParams['question']}%");
                });
            })
            ->when(isset($searchParams['question_id']), function (Builder $query) use ($searchParams)
        {
                $query->where('question_id', $searchParams['question_id']);

            })
            ->when(isset($searchParams['full_name']), function (Builder $query) use ($searchParams)
        {
                $query->wherehas('trainee', function ($q) use ($searchParams)
            {
                    $q->where('full_name', 'like', "%{$searchParams['full_name']}%");
                });
            })
            ->when(isset($searchParams['email']), function (Builder $query) use ($searchParams)
        {
                $query->wherehas('trainee', function ($q) use ($searchParams)
            {
                    $q->where('email', $searchParams['email']);
                });
            })
            ->when(isset($searchParams['phone']), function (Builder $query) use ($searchParams)
        {
                $query->wherehas('trainee', function ($q) use ($searchParams)
            {
                    $q->where('phone', $searchParams['phone']);
                });
            })
            ->when(isset($searchParams['sub_specialist_id']), function (Builder $query) use ($searchParams)
        {
                $query->whereHas('question', function ($q) use ($searchParams)
            {
                    $q->where('sub_specialist_id', $searchParams['sub_specialist_id']);
                });

            })
            ->when(isset($searchParams['specialist_id']), function (Builder $query) use ($searchParams)
        {
                $query->whereHas('question', function ($q) use ($searchParams)
            {
                    $q->where('specialist_id', $searchParams['specialist_id']);
                });
            })

            ->orderBy('id','desc');
    }
}

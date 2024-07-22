<?php

namespace SLIM\Quiz\Repository;

use Illuminate\Database\Eloquent\Builder;
use SLIM\Quiz\App\Models\Quiz;
use SLIM\Quiz\interfaces\QuizRepositoryInterface;
use SLIM\Support\Repositories\BaseRepository;

class QuizRepository extends BaseRepository implements QuizRepositoryInterface
{

    /**
     * @inheritDoc
     */
    protected function getModelClass(): string
    {
        return Quiz::class;
    }

    protected function applyFilters(array $searchParams = []): Builder
    {
        return $this
            ->getQuery()
            ->when(isset($searchParams['full_name']), function (Builder $query) use ($searchParams)
        {
                $query->whereHas('trainee', function ($q) use ($searchParams)
            {
                    $q->where('full_name', 'like', "%{$searchParams['full_name']}%");
                });
            })
            ->when(isset($searchParams['phone']), function (Builder $query) use ($searchParams)
        {
                $query->whereHas('trainee', function ($q) use ($searchParams)
            {
                    $q->where('phone', $searchParams['phone']);
                });
            })
            ->when(isset($searchParams['email']), function (Builder $query) use ($searchParams)
        {
                $query->whereHas('trainee', function ($q) use ($searchParams)
            {
                    $q->where('email', $searchParams['email']);
                });
            })
            ->when(isset($searchParams['is_active']), function (Builder $query) use ($searchParams)
        {
                $query->whereHas('trainee', function ($q) use ($searchParams)
            {
                    $q->where('is_active', $searchParams['is_active']);
                });
            })
            ->when(isset($searchParams['degree']), function (Builder $query) use ($searchParams)
        {
                $query->whereHas('trainee', function ($q) use ($searchParams)
            {
                    $q->where('degree', $searchParams['degree']);
                });
            })
            ->when(isset($searchParams['specialist_id']), function (Builder $query) use ($searchParams)
        {
                $query->whereHas('trainee', function ($q) use ($searchParams)
            {
                    $q->wherehas('specialist', function ($q) use ($searchParams)
                {
                        $q->where('id', $searchParams['specialist_id']);
                    });
                });
            })
            ->when(isset($searchParams['sub_specialist_id']), function (Builder $query) use ($searchParams)
        {
                $query->whereHas('trainee', function ($q) use ($searchParams)
            {
                    $q->wherehas('sub_specialist', function ($q) use ($searchParams)
                {
                        $q->where('id', $searchParams['sub_specialist_id']);
                    });
                });
            })
            ->when(isset($searchParams['difficulty_level']), function (Builder $query) use ($searchParams) {
                $query->where('level',$searchParams['difficulty_level'] );

            })
            ->when(isset($searchParams['quiz_id']), function (Builder $query) use ($searchParams) {
                $query->where('id',$searchParams['quiz_id'] );

            })

            ->orderBy('quiz_date', 'desc');
    }

}

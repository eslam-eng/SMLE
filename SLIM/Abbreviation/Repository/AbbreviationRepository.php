<?php

namespace SLIM\Abbreviation\Repository;

use Illuminate\Database\Eloquent\Builder;
use SLIM\Abbreviation\App\Models\Abbreviation;
use  SLIM\Support\Repositories\BaseRepository;
use  SLIM\Abbreviation\Interfaces\AbbreviationRepositoryInterface;

class AbbreviationRepository extends BaseRepository  implements AbbreviationRepositoryInterface
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    protected function getModelClass(): string
    {
        return Abbreviation::class;
    }


    protected function applyFilters(array $searchParams = []): Builder
    {

        return $this
            ->getQuery()
            ->when(isset($searchParams['char_abbreviations']), function (Builder $query) use ($searchParams) {
                $query->where('char_abbreviations', 'like', "%{$searchParams['char_abbreviations']}%");
            })
            ->when(isset($searchParams['is_active']), function (Builder $query) use ($searchParams) {
                $query->where('is_active', $searchParams['is_active']);
            })
            ->when(isset($searchParams['word_abbreviations']), function (Builder $query) use ($searchParams) {
                $query->where('word_abbreviations','like', "%{$searchParams['word_abbreviations']}%");
            })
            ->orderBy('id');
    }


}

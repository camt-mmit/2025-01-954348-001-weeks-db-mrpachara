<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

abstract class SearchableController extends Controller
{
    abstract function getQuery(): Builder;

    function filterByTerm(Builder $query, ?string $term): Builder
    {
        if (!empty($term)) {
            foreach (\preg_split('/\s+/', \trim($term)) as $word) {
                $query->where(function (Builder $innerQuery) use ($word) {
                    $innerQuery
                        ->where('code', 'LIKE', "%{$word}%")
                        ->orWhere('name', 'LIKE', "%{$word}%");
                });
            }
        }

        return $query;
    }

    function prepareCriteria(array $criteria): array
    {
        return [
            'term' => null,
            ...$criteria,
        ];
    }

    function filter(Builder $query, array $criteria): Builder
    {
        return $this->filterByTerm($query, $criteria['term']);
    }

    function search(array $criteria): Builder
    {
        $query = $this->getQuery();
        return $this->filter($query, $criteria);
    }

    // For easily searching by code.
    function find(string $code): Model
    {
        return $this->getQuery()->where('code', $code)->firstOrFail();
    }
}

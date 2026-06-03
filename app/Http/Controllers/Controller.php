<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class Controller
{
    protected function applySearchFilter(Builder $query, Request $request, array $columns): void
    {
        $search = trim((string) $request->query('search', ''));

        if ($search === '') {
            return;
        }

        $query->where(function (Builder $builder) use ($columns, $search): void {
            foreach ($columns as $column) {
                $builder->orWhere($column, 'like', '%'.$search.'%');
            }
        });
    }

    protected function applyIdsFilter(Builder $query, Request $request): void
    {
        $ids = array_values(array_filter(array_map(
            static fn (string $id): int => (int) trim($id),
            explode(',', (string) $request->query('ids', ''))
        )));

        if ($ids === []) {
            return;
        }

        $query->whereIn($query->getModel()->getKeyName(), $ids);
    }
}

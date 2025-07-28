<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait Filterable
{

    /**
     * Phương thức lọc dữ liệu
     * @param Builder $query
     * @param array $filters
     * Mẫu
     * [
     * 'name' => 'string',
     * 'created_at' => 'date',
     * 'updated_at' => 'date',
     * 'status' => 'int',
     * 'sort_by' => 'string',
     * 'sort_dir' => 'string',
     * 'page' => 'int',
     * 'per_page' => 'int',
     * 'search' => 'string',
     * 'name' => 'string',
     * 'name_from' => 'date',
     * 'name_to' => 'date',
     * 'status' => 'int',
     * 'sort_by' => 'string',
     * 'sort_dir' => 'string',]
     * @return Builder
     */
    public function scopeFilter(Builder $query, array $filters): Builder
    {
        $model = new static;

        foreach ($filters as $key => $value) {
            if ($key === 'search' && isset($model->searchable)) {
                $query->where(function ($q) use ($value, $model) {
                    foreach ($model->searchable as $column) {
                        $q->orWhere($column, 'like', "%$value%");
                    }
                });
                continue;
            }

            if (str_ends_with($key, '_from')) {
                $column = str_replace('_from', '', $key);
                $query->where($column, '>=', $value);
                continue;
            }

            if (str_ends_with($key, '_to')) {
                $column = str_replace('_to', '', $key);
                $query->where($column, '<=', $value);
                continue;
            }

            if ($key === 'sort_by') {
                $dir = $filters['sort_dir'] ?? 'asc';
                $query->orderBy($value, $dir);
                continue;
            }

            if (in_array($key, ['sort_dir'])) {
                continue; // bỏ qua
            }

            // Mặc định key = value
            $query->where($key, $value);
        }

        return $query;
    }
}

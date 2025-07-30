<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Schema;

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
     * 'status' => [1, 2, 3], // Hỗ trợ array
     * 'sort_by' => 'string',
     * 'sort_dir' => 'string',]
     * @return Builder
     */
    public function scopeFilter(Builder $query, array $filters): Builder
    {
        $model = new static;

        foreach ($filters as $key => $value) {
            // Bỏ qua các key không cần filter
            if (in_array($key, ['page', 'per_page', 'sort_dir'])) {
                continue;
            }

            // Bỏ qua nếu value null hoặc empty string
            if ($value === null || $value === '') {
                continue;
            }

            // Xử lý search
            if ($key === 'search' && isset($model->searchable)) {
                $query->where(function ($q) use ($value, $model) {
                    foreach ($model->searchable as $column) {
                        $q->orWhere($column, 'like', "%{$value}%");
                    }
                });
                continue;
            }

            // Xử lý range filter (_from)
            if (str_ends_with($key, '_from')) {
                $column = str_replace('_from', '', $key);
                if ($this->isValidColumn($column)) {
                    $query->where($column, '>=', $value);
                }
                continue;
            }

            // Xử lý range filter (_to)
            if (str_ends_with($key, '_to')) {
                $column = str_replace('_to', '', $key);
                if ($this->isValidColumn($column)) {
                    $query->where($column, '<=', $value);
                }
                continue;
            }

            // Xử lý sorting
            if ($key === 'sort_by') {
                $dir = $filters['sort_dir'] ?? 'asc';
                if ($this->isValidColumn($value) && in_array(strtolower($dir), ['asc', 'desc'])) {
                    $query->orderBy($value, $dir);
                }
                continue;
            }

            // Xử lý array values (IN clause)
            if (is_array($value)) {
                if ($this->isValidColumn($key)) {
                    $query->whereIn($key, $value);
                }
                continue;
            }

            // Mặc định: exact match
            if ($this->isValidColumn($key)) {
                $query->where($key, $value);
            }
        }

        return $query;
    }

    /**
     * Kiểm tra column có hợp lệ không
     * @param string $column
     * @return bool
     */
    protected function isValidColumn(string $column): bool
    {
        $model = new static;

        // Kiểm tra column có trong fillable hoặc table columns không
        if (isset($model->fillable) && in_array($column, $model->fillable)) {
            return true;
        }

        // Kiểm tra column có trong table schema không
        try {
            $table = $model->getTable();
            $columns = Schema::getColumnListing($table);
            return in_array($column, $columns);
        } catch (\Exception $e) {
            return false;
        }
    }
}

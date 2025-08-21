<?php

namespace App\Helpers;

use App\Enums\Column;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SlugHelper
{
    public $column = Column::Slug->value;
    public function handle(string $string, Model $model) {
        $slug = Str::slug($string);
        $checkunique = $this->checkUniqueSlug($model);
    }

    /**
     * @function checkUniqueSlug
     * @param Model $model: Model muốn kiểm tra slug
     * Kiểm tra xem slug đã tồn tại trong database hay chưa
     * trả về 1 mảng slug nếu tồn tại
     * null nếu chưa tồn tại
     */
    private function checkUniqueSlug(Model $model) {
         $slugs = $model->where('slug')->get();
    }
}

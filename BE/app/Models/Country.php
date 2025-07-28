<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Country Model
 *
 * @property int $id
 * @property string $name
 * @property string|null $code
 * @property int|null $created_by
 * @property string|null $image
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class Country extends Model
{
    use SoftDeletes,HasFactory,Filterable;


    /**
     * Thuộc tính có thể gán giá trị
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'code',
        'created_by',
        'image',
    ];

    /**
     * Thực hiện:
     * - Ép kiểu dữ liệu
     *
     * @var array<string, string>
     */
    protected $casts = [
        'id' => 'integer',
        'created_by' => 'integer',
        'name' => 'string',
        'code' => 'string',
        'image' => 'string',
        'deleted_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    /**
     * Thuộc tính có thể tìm kiếm
     *
     * @var array<string>
     */
    protected $searchable = ['name','code'];
}

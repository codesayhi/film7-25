<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Genre extends Model
{
    use SoftDeletes, HasFactory, Filterable;

    /**
     * Thuộc tính có thể gán giá trị
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'slug',
        'created_by',
        'image',
    ];

    /**
     * Ép kiểu dữ liệu
     *
     * @var array<string, string>
     */
    protected $casts = [
        'id' => 'integer',
        'created_by' => 'integer',
        'name' => 'string',
        'slug' => 'string',
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
    protected $searchable = ['name','slug'];

    /**
     * Người tạo thể loại
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}

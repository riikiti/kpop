<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Author extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $fillable = [
        'name',
        'avatar',
        'group_id',
        'status',
    ];


    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }
}

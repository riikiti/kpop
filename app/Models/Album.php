<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Album extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $fillable = [
        'name',
        'photo',
        'description',
        'price',
        'group_id',
        'new'
    ];

    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }

    public function getNewStatusStatus() {
        return $this->new ? 'Новинка' : 'Уже в продаже';
    }
}

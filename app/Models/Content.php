<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Content extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'title',
        'cover',
        'description',
        'file',
    ];

    protected function casts(): array
    {
        return [
            'created_at' => 'immutable_date',
            'updated_at' => 'immutable_date',
        ];
    }

    public function contentCategory(): BelongsTo
    {
        return $this->belongsTo(ContentCategory::class);
    }

    public function rates(): HasMany
    {
        return $this->hasMany(ContentRate::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RateItem extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'rate_id',
        'title',
        'is_checked',
    ];

    protected function casts(): array
    {
        return [
            'is_checked' => 'bool',
        ];
    }

    public function rate(): BelongsTo
    {
        return $this->belongsTo(Rate::class);
    }
}

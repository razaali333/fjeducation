<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContentRate extends Model
{
    use HasFactory;

    protected $table = 'content_rate';

    protected $fillable = [
        'content_id',
        'rate_id',
    ];

    public function rate(): BelongsTo
    {
        return $this->belongsTo(Rate::class);
    }

    public function content(): BelongsTo
    {
        return $this->belongsTo(Content::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Transaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'referance',
        'emailAddress',
        'firstName',
        'lastName',
        'address1',
        'city',
        'countryCode',
        'amount',
        'currency',
        'status',
        'orderReference',
        'orderReference',
        'user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

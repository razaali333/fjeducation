<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Transaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'rate_id',
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

    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class);
    }
}

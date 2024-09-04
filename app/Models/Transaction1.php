<?php

namespace App\Models;

use App\Models\Enum\TransactionStatus;
use App\Models\Enum\TransactionType;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string id
 * @property int user_id
 * @property string rate_id
 * @property int amount
 * @property string currency_label
 * @property int status
 * @property string type
 * @property string payload
 * @property string ip
 * @property string created_at
 * @property string updated_at
 * @property User user
 * @property Rate rate
 */
class Transaction extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'user_id',
        'rate_id',
        'amount',
        'currency_label',
        'status',
        'type',
        'payload',
        'ip',
    ];

    protected function casts(): array
    {
        return [
            'status' => TransactionStatus::class,
            'type' => TransactionType::class,
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function rate(): BelongsTo
    {
        return $this->belongsTo(Rate::class);
    }

    public function setPending(): void
    {
        $this->update(['status' => TransactionStatus::PENDING]);
    }

    public function setFail(): void
    {
        $this->update(['status' => TransactionStatus::FAILED]);
    }

    public function setSuccess(): void
    {
        $this->update(['status' => TransactionStatus::SUCCESS]);
    }
}

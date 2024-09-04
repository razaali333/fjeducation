<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string id
 * @property string title
 * @property int price
 * @property string currency_label
 * @property string created_at
 * @property string updated_at
 */
class Rate extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'title',
        'price',
        'currency_label',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(RateItem::class);
    }

    public function contents(): HasMany
    {
        return $this->hasMany(ContentRate::class);
    }
}

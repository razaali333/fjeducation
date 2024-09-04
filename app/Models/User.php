<?php

namespace App\Models;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Enum\TransactionStatus;
use Illuminate\Support\Str;

/**
 * @property string id
 * @property string name
 * @property string email
 * @property string phone
 * @property string email_verified_at datetime
 * @property string password
 * @property string api_token
 * @property boolean is_admin
 * @property string remember_token
 * @property string created_at datetime
 * @property string updated_at datetime
 * @property Rate[] earnedRates
 *
 * @mixin Model
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'address',
        'country',
        'city',
        'password',
        'is_admin',
        'phone',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_admin' => 'boolean',
        ];
    }

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($model) {
            $model->api_token = Str::random(80);
        });

        ResetPassword::createUrlUsing(function (User $user, string $token) {
            return config('app.front_url') . 'reset-password?token=' . $token . '&email=' . $user->email;
        });
    }

    public function earnedRates(): HasManyThrough
    {
        return $this->hasManyThrough(Rate::class, Transaction::class, 'user_id', 'id', 'id', 'rate_id')->where('status', '=', TransactionStatus::SUCCESS);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}

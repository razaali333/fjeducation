<?php

namespace App\Http\Resources\User;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema()
 *
 * @mixin User
 */
class AuthUserResource extends JsonResource
{
    /**
     * @OA\Property(
     *     property="last_name",
     *     type="string"
     * ),
     * @OA\Property(
     *     type="bool",
     *     property="is_admin"
     * ),
     * @OA\Property(
     *     property="name",
     *     type="string"
     * ),
     * @OA\Property(
     *     property="middle_name",
     *     type="string"
     * ),
     * @OA\Property(
     *     property="email_verified_at",
     *     type="datetime"
     * ),
     * @OA\Property(
     *     property="api_token",
     *     type="string"
     * ),
     * @OA\Property(
     *     property="role",
     *     type="string"
     * ),
     * @OA\Property(
     *     property="locale",
     *     type="string"
     * ),
     * @OA\Property(
     *     property="currency_label",
     *     type="string"
     * ),
     * @OA\Property(
     *     property="notification_type",
     *     type="string"
     * )
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $this->setVisible([
            'api_token',
            'is_admin',
            'id',
            'last_name',
            'name',
            'middle_name',
            'user_name',
            'email',
            'email_verified_at',
            'phone',
            'role',
            'locale',
            'currency_label',
            'notification_type',
            'created_at',
        ]);

        return parent::toArray($request);
    }
}

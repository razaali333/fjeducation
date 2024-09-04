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
class ProfileResource extends JsonResource
{
    /**
     * @OA\Property(
     *     type="string",
     *     property="email"
     * ),
     * @OA\Property(
     *     type="string",
     *     property="name"
     * ),
     * @OA\Property(
     *     type="string",
     *     property="phone"
     * ),
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $this->setVisible([
            'email',
            'name',
            'phone',
        ]);

        return parent::toArray($request);
    }
}

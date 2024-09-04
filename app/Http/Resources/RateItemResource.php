<?php

namespace App\Http\Resources;

use App\Models\RateItem;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema()
 *
 * @mixin RateItem
 */
class RateItemResource extends JsonResource
{
    /**
     * @OA\Property(
     *     type="string",
     *     property="title"
     * ),
     * @OA\Property(
     *     type="bool",
     *     property="is_checked"
     * ),
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $this->setVisible([
            'title',
            'is_checked',
        ]);

        return parent::toArray($request);
    }
}

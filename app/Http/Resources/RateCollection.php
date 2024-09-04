<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema()
 */
class RateCollection extends ResourceCollection
{
    /**
     * @OA\Property(
     *     property="rates",
     *     type="array",
     *     @OA\Items(
     *         type="object",
     *         ref="#/components/schemas/RateResource"
     *     )
     *  ),
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }
}

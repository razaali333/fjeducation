<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema()
 */
class ContentCollection extends ResourceCollection
{
    /**
     * @OA\Property(
     *     property="contents",
     *     type="array",
     *     @OA\Items(
     *         type="object",
     *         ref="#/components/schemas/ContentResource"
     *     )
     *  ),
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }
}

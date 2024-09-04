<?php

namespace App\Http\Resources;

use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema()
 *
 * @mixin Content
 */
class ContentResource extends JsonResource
{
    /**
     * @OA\Property(
     *     property="title",
     *     type="string"
     * ),
     * @OA\Property(
     *     property="cover",
     *     type="string"
     * ),
     * @OA\Property(
     *     property="description",
     *     type="string"
     * ),
     * @OA\Property(
     *     property="file",
     *     type="string"
     * )
     */
    public function toArray(Request $request): array
    {
        if (Auth::guard('api')->check()) {
            $user = Auth::guard('api')->user();
            $user->load(['earnedRates', 'earnedRates.contents', 'earnedRates.contents.content']);

            $contentIds = [];

            foreach ($user->earnedRates as $rate) {
                $contentIds = Arr::collapse([
                    $rate->contents->pluck('content_id'),
                    $contentIds,
                ]);
            }

            if (in_array($this->id, $contentIds)) {
                $this->setVisible([
                    'title',
                    'cover',
                    'description',
                    'file',
                ]);
            } else {
                $this->setVisible([
                    'title',
                    'cover',
                    'description',
                ]);
            }
        } else {
            $this->setVisible([
                'title',
                'cover',
                'description',
            ]);
        }

        return parent::toArray($request);
    }
}

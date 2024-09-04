<?php

namespace App\Http\Resources;

use App\Models\Enum\TransactionStatus;
use App\Models\Rate;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema()
 *
 * @mixin Rate
 */
class RateResource extends JsonResource
{
    /**
     * @OA\Property(
     *     type="string",
     *     property="id"
     * ),
     * @OA\Property(
     *     type="string",
     *     property="title"
     * ),
     * @OA\Property(
     *     type="string",
     *     property="description"
     * ),
     * @OA\Property(
     *     type="int",
     *     property="price"
     * ),
     * @OA\Property(
     *     type="string",
     *     property="currency_label"
     * ),
     * @OA\Property(
     *     type="array",
     *     property="items",
     *     @OA\Items(
     *         type="object",
     *         ref="#/components/schemas/RateItemResource"
     *     )
     * ),
     * @OA\Property(
     *      type="bool",
     *      property="earned"
     *  ),
     */
    public function toArray(Request $request): array
    {
        $this->setVisible([
            'id',
            'title',
            'description',
            'price',
            'currency_label',
        ]);

        $payload = [];

        if (Auth::guard('api')->check()) {
            $user = Auth::guard('api')->user();

            $transaction = Transaction::query()
                ->where('user_id', '=', $user->id)
                ->where('rate_id', '=', $this->id)
                ->where('status', '=', TransactionStatus::SUCCESS)
                ->first();

            if ($transaction != null) {
                $payload['earned'] = true;
            } else {
                $payload['earned'] = false;
            }
        }

        return Arr::collapse(
            [
                parent::toArray($request),
                [
                    'items' => RateItemResource::collection($this->whenLoaded('items')),
                ],
                $payload
            ]
        );
    }
}

<?php

namespace App\Http\Controllers\Rate;

use App\Http\Controllers\CoreController;
use App\Http\Resources\RateCollection;
use App\Models\Rate;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use OpenApi\Annotations as OA;

/**
 * @OA\Get(
 *     path="/api/v1/rates",
 *     summary="List of all rates.",
 *     tags={"Rates"},
 *     @OA\Response(
 *         response="200",
 *         description="OK",
 *         @OA\JsonContent(
 *             ref="#/components/schemas/RateCollection"
 *         )
 *     ),
 *     @OA\Response(
 *         response="500",
 *         description="There is errors in request.",
 *         @OA\JsonContent(
 *             ref="#/components/schemas/Result"
 *         )
 *     )
 * )
 */
class IndexRateController extends CoreController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): JsonResponse
    {
        $rates = Rate::query()->with('items')->get();

        $this->result->Success = true;
        $this->result->Content = (new RateCollection($rates))->toArray($request);

        return response()->json($this->result);
    }
}

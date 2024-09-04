<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\CoreController;
use App\Http\Resources\User\ProfileResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use OpenApi\Annotations as OA;

/**
 * @OA\Get(
 *     path="/api/v1/profile",
 *     summary="Receiving user's profile.",
 *     tags={"Users"},
 *     security={{ "Bearer":{} }},
 *     @OA\Response(
 *         response="200",
 *         description="OK",
 *         @OA\JsonContent(
 *             ref="#/components/schemas/ProfileResource"
 *         )
 *     )
 * )
 */
class GetProfileController extends CoreController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): JsonResponse
    {
        $user = Auth::guard('api')->user();

        $this->result->Success = true;
        $this->result->Content = (new ProfileResource($user))->toArray($request);

        return response()->json($this->result);
    }
}

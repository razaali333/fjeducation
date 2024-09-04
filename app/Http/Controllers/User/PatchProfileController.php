<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\CoreController;
use App\Http\Requests\User\PatchProfileRequest;
use App\Http\Resources\User\ProfileResource;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use OpenApi\Annotations as OA;

/**
 * @OA\Patch(
 *     path="/api/v1/profile",
 *     summary="Updating user's profile.",
 *     tags={"Users"},
 *     security={{ "Bearer":{} }},
 *     @OA\RequestBody(
 *         @OA\MediaType(
 *             mediaType="application/x-www-form-urlencoded",
 *             @OA\Schema(
 *                 type="object",
 *                 ref="#/components/schemas/PatchProfileRequest"
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response="200",
 *         description="OK",
 *         @OA\JsonContent(
 *             ref="#/components/schemas/ProfileResource"
 *         )
 *     ),
 *     @OA\Response(
 *         response="500",
 *         description="Something goes wrong.",
 *         @OA\JsonContent(
 *             ref="#/components/schemas/Result"
 *         )
 *     )
 * )
 */
class PatchProfileController extends CoreController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(PatchProfileRequest $request): JsonResponse
    {
        $data = $request->validated();

        if ($request->has('password')) {
            $data['password'] = Hash::make($data['password']);
        }

        /** @var User $user */
        $user = Auth::guard('api')->user();

        try {
            $user->update($data);

            $this->result->Success = true;
            $this->result->Content = (new ProfileResource($user))->toArray($request);
        } catch (Exception $exception) {
            $this->result->Error = $exception->getMessage();

            return response()->json($this->result, 500);
        }

        return response()->json($this->result);
    }
}

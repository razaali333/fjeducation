<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\CoreController;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

/**
 * @OA\Get(
 *     path="/api/v1/email/verify/{id}/{hash}/",
 *     summary="Route to verify user's email.",
 *     tags={"Users"},
 *     @OA\Parameter(
 *         in="path",
 *         name="id",
 *     ),
 *     @OA\Parameter(
 *         in="path",
 *         name="hash",
 *     ),
 *     @OA\Response(
 *         response="200",
 *         description="OK",
 *         @OA\JsonContent(
 *             ref="#/components/schemas/Result"
 *         )
 *     ),
 *     @OA\Response(
 *         response="400",
 *         description="There is errors in request.",
 *         @OA\JsonContent(
 *             ref="#/components/schemas/Result"
 *         )
 *     )
 * )
 */
class VerifyEmailController extends CoreController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, string $id, string $hash): JsonResponse
    {
        /** @var User $user */
        $user = User::query()->find($id);
        $expiresAt = $request->query('expires_at');

        $data = explode('|', $user->remember_token);

        if ($user == null) {
            $this->result->Error = __('back.errors.user-not-found');

            return response()->json($this->result, 400);
        }

//        if ($data[1] !== $expiresAt) {
//            $this->result->Error = __('back.errors.wrong-timestamp');
//
//            return response()->json($this->result, 400);
//        }

        if ($data[0] !== $hash) {
            $this->result->Error = __('back.errors.wrong-hash');

            return response()->json($this->result, 400);
        }

        $user->email_verified_at = now();
        $user->remember_token = '';
        $user->save();

        $this->result->Success = true;

        return response()->json($this->result);
    }
}

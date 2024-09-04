<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\CoreController;
use App\Http\Requests\User\ResetPasswordRequest;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Password;
use OpenApi\Annotations as OA;

/**
 * @OA\Post(
 *     path="/api/v1/password-reset-request",
 *     description="Request to reset user's password.",
 *     tags={ "Users" },
 *     @OA\RequestBody(
 *         @OA\MediaType(
 *             mediaType="application/x-www-form-urlencoded",
 *             @OA\Schema(
 *                 type="object",
 *                 ref="#/components/schemas/ResetPasswordRequest",
 *             )
 *         )
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
class ResetPasswordRequestController extends CoreController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(ResetPasswordRequest $request)
    {
        $data = $request->validated();

        $user = User::query()->where('email', '=', $data['email'])->first();

        if ($user == null) {
            $this->result->Error = __('back.errors.user-not-found');

            return response()->json($this->result, 400);
        }

        try {
            $status = Password::sendResetLink(
                $data
            );

            if ($status === Password::RESET_LINK_SENT) {
                $this->result->Success = true;
                $this->result->Content = ['status' => $status];

                return response()->json($this->result);
            } else {
                $this->result->Error = $status;

                return response()->json($this->result, 400);
            }
        } catch (Exception $exception) {
            $this->result->Error = $exception->getMessage();

            return response()->json($this->result, 500);
        }

        return response()->json($this->result);
    }
}

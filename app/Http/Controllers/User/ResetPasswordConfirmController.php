<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\CoreController;
use App\Http\Requests\User\ResetPasswordConfirmRequest;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use OpenApi\Annotations as OA;

/**
 * @OA\Post(
 *     path="/api/v1/password-reset-confirm",
 *     description="Updating user's password.",
 *     tags={ "Users" },
 *     @OA\RequestBody(
 *         @OA\MediaType(
 *             mediaType="application/x-www-form-urlencoded",
 *             @OA\Schema(
 *                 type="object",
 *                 ref="#/components/schemas/ResetPasswordConfirmRequest",
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
 *     )
 * )
 */
class ResetPasswordConfirmController extends CoreController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(ResetPasswordConfirmRequest $request)
    {
        $data = $request->validated();

        $status = Password::reset(
            $data,
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            $this->result->Success = true;
            $this->result->Content = ['status' => $status];

            return response()->json($this->result);
        }

        $this->result->Error = $status;

        return response()->json($this->result, 400);
    }
}

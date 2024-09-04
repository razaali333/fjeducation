<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\CoreController;
use App\Http\Requests\User\SignInRequest;
use App\Http\Resources\User\AuthUserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use OpenApi\Annotations as OA;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
/**
 * @OA\Post(
 *     path="/api/v1/sign-in",
 *     summary="User authorisation",
 *     tags={"Users"},
 *     @OA\RequestBody(
 *          @OA\MediaType(
 *              mediaType="multipart/form-data",
 *              @OA\Schema(
 *                  type="object",
 *                  ref="#/components/schemas/SignInRequest",
 *              )
 *          )
 *      ),
 *     @OA\Response(
 *         response="200",
 *         description="OK",
 *         @OA\JsonContent(
 *             ref="#/components/schemas/AuthUserResource"
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
class SignInController extends CoreController
{
    public function __invoke(SignInRequest $request): JsonResponse
    {

        $data = $request->validated();

        /** @var User $user */
        $user = User::query()->where('email', $data['email'])->first();

        if (!$user) {
            $this->result->Error = __('back.user.not-found');

            return response()->json($this->result, 400);
        }

        if (!Hash::check($data['password'], $user->password)) {
            $this->result->Error = __('back.user.wrong-password');

            return response()->json($this->result, 400);
        }

        if (!$user->api_token) {
            $user->update(['api_token' => Str::random(80)]);
        }

          // Authenticate the user and set the session
    Auth::login($user);

    // Set the user session if needed (optional, Laravel automatically handles sessions after login)
    Session::put('user', $user);


        $this->result->Success = true;
        $this->result->Content = (new AuthUserResource($user))->toArray($request);

        return response()->json($this->result);
    }
}

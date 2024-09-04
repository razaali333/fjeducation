<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\CoreController;
use App\Http\Requests\User\SignUpRequest;
use App\Mail\User\SignUpNotification;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use OpenApi\Annotations as OA;
use stdClass;

/**
 * @OA\Post(
 *     path="/api/v1/sign-up",
 *     summary="User registration",
 *     tags={"Users"},
 *     @OA\RequestBody(
 *         @OA\MediaType(
 *             mediaType="application/x-www-form-urlencoded",
 *             @OA\Schema(
 *                 type="object",
 *                 ref="#/components/schemas/SignUpRequest",
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
class SignUpController extends CoreController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(SignUpRequest $request): JsonResponse
    {
        $data = $request->validated();

        $user = User::query()->where('email', $data['email'])->count();

        if ($user > 0) {
            $this->result->Error = __('back.user.already-exists');

            return response()->json($this->result, 400);
        }

        $object = new stdClass();

        DB::beginTransaction();

        try {
            $hash = Str::random(50);
            $timestamp = now()->timestamp;

            $user = new User();
            $user->fill($data);
            $user->password = Hash::make($data['password']);
            $user->remember_token = $hash . '|' . $timestamp;
            $user->save();

            $uuid = $user->id;
            $object->link = config('app.front_url') . 'email/verify/' . $uuid . '/' . $hash;

            // Mail::to($user->email)->send(new SignUpNotification($object));

            DB::commit();

            $this->result->Success = true;

            return response()->json($this->result);
        } catch (Exception $exception) {
            DB::rollBack();
            $this->result->Error = $exception->getMessage();

            return response()->json($this->result, 500);
        }
    }
}

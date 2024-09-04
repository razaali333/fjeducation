<?php

namespace App\Http\Requests\User;

use App\Http\Requests\ApiRequest;
use Illuminate\Contracts\Validation\ValidationRule;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     required={ "token", "email", "password", "password_confirmation" }
 * )
 */
class ResetPasswordConfirmRequest extends ApiRequest
{
    /**
     * @OA\Property(
     *     type="string",
     *     property="token"
     * ),
     * @OA\Property(
     *     type="string",
     *     property="email"
     * ),
     * @OA\Property(
     *     type="string",
     *     property="password"
     * ),
     * @OA\Property(
     *     type="string",
     *     property="password_confirmation"
     * )
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8', 'confirmed'],
        ];
    }
}

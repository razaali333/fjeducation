<?php

namespace App\Http\Requests\User;

use App\Http\Requests\ApiRequest;
use Illuminate\Contracts\Validation\ValidationRule;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema()
 */
class SignInRequest extends ApiRequest
{
    /**
     * @OA\Property(
     *     property="email",
     *     type="string"
     * ),
     * @OA\Property(
     *     property="password",
     *     type="string"
     * )
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ];
    }
}

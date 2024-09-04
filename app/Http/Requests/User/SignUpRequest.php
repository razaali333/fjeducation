<?php

namespace App\Http\Requests\User;

use App\Http\Requests\ApiRequest;
use Illuminate\Contracts\Validation\ValidationRule;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     required={"email", "password", "role"}
 * )
 */
class SignUpRequest extends ApiRequest
{
    /**
     * @OA\Property(
     *     title="E-mail",
     *     description="User's E-mail.",
     *     property="email",
     *     type="string"
     * ),
     * @OA\Property(
     *     title="Password",
     *     description="User's password.",
     *     property="password",
     *     type="string"
     * ),
     * @OA\Property(
     *     title="Name",
     *     description="User's name (full name).",
     *     property="name",
     *     type="string"
     * ),
     * @OA\Property(
     *     title="Phone",
     *     description="User's contact phone.",
     *     property="phone",
     *     type="string"
     * )
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'email'],
            'address' => ['required', 'string'],
            'country' => ['required', 'string'],
            'city' => ['required', 'string'],
            'password' => ['required', 'string'],
            'name' => ['required', 'string'],
            'phone' => ['required', 'string'],
        ];
    }
}

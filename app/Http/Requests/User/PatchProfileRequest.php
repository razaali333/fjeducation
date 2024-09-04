<?php

namespace App\Http\Requests\User;

use App\Http\Requests\ApiRequest;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Auth;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     required={ "email", "name", "phone" }
 * )
 */
class PatchProfileRequest extends ApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::guard('api')->check();
    }

    /**
     * @OA\Property(
     *     type="string",
     *     property="email"
     * ),
     * @OA\Property(
     *     type="string",
     *     property="name"
     * ),
     * @OA\Property(
     *     type="string",
     *     property="phone"
     * ),
     * @OA\Property(
     *     type="string",
     *     property="password"
     * )
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'email'],
            'name' => ['required', 'string'],
            'phone' => ['required', 'string'],
            'password' => ['nullable', 'string'],
        ];
    }
}

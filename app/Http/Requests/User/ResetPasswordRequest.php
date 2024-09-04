<?php

namespace App\Http\Requests\User;

use App\Http\Requests\ApiRequest;
use Illuminate\Contracts\Validation\ValidationRule;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     required={ "email" }
 * )
 */
class ResetPasswordRequest extends ApiRequest
{
    /**
     * @OA\Property(
     *     type="string",
     *     property="email"
     * )
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'email', 'exists:App\Models\User,email'],
        ];
    }
}

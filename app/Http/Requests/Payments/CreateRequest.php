<?php

namespace App\Http\Requests\Payments;

use App\Http\Requests\ApiRequest;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Auth;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     required={ "rate_id" }
 * )
 */
class CreateRequest extends ApiRequest
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
     *     property="rate_id"
     * )
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'rate_id' => ['required', 'exists:App\Models\Rate,id'],
        ];
    }
}

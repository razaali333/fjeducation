<?php

namespace App\Http\Requests;

use App\Services\Patterns\Result;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;

class ApiRequest extends FormRequest
{
    protected function failedValidation(Validator $validator)
    {
        $messages = [];

        foreach ($validator->errors()->messages() as $errors) {
            foreach ($errors as $error) {
                $messages[] = $error;
            }
        }

        $result = new Result();
        $result->Success = false;
        $result->Error = implode(', ', $messages);

        throw new HttpResponseException(
            response()->json($result, Response::HTTP_BAD_REQUEST)
        );
    }
}

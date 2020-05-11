<?php

namespace App\Http\Requests\Api;

class SignInRequest extends BasicApiFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'email' => [
                'max:70',
                'required',
                'email',
                'exists:users'
            ],
            'password' => [
                'required',
                'min:8',
                'max:30',
            ],
        ];
    }
}

<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookRequest extends BasicApiFormRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'id' => [
                'required',
                'integer',
                'exists:books',
            ],
            'title' => [
                'required',
                'string',
                'max:255',
            ],
            'year' => [
                'required',
                'integer',
                'max:2021',
            ],
        ];
    }

    protected function prepareForValidation()
    {
        $input = $this->all();
        $input['id'] = (int)$this->book;

        $this->replace($input);
    }
}

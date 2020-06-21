<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CloseCallRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'call' => 'required|integer|exists:calls,id'
        ];
    }

    /**
     * Set the response object that will be returned if any validation fails.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'call.integer' => 'The category value should be an integer.',
            'call.exists' => 'The selected category was not found.',
        ];
    }
}

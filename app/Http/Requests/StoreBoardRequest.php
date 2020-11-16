<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBoardRequest extends FormRequest
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
            'user_id' => 'integer',
            'cover' => 'nullable|file',
            'title' => 'string|max:255|required',
            'body' => 'nullable|string|max:255',
            'sensitive' => 'nullable|string|max:2048',
            'status' => 'nullable|string|max:10',
        ];
    }
}

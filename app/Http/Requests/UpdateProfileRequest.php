<?php

namespace App\Http\Requests;

use Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class UpdateProfileRequest extends FormRequest
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
            'first_name' => 'string|max:255|required',
            'last_name' => 'string|max:255|required',
            'location' => 'nullable|string|max:255',
            'heading' => 'nullable|string|max:2048',
            'bio' => 'nullable|string|max:2048',
            'avatar' => 'nullable|file',
            'cover' => 'nullable|file',
            'password' => 'nullable|required_with:password_confirmation|string|confirmed',
            'current_password' => 'required',
        ];
    }

    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {
        // checks user current password
        // before making changes
        $validator->after(function ($validator) {
            if (! Hash::check($this->current_password, $this->user()->password)) {
                $validator->errors()->add('current_password', 'Your current password is not:'.$this->current_password);
            }
        });
    }
}

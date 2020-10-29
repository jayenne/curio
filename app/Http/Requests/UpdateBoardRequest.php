<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBoardRequest extends FormRequest
{
    protected $layout_options = config('platform.database.layouts.options');

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
            'title' => 'string|max:255|required',
            'body' => 'nullable|string|max:255',
            'layout' => ['required', Rule::in($this->layout_options)],
            'sensitive' => 'nullable|string|max:2048',
            'status' => 'nullable|string|max:2048'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'A title is required.',
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
            if (isset($this->user_id) && $this->user_id != \Auth::id()) {
                $validator->errors()->add('user_id', 'Your User ID does not match your authorisation token.');
            }
        });

        return;
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DailyworkentryRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
       
        return [
            'project_id' => ['required'],
            'description' => ['required'],
        ];
    }
    public function messages()
    {
        return [
            'project_id.required' => 'Project  Name is Required!',
            'description.required' => 'Description is required!',
        ];
    }
}

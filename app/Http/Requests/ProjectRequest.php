<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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
            'technology_name' => ['required'],
            'project_name' => ['required'],
        ];
    }
    public function messages()
    {
        return [
            'technology_name.required' => 'Technology Name is Required!',
            'project_name.required' => 'Project Name is Required!',
        ];
    }
}

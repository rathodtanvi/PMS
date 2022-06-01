<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectAllotmentRequest extends FormRequest
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
            'unm' => ['required'],
            'projectnm' => ['required'],
            'technm' => ['required'],
        ];
    }
    public function messages()
    {
        return [
            'unm.required' => 'Employee Name is Required!',
            'projectnm.required' => 'Project Name is Required!',
            'technm.required' => 'Technology Name is Required!',
        ];
    }
}

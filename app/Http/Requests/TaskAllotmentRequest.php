<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskAllotmentRequest extends FormRequest
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
            'user_id' => ['required'],
            'project_id' => ['required'],
            'title' => ['required'], 
            'days_txt' => ['required'],
            'hours_txt' => ['required'],
            'description' => ['required'],
        ];
    }
    public function messages()
    {
        return [
            'user_id.required'=>'Employee Name is required!',   
            'project_id.required'=>'Project Name is required!',
            'title.required'=>'title required!',
            'days_txt.required'=>'Days is required!',
            'hours_txt.required' => 'Hours is required!',
            'description.required'=>'Description is required!',
        ];
    }
}

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
            //'user_id' => ['required'],
            'project_id' => ['required'],
            'title' => ['required'], 
            'days_txt' => ['required_without:hours_txt'],
            'hours_txt' => ['required_without:days_txt'],
            'description' => ['required'],
        ];
    }
    public function messages()
    {
        return [
           // 'user_id.required'=>'Employee Name is required!',   
            'project_id.required'=>'Project Name is required!',
            'title.required'=>'title required!',
            'days_txt.required_without'=>'Days is required!',
             'hours_txt.required_without' => 'Hours is required!',
            'description.required'=>'Description is required!',
        ];
    }
}

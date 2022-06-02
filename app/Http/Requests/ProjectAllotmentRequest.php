<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

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
        if(Auth::user()->roles_id == 1 || Auth::user()->roles_id == 2)
        {
            return [
                'unm' => ['required'],
                'projectnm' => ['required'],
                'technology_id' => ['required'],
            ];
        }
        else
        {
            return [
                'projectnm' => ['required'],
                'technology_id' => ['required'],
            ];
        }
        
    }
    public function messages()
    {
        if(Auth::user()->roles_id == 1 || Auth::user()->roles_id == 2)
        {
            return [
                'unm.required' => 'Employee Name is Required!',
                'projectnm.required' => 'Project Name is Required!',
                'technology_id.required' => 'Technology Name is Required!',
            ];
        }
        else
        {
            return [
                'projectnm.required' => 'Project Name is Required!',
                'technology_id.required' => 'Technology Name is Required!',
            ];
        }
    }
}

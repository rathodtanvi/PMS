<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LeaveRequest extends FormRequest
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
            'leave_type' => ['required'],
            'subject'=>['required'],
            'date_start'=>['required'],
            'message'=>['required'],
        ];
    }
    public function messages()
    {
        return [
            'leave_type.required'=>'leave type is required!',
            'subject.required'=>'subject is required!',
            'date_start.required' => 'date is required!',
            'message.required'=>'message is required!',
        ];
    }
}

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
            'leave_type' => ['leave_type'],
            'half_leave_type' => ['half_leave_type'],
            'subject'=>['subject'],
            'date_start'=>['date_start'],
            'date_end'=>['date_end'],
            'leave_status'=>['leave_status'],
            'message'=>['message'],
            'approve'=>['approve'],
        ];
    }
    public function messages()
    {
        return [
            'date_start.required' => 'date is required!',
        ];
    }
}

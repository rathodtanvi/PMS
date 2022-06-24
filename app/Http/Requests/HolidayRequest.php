<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HolidayRequest extends FormRequest
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
        'name'=>'required',
       // 'start_date' => 'required',
        'start_date' => 'required|date|before:end_date',
        'end_date' => 'date|after:start_date'
    ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Holiday  Name is Required!',
            'start_date.required' => 'Start Date is required!',
          //  'end_date.required' => 'End Date is required!',
        ];
    }
}

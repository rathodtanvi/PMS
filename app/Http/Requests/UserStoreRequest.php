<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'mobile_number'=>['required','regex:/^([0-9\s\-\+\(\)]*)$/','min:10'],
            'dob'=>['required','date','date_format:Y-m-d','before:today'],
            'joining_date'=>['required','date','date_format:Y-m-d'],
            'gender'=>['required'],
            'qualification'=>['required'],
            'address'=>['required']
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Name is required!',
            'email.required' => 'Email is required!',
            'password.required' => 'Password is required!',
            'mobile_number.required' => 'MobileNumber is required!',
            'dob.required' => 'Birthdate is required!',
            'joining_date.required' => 'joiningDate is required!',
            'gender.required' => 'gender is required!',
            'qualification.required' => 'Qualification is required!',
            'address.required' => 'address is required!',
        ];
    }
}

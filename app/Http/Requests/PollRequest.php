<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class PollRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'username'                  => 'required',
            'password'                  => 'required',
            'user_type'                 => 'required|in:CUSTOMER,EMPLOYEE',
        ];
    }

    public function messages()
    {
        return [
            'user_type.in'              => trans('validation.loginUsertypeNotValid'),
        ];
    }

}

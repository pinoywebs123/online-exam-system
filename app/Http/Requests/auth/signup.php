<?php

namespace App\Http\Requests\auth;

use Illuminate\Foundation\Http\FormRequest;

class signup extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'fname' => 'required|max:20',
            'mname'  => 'required|max:20',
            'lname'  => 'required|max:20|unique:users',
            'email'  => 'required|unique:users',
            'contact'  => 'required|max:15',
            'username'  => 'required|max:12|unique:users',
            'password'  => 'required|max:12',
            'repeat_password'  => 'required|max:12|same:password'
        ];
    }
}

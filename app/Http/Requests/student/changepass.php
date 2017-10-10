<?php

namespace App\Http\Requests\student;

use Illuminate\Foundation\Http\FormRequest;

class changepass extends FormRequest
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
            'new_password' => 'required|max:12',
            'repeat_new_password' => 'required|same:new_password'
        ];
    }
}

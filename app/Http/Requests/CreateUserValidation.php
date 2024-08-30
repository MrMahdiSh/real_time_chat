<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserValidation extends FormRequest
{

    public function rules()
    {
        return [
            'name' => 'required|max:191',
            'family' => 'required|max:191',
            'username' => [
                'required',
                'min:4',
                'max:191',

//                'unique:users,username' . $this->id
            ],
            'password' => 'required|min:4|max:191|required_with:password_confirmation|confirmed',
            'email' => 'required|email',
            'mobile' => 'digits:11|required',
        ];
    }
}

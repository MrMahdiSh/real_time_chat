<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserValidation extends FormRequest
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
//                'unique:users,username'
//                'unique:users,username' . $this->id
            ],
            'email' => 'required|max:191|min:6|email',
            'mobile' => 'digits:11|required',
        ];
    }
}

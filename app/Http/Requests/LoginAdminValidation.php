<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginAdminValidation extends FormRequest
{

    public function rules()
    {
        return [
            'username'=>'required',
            'password'=>'required',
        ];
    }
}

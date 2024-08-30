<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateRoleValidation extends FormRequest
{

    public function rules()
    {
        return [
            'name' => 'required|max:191',
            'display_name' => 'required|max:191',
            'roles' => 'required',

        ];
    }
}

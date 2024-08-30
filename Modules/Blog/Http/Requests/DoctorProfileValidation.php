<?php

namespace Modules\Blog\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DoctorProfileValidation extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required',
            'family' => 'required',
            'mobile' => 'digits:11|required',
            'gender' => 'required',
            'birth_day' => 'required',
            'clinic_id' => 'required',
            'state_id' => 'required',
            'city_id' => 'required',
            'lang_map' => 'required',
            'lat_map' => 'required',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}

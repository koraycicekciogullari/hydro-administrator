<?php

namespace Koraycicekciogullari\HydroAdministrator\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{

    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return string[][]
     */
    public function rules(): array
    {
        return [
            'email'     =>  ['required', 'email'],
            'password'  =>  ['required'],
            'token'     =>  ['required']
        ];
    }
}

<?php

namespace Koraycicekciogullari\HydroAdministrator\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class PasswordUpdateRequest extends FormRequest
{

    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return Auth::user()->can('administrator update') || Auth::user()->hasAnyRole(['root', 'admin']);
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'password' =>  ['required', 'confirmed', 'max:255', 'min:8']
        ];
    }
}

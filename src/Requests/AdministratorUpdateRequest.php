<?php

namespace Koraycicekciogullari\HydroAdministrator\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AdministratorUpdateRequest extends FormRequest
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
            'email'          => ['required', 'email', Rule::unique('users', 'email')->ignore($this->request->get('id'))],
            'name'           => ['required', 'string', 'min:4', 'max:250'],
            'password_reset' => ['boolean'],
        ];
    }
}

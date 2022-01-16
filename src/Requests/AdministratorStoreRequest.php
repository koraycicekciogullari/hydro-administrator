<?php

namespace Koraycicekciogullari\HydroAdministrator\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AdministratorStoreRequest extends FormRequest
{

    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return Auth::user()->can('administrator store') || Auth::user()->hasAnyRole(['root', 'admin']);
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'name'  => ['required', 'string', 'min:4', 'max:250']
        ];
    }
}

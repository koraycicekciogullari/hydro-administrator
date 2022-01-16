<?php

namespace Koraycicekciogullari\HydroAdministrator\Requests;

use Auth;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use function auth;

class AdminProfileUpdateRequest extends FormRequest
{

    /**
     * @return Authenticatable
     */
    public function authorize(): Authenticatable
    {
        return auth()->user();
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'name'  =>  ['string', 'required', 'max:255', 'min:4'],
            'email' =>  ['email', 'required', Rule::unique('users', 'email')->ignore(Auth::user()->id)]
        ];
    }
}

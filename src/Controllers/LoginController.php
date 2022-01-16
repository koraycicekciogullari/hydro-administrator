<?php

namespace Koraycicekciogullari\HydroAdministrator\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;
use Koraycicekciogullari\HydroAdministrator\Models\User;
use Koraycicekciogullari\HydroAdministrator\Requests\LoginRequest;
use function config;
use function response;

class LoginController extends Controller
{

    /**
     * @param LoginRequest $request
     * @return JsonResponse
     * @throws AuthenticationException
     */
    public function __invoke(LoginRequest $request): JsonResponse
    {
        if($this->googleReCaptcha($request->get('token'))){
            throw new AuthenticationException();
        }
        if(!auth()->attempt($request->only('email', 'password'))){
            throw new AuthenticationException();
        }
        return response()->json(User::find($request->user()->id));
    }

    /**
     * @param $token
     * @return bool
     */
    private function googleReCaptcha($token): bool
    {
        return !Http::get('https://www.google.com/recaptcha/api/siteverify?secret='.config('values.google_recaptcha_secret_key').'&response=' . $token)->json()['success'];
    }

}

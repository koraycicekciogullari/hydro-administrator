<?php

namespace Koraycicekciogullari\HydroAdministrator\Controllers;

use App\Http\Controllers\Controller;
use Auth;
use Hash;
use Illuminate\Http\JsonResponse;
use Koraycicekciogullari\HydroAdministrator\Models\User;
use Koraycicekciogullari\HydroAdministrator\Requests\PasswordUpdateRequest;
use function response;

class PasswordController extends Controller
{

    /**
     * @param PasswordUpdateRequest $request
     * @return JsonResponse
     */
    public function __invoke(PasswordUpdateRequest $request): JsonResponse
    {
        return response()->json(User::whereId(Auth::user()->id)->update([
            'password' => Hash::make($request->get('password'))
        ]));
    }
}

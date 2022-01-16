<?php

namespace Koraycicekciogullari\HydroAdministrator\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Auth;
use function response;

class LogoutController extends Controller
{

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        Auth::guard('web')->logout();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }
}

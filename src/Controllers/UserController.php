<?php

namespace Koraycicekciogullari\HydroAdministrator\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Koraycicekciogullari\HydroAdministrator\Models\User;
use function response;

class UserController extends Controller
{

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        return response()->json(User::with(['permissions', 'roles'])->find($request->user()->id));
    }
}

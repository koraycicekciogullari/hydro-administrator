<?php

namespace Koraycicekciogullari\HydroAdministrator\Controllers;

use App\Http\Controllers\Controller;
use Koraycicekciogullari\HydroAdministrator\Models\User;
use Koraycicekciogullari\HydroAdministrator\Requests\AdminProfileUpdateRequest;
use Koraycicekciogullari\HydroAdministrator\Resources\ProfileResource;
use function auth;

class ProfileController extends Controller
{

    /**
     * @return ProfileResource
     */
    public function index(): ProfileResource
    {
        return new ProfileResource(auth()->user());
    }

    /**
     * @param AdminProfileUpdateRequest $adminProfileUpdateRequest
     * @param $id
     * @return ProfileResource
     */
    public function update(AdminProfileUpdateRequest $adminProfileUpdateRequest, $id): ProfileResource
    {
        User::whereId($id)->update($adminProfileUpdateRequest->validated());
        return new ProfileResource(auth()->user());
    }

}

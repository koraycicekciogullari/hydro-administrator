<?php

namespace Koraycicekciogullari\HydroAdministrator\Controllers;

use App\Http\Controllers\Controller;
use Arr;
use Koraycicekciogullari\HydroAdministrator\Helpers\AdminPanelHelpers;
use Koraycicekciogullari\HydroAdministrator\Models\User;
use Koraycicekciogullari\HydroAdministrator\Notifications\AdministratorCreated;
use Koraycicekciogullari\HydroAdministrator\Requests\AdministratorStoreRequest;
use Koraycicekciogullari\HydroAdministrator\Requests\AdministratorUpdateRequest;
use Koraycicekciogullari\HydroAdministrator\Resources\AdministratorCollection;
use Koraycicekciogullari\HydroAdministrator\Resources\AdministratorResource;
use Notification;
use Str;

class AdministratorController extends Controller
{

    public function __construct()
    {
        $this->middleware('role_or_permission:admin|root|administrator index')->only(['index']);
        $this->middleware('role_or_permission:admin|root|administrator store')->only(['store']);
        $this->middleware('role_or_permission:admin|root|administrator show')->only(['show']);
        $this->middleware('role_or_permission:admin|root|administrator update')->only(['update']);
        $this->middleware('role_or_permission:admin|root|administrator destroy')->only(['destroy']);
    }

    /**
     * @return AdministratorCollection
     */
    public function index(): AdministratorCollection
    {
        return new AdministratorCollection(User::all()->load('roles'));
    }

    /**
     * @param AdministratorStoreRequest $request
     * @return AdministratorResource
     */
    public function store(AdministratorStoreRequest $request): AdministratorResource
    {
        $random_password = Str::random('16');
        $user = User::create(array_merge($request->validated(), ['password' => (new AdminPanelHelpers())->makePassword($random_password)]));
        Notification::send($user, new AdministratorCreated($random_password, $user->email));
        return new AdministratorResource($user->load(['roles', 'permissions']));
    }

    /**
     * @param $id
     * @return AdministratorResource
     */
    public function show($id): AdministratorResource
    {
        return new AdministratorResource(User::findOrFail($id)->load(['roles', 'permissions']));
    }

    /**
     * @param AdministratorUpdateRequest $request
     * @param $id
     * @return AdministratorResource
     */
    public function update(AdministratorUpdateRequest $request, $id): AdministratorResource
    {
        $random_password = Str::random('16');
        $data = [
            'email'     =>  $request->get('email'),
            'name'      =>  $request->get('name'),
            'password'  => (new AdminPanelHelpers())->makePassword($random_password)
        ];
        User::find($id)->update($request->get('password_reset') ? $data : Arr::except($data, ['password']));
        if($request->get('password_reset')){
            Notification::send(User::find($id), new AdministratorCreated($random_password, $data['email']));
        }
        return new AdministratorResource(User::find($id)->load(['roles', 'permissions']));
    }

    /**
     * @param $id
     */
    public function destroy($id)
    {
        User::find($id)->delete();
    }
}

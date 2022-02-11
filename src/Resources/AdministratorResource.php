<?php

namespace Koraycicekciogullari\HydroAdministrator\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

/**
 * @property mixed $updated_at
 * @property mixed $name
 * @property mixed $id
 * @property mixed $email_verified_at
 * @property mixed $email
 * @property mixed $created_at
 * @property mixed $roles
 * @property mixed $permissions
 */
class AdministratorResource extends JsonResource
{

    public function toArray($request): array
    {
        return [
            'id'                =>  $this->id,
            'email'             =>  $this->email,
            'email_verified_at' =>  $this->email_verified_at,
            'name'              =>  $this->name,
            'created_at'        =>  $this->created_at,
            'updated_at'        =>  $this->updated_at,
            'roles'             =>  $this->roles,
            'permissions'       =>  $this->permissions,
            'all_roles'         =>  Role::all(),
            'all_permissions'   =>  Permission::all(),
        ];
    }
}

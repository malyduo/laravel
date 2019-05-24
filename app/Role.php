<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Role extends \Spatie\Permission\Models\Role
{
    protected $table = 'roles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'guard_name', 'label',
    ];

    public function getRolePermissionsArray($id){
        $role = Role::findById($id);
        $role_permissions = $role->permissions;
        $role_permissions_array = [];
        foreach($role_permissions as $role_permission){
            array_push($role_permissions_array, $role_permission->id);
        }

        return $role_permissions_array;
    }
}

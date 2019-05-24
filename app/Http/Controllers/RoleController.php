<?php

namespace App\Http\Controllers;

use App\Module;
use App\Permission;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;

class RoleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:super_admin');
    }

    /**
     * Show the roles list.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function rolesList()
    {
        //$roles = Role::all();
        //$roles = json_decode($roles)->paginate(1);

        $roles = DB::table('roles')->paginate(30);

        $data = [
            'roles' => $roles,
        ];

        return view('admin.roles.list')->with($data);
    }

    /**
     * Add new role.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function addRole(Request $request)
    {
        $permissions = Permission::all();
        $modules = Module::all();

        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'name' => 'required|min:2|max:255',
                'label' => 'required|min:2|max:255',
                'guard_name' => 'required|min:2|max:255',
            ]);

            if ($validator->fails()) {
                $errors = $validator->errors();
                return Redirect::back()->withErrors($errors);
            } else {
                $role = Role::create([
                    'name' => Input::get('name'),
                    'label' => Input::get('label'),
                    'guard_name' => Input::get('guard_name'),
                ]);

                $role_permissions = Input::get('permissions');
                $role->syncPermissions($role_permissions);

                // redirect
                return Redirect::to(route('admin.roles'));
            }
        }

        $data = [
            'permissions' => $permissions,
            'modules' => $modules,
        ];

        return view('admin.roles.add')->with($data);
    }

    /**
     * Edit role.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function editRole($id, Request $request)
    {
        $moduleRole = new Role();
        $modules = Module::all();

        $role = Role::find($id);
        $permissions = Permission::all();
        $role_permissions = $moduleRole->getRolePermissionsArray($id);


        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'name' => 'required|min:2|max:255',
                'label' => 'required|min:2|max:255',
                'guard_name' => 'required|min:2|max:255',
            ]);

            if ($validator->fails()) {
                $errors = $validator->errors();
                return Redirect::back()->withErrors($errors);
            } else {
                $role->name = Input::get('name');
                $role->label = Input::get('label');
                $role->guard_name = Input::get('guard_name');

                $role_permissions = Input::get('permissions');
                $role->syncPermissions($role_permissions);

                $role->save();
                $request->session()->flash('status', 'Zaktualizowano pomyślnie!');
            }
        }

        $data = [
            'role' => $role,
            'permissions' => $permissions,
            'role_permissions' => $role_permissions,
            'modules' => $modules,
        ];

        return view('admin.roles.edit')->with($data);
    }

    /**
     * Delete role.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function deleteRole(Request $request)
    {
        $success = false;

        if ($request->isMethod('get')) {
            $id = $request->query('id');
            $role = Role::find($id);
            $result = $role->delete();

            if ($result) {
                $success = true;
            }
        }

        return json_encode($success);
    }
}

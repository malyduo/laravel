<?php

namespace App\Http\Controllers;

use App\Module;
use App\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;

class PermissionController extends Controller
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
     * Show the permission list.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function permissionList()
    {
        $permissions = DB::table('permissions')->paginate(30);

        $data = [
            'permissions' => $permissions,
        ];

        return view('admin.permissions.list')->with($data);
    }

    /**
     * Add new permission.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function addPermission(Request $request)
    {
        $modules = Module::all();

        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'name' => ['required', 'string', 'min:2', 'max:255', 'unique:permissions'],
                'label' => ['required', 'string', 'min:2', 'max:255', 'unique:permissions'],
                'guard_name' => 'required|min:2|max:255',
                'module' => 'required|integer',
            ]);

            if ($validator->fails()) {
                $errors = $validator->errors();
                return Redirect::back()->withErrors($errors)->withInput();
            } else {
                $permission = Permission::create([
                    'name' => Input::get('name'),
                    'label' => Input::get('label'),
                    'guard_name' => Input::get('guard_name'),
                    'id_module'  => Input::get('module'),
                ]);

                // redirect
                return Redirect::to(route('admin.permissions'));
            }
        }

        $data = [
            'modules' => $modules,
        ];

        return view('admin.permissions.add')->with($data);
    }

    /**
     * Edit permission.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function editPermission($id, Request $request)
    {
        $permission = Permission::find($id);
        $modules = Module::all();

        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'name' => ['required', 'string', 'min:2', 'max:255'],
                'label' => ['required', 'string', 'min:2', 'max:255'],
                'guard_name' => 'required|min:2|max:255',
                'module' => 'required|integer',
            ]);

            if ($validator->fails()) {
                $errors = $validator->errors();
                return Redirect::back()->withErrors($errors)->withInput();
            } else {
                $permission->name = Input::get('name');
                $permission->label = Input::get('label');
                $permission->guard_name = Input::get('guard_name');
                $permission->id_module = Input::get('module');

                $permission->save();

                // redirect
                $request->session()->flash('status', 'Zaktualizowano pomyślnie!');
            }
        }

        $data = [
            'permission' => $permission,
            'modules' => $modules,
        ];

        return view('admin.permissions.edit')->with($data);
    }

    /**
     * Delete role.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function deletePermission(Request $request)
    {
        $success = false;

        if ($request->isMethod('get')) {
            $id = $request->query('id');
            $role = Permission::find($id);
            $result = $role->delete();

            if ($result) {
                $success = true;
            }
        }

        return json_encode($success);
    }
}

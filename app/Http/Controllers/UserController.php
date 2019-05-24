<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Show the roles list.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function userList() {
        if (!Gate::allows('users_list')) {
            return abort(403);
        }

        $users = DB::table('users')->paginate(30);

        $data = [
            'users' => $users,
        ];

        return view('admin.users.list')->with($data);
    }

    /**
     * Add new user.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function addUser(Request $request) {
        if (!Gate::allows('users_add')) {
            return abort(403);
        }

        $roles = Role::all();

        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                        'name' => ['required', 'string', 'max:255'],
                        'lastname' => ['required', 'string', 'max:255'],
                        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                        'password' => ['required', 'string', 'min:6', 'confirmed'],
            ]);

            if ($validator->fails()) {
                $errors = $validator->errors();
                return Redirect::back()->withErrors($errors)->withInput();
            } else {
                $user = User::create([
                            'email' => Input::get('email'),
                            'name' => Input::get('name'),
                            'lastname' => Input::get('lastname'),
                            'password' => Hash::make(Input::get('password')),
                ]);

                $user->assignRole(Input::get('role'));

                // redirect
                return Redirect::to(route('admin.users'));
            }
        }

        $data = [
            'roles' => $roles,
        ];

        return view('admin.users.add')->with($data);
    }

    /**
     * Add new user.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function editUser($id, Request $request) {
        if (!Gate::allows('users_edit')) {
            return abort(403);
        }
        
        $roles = Role::all();
        $user = User::find($id);

        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                        'name' => ['required', 'string', 'max:255'],
                        'lastname' => ['required', 'string', 'max:255'],
                            //'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                            //'password' => ['required', 'string', 'min:6', 'confirmed'],
            ]);

            $validator->after(function ($validator) use ($request) {
                if (!empty($request->password)) {
                    $validator_password = Validator::make($request->all(), [
                                'password' => ['required', 'string', 'min:6', 'confirmed'],
                    ]);
                    if ($validator_password->fails()) {
                        $validator->errors()->add('password', __('validation.confirmed', ['attribute' => __('password')]));
                    }
                }
            });

            if ($validator->fails()) {
                $errors = $validator->errors();
                return Redirect::back()->withErrors($errors)->withInput();
            } else {
                $user->name = Input::get('name');
                $user->lastname = Input::get('lastname');
                $user->password = Hash::make(Input::get('password'));

                $user->syncRoles(Input::get('role'));
                $user->save();

                $request->session()->flash('status', 'Zaktualizowano pomyślnie!');
            }
        }

        $user->role_id = $user->roles->pluck('id')[0];

        $data = [
            'user' => $user,
            'roles' => $roles,
        ];

        return view('admin.users.edit')->with($data);
    }

    /**
     * Delete user.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function deleteUser(Request $request) {
        if (!Gate::allows('users_delete')) {
            return abort(403);
        }
        
        $success = false;

        if ($request->isMethod('get')) {
            $id = $request->query('id');
            $user = User::find($id);
            $result = $user->delete();

            if ($result) {
                $success = true;
            }
        }

        return json_encode($success);
    }

    /**
     * Change user client.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function changeUserClient(Request $request) {
        $success = false;

        if ($request->isMethod('post')) {
            $id = $request->post('id');
            $user = User::find($id);
            if ($user) {
                $user->id_client = $request->post('id_client');
                $result = $user->save();

                if ($result) {
                    $success = true;
                }
            }
        }

        return json_encode($success);
    }

}

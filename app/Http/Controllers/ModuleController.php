<?php

namespace App\Http\Controllers;

use App\Module;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class ModuleController extends Controller
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
     * Show the module list.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function moduleList()
    {
        $modules = DB::table('modules')->paginate(30);

        $data = [
            'modules' => $modules,
        ];

        return view('admin.modules.list')->with($data);
    }

    /**
     * Add new module.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function addModule(Request $request)
    {
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'name' => ['required', 'string', 'min:2', 'max:255', 'unique:modules'],
            ]);

            if ($validator->fails()) {
                $errors = $validator->errors();
                return Redirect::back()->withErrors($errors)->withInput();
            } else {
                $module = Module::create([
                    'name' => Input::get('name'),
                ]);

                // redirect
                return Redirect::to(route('admin.modules'));
            }
        }

        return view('admin.modules.add');
    }

    /**
     * Edit module.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function editModule($id, Request $request)
    {
        $module = Module::find($id);

        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'name' => ['required', 'string', 'min:2', 'max:255'],
            ]);

            if ($validator->fails()) {
                $errors = $validator->errors();
                return Redirect::back()->withErrors($errors)->withInput();
            } else {
                $module->name = Input::get('name');

                $module->save();

                // redirect
                $request->session()->flash('status', 'Zaktualizowano pomyślnie!');
            }
        }

        $data = [
            'module' => $module,
        ];

        return view('admin.modules.edit')->with($data);
    }

    /**
     * Delete module.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function deleteModule(Request $request)
    {
        $success = false;

        if ($request->isMethod('get')) {
            $id = $request->query('id');
            $role = Module::find($id);
            $result = $role->delete();

            if ($result) {
                $success = true;
            }
        }

        return json_encode($success);
    }
}

<?php

namespace App\Http\Controllers;

use App\Allergen;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class AllergenController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Show the allergens list.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function allergenList() {
        $allergens = DB::table('allergens')->paginate(30);

        $data = [
            'allergens' => $allergens,
        ];

        return view('admin.allergens.list')->with($data);
    }

    /**
     * Add new allergens.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function addAllergen(Request $request) {
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                        'name' => ['required', 'string', 'min:2', 'max:255', 'unique:allergens'],
            ]);

            if ($validator->fails()) {
                $errors = $validator->errors();
                return Redirect::back()->withErrors($errors)->withInput();
            } else {
                $allergens = Allergen::create([
                            'name' => Input::get('name'),
                ]);

                // redirect
                return Redirect::to(route('admin.allergens'));
            }
        }

        return view('admin.allergens.add');
    }

    /**
     * Edit allergens.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function editAllergen($id, Request $request) {
        $allergen = Allergen::find($id);

        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                        'name' => ['required', 'string', 'min:2', 'max:255'],
            ]);

            if ($validator->fails()) {
                $errors = $validator->errors();
                return Redirect::back()->withErrors($errors)->withInput();
            } else {
                $allergen->name = Input::get('name');

                $allergen->save();

                // redirect
                $request->session()->flash('status', 'Zaktualizowano pomyślnie!');
            }
        }

        $data = [
            'allergen' => $allergen,
        ];

        return view('admin.allergens.edit')->with($data);
    }

    /**
     * Delete allergens.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function deleteAllergen(Request $request) {
        $success = false;

        if ($request->isMethod('get')) {
            $id = $request->query('id');
            $role = Allergen::find($id);
            $result = $role->delete();

            if ($result) {
                $success = true;
            }
        }

        return json_encode($success);
    }

}

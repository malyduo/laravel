<?php

namespace App\Http\Controllers;

use App\MenuFood;
use App\Allergen;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Gate;

class MenuFoodController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Show the menu-foods list.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function menuFoodList() {
        if (!Gate::allows('catering_foods_list')) {
            return abort(403);
        }
        
        $id_client = Auth::user()->id_client;
        $menu_foods = DB::table('menu_foods')->where('id_client', $id_client)->paginate(30);

        $data = [
            'menu_foods' => $menu_foods,
        ];

        return view('panel.catering.foods.list')->with($data);
    }

    /**
     * Add new menu-foods.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function addMenuFood(Request $request) {
        if (!Gate::allows('catering_foods_add')) {
            return abort(403);
        }
        
//        $allergens = DB::table('allergens')->get();
        $allergens = Allergen::all();

        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                        'name' => ['required', 'string', 'min:2', 'max:255'],
                        'kcal' => ['sometimes', 'nullable', 'integer'],
                        'description' => ['required'],
            ]);

            if ($validator->fails()) {
                $errors = $validator->errors();
                return Redirect::back()->withErrors($errors)->withInput();
            } else {
                $id_allergens = Input::get('id_allergens');
                if (!empty($id_allergens))
                    $id_allergens = implode(',', $id_allergens);

                $menu_foods = MenuFood::create([
                            'name' => Input::get('name'),
                            'kcal' => Input::get('kcal'),
                            'id_allergens' => $id_allergens,
                            'description' => Input::get('description'),
                            'id_client' => Auth::user()->id_client,
                ]);

                // redirect
                return Redirect::to(route('catering.foods'));
            }
        }

        $data = [
            'allergens' => $allergens
        ];


        return view('panel.catering.foods.add')->with($data);
    }

    /**
     * Edit menu-foods.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function editMenuFood($id, Request $request) {
        if (!Gate::allows('catering_foods_edit')) {
            return abort(403);
        }
        
        $menu_foods = MenuFood::find($id);
        $allergens = DB::table('allergens')->get();

        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                        'name' => ['required', 'string', 'min:2', 'max:255'],
                        'kcal' => ['sometimes', 'nullable', 'integer'],
                        'description' => ['required'],
            ]);

            if ($validator->fails()) {
                $errors = $validator->errors();
                return Redirect::back()->withErrors($errors)->withInput();
            } else {
                $menu_foods->name = Input::get('name');
                $menu_foods->kcal = Input::get('kcal');
                $menu_foods->description = Input::get('description');
                $id_allergens = Input::get('id_allergens');
                if (!empty($id_allergens))
                    $id_allergens = implode(',', $id_allergens);
                $menu_foods->id_allergens = $id_allergens;
                $menu_foods->save();

                // redirect
                $request->session()->flash('status', 'Zaktualizowano pomyślnie!');
            }
        }

        $allergens_selected = explode(',', $menu_foods->id_allergens);

        $data = [
            'menu_foods' => $menu_foods,
            'allergens' => $allergens,
            'allergens_selected' => $allergens_selected
        ];

        return view('panel.catering.foods.edit')->with($data);
    }

    /**
     * Delete menu-foods.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function deleteMenuFood(Request $request) {
        if (!Gate::allows('catering_foods_delete')) {
            return abort(403);
        }
        
        $success = false;

        if ($request->isMethod('get')) {
            $id = $request->query('id');
            $food = MenuFood::find($id);
            $result = $food->delete();

            if ($result) {
                $success = true;
            }
        }

        return json_encode($success);
    }

}

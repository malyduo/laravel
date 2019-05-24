<?php

namespace App\Http\Controllers;

use App\MenuCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class MenuCategoryController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Show the menu-categories list.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function menuCategoryList() {
        $menu_categories = DB::table('menu_categories')->paginate(30);

        $data = [
            'menu_categories' => $menu_categories,
        ];

        return view('admin.menu-categories.list')->with($data);
    }

    /**
     * Add new menu-categories.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function addMenuCategory(Request $request) {
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                        'name' => ['required', 'string', 'min:2', 'max:255', 'unique:menu_categories'],
            ]);

            if ($validator->fails()) {
                $errors = $validator->errors();
                return Redirect::back()->withErrors($errors)->withInput();
            } else {
                $menu_categories = MenuCategory::create([
                            'name' => Input::get('name'),
                ]);

                // redirect
                return Redirect::to(route('admin.menu-categories'));
            }
        }

        return view('admin.menu-categories.add');
    }

    /**
     * Edit menu-categories.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function editMenuCategory($id, Request $request) {
        $menu_category = MenuCategory::find($id);

        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                        'name' => ['required', 'string', 'min:2', 'max:255'],
            ]);

            if ($validator->fails()) {
                $errors = $validator->errors();
                return Redirect::back()->withErrors($errors)->withInput();
            } else {
                $menu_category->name = Input::get('name');

                $menu_category->save();

                // redirect
                $request->session()->flash('status', 'Zaktualizowano pomyślnie!');
            }
        }

        $data = [
            'menu_category' => $menu_category,
        ];

        return view('admin.menu-categories.edit')->with($data);
    }

    /**
     * Delete menu-categories.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function deleteMenuCategory(Request $request) {
        $success = false;

        if ($request->isMethod('get')) {
            $id = $request->query('id');
            $role = MenuCategory::find($id);
            $result = $role->delete();

            if ($result) {
                $success = true;
            }
        }

        return json_encode($success);
    }

}

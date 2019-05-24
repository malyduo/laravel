<?php

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/dashboard', 'HomeController@index')->name('dashboard');

Route::group(['prefix' => 'admin'], function () {
    Route::get('/dashboard', 'AdminController@index')->name('admin.dashboard');

    //users
    Route::get('/users', 'UserController@userList')->name('admin.users');
    Route::get('/user/delete', 'UserController@deleteUser')->name('admin.users.delete');
    Route::match(array('GET', 'POST'), '/user/add', 'UserController@addUser')->name('admin.users.add');
    Route::match(array('GET', 'POST'), '/user/edit/{id}', 'UserController@editUser')->name('admin.users.edit');
    Route::match(array('GET', 'POST'), '/user/change-client', 'UserController@changeUserClient')->name('admin.users.changeclient');

    //roles
    Route::get('/roles', 'RoleController@rolesList')->name('admin.roles');
    Route::get('/role/delete', 'RoleController@deleteRole')->name('admin.roles.delete');
    Route::match(array('GET', 'POST'), '/roles/edit/{id}', 'RoleController@editRole')->name('admin.roles.edit');
    Route::match(array('GET', 'POST'), '/roles/add', 'RoleController@addRole')->name('admin.roles.add');

    //permissions
    Route::get('/permissions', 'PermissionController@permissionList')->name('admin.permissions');
    Route::get('/permission/delete', 'PermissionController@deletePermission')->name('admin.permissions.delete');
    Route::match(array('GET', 'POST'), '/permission/edit/{id}', 'PermissionController@editPermission')->name('admin.permissions.edit');
    Route::match(array('GET', 'POST'), '/permission/add', 'PermissionController@addPermission')->name('admin.permissions.add');

    //modules
    Route::get('/modules', 'ModuleController@moduleList')->name('admin.modules');
    Route::get('/module/delete', 'ModuleController@deleteModule')->name('admin.modules.delete');
    Route::match(array('GET', 'POST'), '/module/edit/{id}', 'ModuleController@editModule')->name('admin.modules.edit');
    Route::match(array('GET', 'POST'), '/module/add', 'ModuleController@addModule')->name('admin.modules.add');

    //clients
    Route::get('/clients', 'ClientController@clientList')->name('admin.clients');
    Route::get('/client/delete', 'ClientController@deleteClient')->name('admin.clients.delete');
    Route::match(array('GET', 'POST'), '/client/edit/{id}', 'ClientController@editClient')->name('admin.clients.edit');
    Route::match(array('GET', 'POST'), '/client/add', 'ClientController@addClient')->name('admin.clients.add');

    //allergens
    Route::get('/allergens', 'AllergenController@allergenList')->name('admin.allergens');
    Route::get('/allergen/delete', 'AllergenController@deleteAllergen')->name('admin.allergens.delete');
    Route::match(array('GET', 'POST'), '/allergen/edit/{id}', 'AllergenController@editAllergen')->name('admin.allergens.edit');
    Route::match(array('GET', 'POST'), '/allergen/add', 'AllergenController@addAllergen')->name('admin.allergens.add');

    //menu categories
    Route::get('/menu-categories', 'MenuCategoryController@menuCategoryList')->name('admin.menu-categories');
    Route::get('/menu-category/delete', 'MenuCategoryController@deleteMenuCategory')->name('admin.menu-categories.delete');
    Route::match(array('GET', 'POST'), '/menu-category/edit/{id}', 'MenuCategoryController@editMenuCategory')->name('admin.menu-categories.edit');
    Route::match(array('GET', 'POST'), '/menu-category/add', 'MenuCategoryController@addMenuCategory')->name('admin.menu-categories.add');
});

Route::group(['prefix' => 'catering'], function () {
    //menu foods
    Route::get('/foods', 'MenuFoodController@menuFoodList')->name('catering.foods');
    Route::get('/food/delete', 'MenuFoodController@deleteMenuFood')->name('catering.foods.delete');
    Route::match(array('GET', 'POST'), '/food/edit/{id}', 'MenuFoodController@editMenuFood')->name('catering.foods.edit');
    Route::match(array('GET', 'POST'), '/food/add', 'MenuFoodController@addMenuFood')->name('catering.foods.add');
});
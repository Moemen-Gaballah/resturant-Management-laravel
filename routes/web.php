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

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('/menus', 'MenusController');
Route::resource('/items', 'ItemController');
Route::resource('/meals', 'MealsController');

//factory(App\User::class, 50)->create();
//factory(App\Menu::class, 5)->create();
//factory(App\OrderUser::class, 50)->create();
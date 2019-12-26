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
Route::view('/welcome', 'welcome');

Auth::routes();
Route::match(["GET", "POST"], "/register", function(){
    return redirect("/login");
})->name("register");

Route::get('/', 'HomeController@index')->name('home');
Route::get('/masters/create/{type}', 'MastersController@create');
Route::get('/masters/{id}/edit', 'MastersController@edit');
Route::resource('masters', 'MastersController');

Route::resource('users', 'UserController');
Route::resource('categories', 'CategoriesController');
Route::resource('masters', 'MastersController');
Route::resource('inventories', 'InventoriesController');
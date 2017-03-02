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
Auth::routes();

Route::get('/', function () {
    return view('auth.login');
})->middleware('guest');

Route::get('/home', function (){
    return redirect('/admin');
});

Route::group(['prefix' => config('backpack.base.route_prefix')], function () {

	Route::get('logout', [
		'uses'=> 'Auth\LoginController@logout',
		'as' => 'auth.logout',
	]);

    CRUD::resource('member', 'Admin\MemberCrudController');
});
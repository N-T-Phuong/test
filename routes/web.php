<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function() {
	return view('welcom');
});

Route::get('/register', 'AuthController@register')->name('auth.register');
Route::get('/login', 'AuthController@login')->name('auth.login');
Route::post('/logout', 'AuthController@logout')->name('auth.logout');
Route::post('/login', 'AuthController@submitLogin')->name('auth.login-submit');
Route::post('/register','AuthController@submitRegister')->name('auth.register-submit');

//tạo nhanh user
// Route::get('test', function (){
//     $user = new \App\Models\User;
//     $user->fullname = 'Nguyen Phuong';
//     $user->role = 1;
//     $user->email= 'phuongtkt.humg@gmail.com';
//     $user->password = bcrypt('123456789');
//     $user->save();
//     echo " create success";
// });

//group: nhóm lại cái route sử dụng chung middleware

Route::get('/', 'PageController@homepage');
Route::get('/category/{id}', 'CategoryController@show')->name('category.show');
Route::get('/posts/{id}', 'PostController@show')->name('post.show');
Route::put('posts/{id}/status', 'PostController@updateStatus')->name('post.update-status');


Route::group([
	'middleware' => 'auth',
	'prefix' => 'backend/'

], function() {

	Route::get('/', 'PostController@index')->name('dashboard');
	Route::get('/profile', 'UserController@profile')->name('user.profile');
	Route::put('/profile', 'UserController@updateProfile')->name('user.update-profile');

	Route::get('/password', 'UserController@password')->name('user.password');
	Route::put('/password', 'UserController@updatePassword')->name('user.up-password');
	
	Route::get('/posts', 'PostController@index')->name('posts.index');
	Route::post('/posts', 'PostController@store')->name('posts.store'); 

	Route::put('/posts/{id}', 'PostController@update')-> name('posts.update'); 
	Route::delete('/posts/{id}', 'PostController@destroy')-> name('posts.destroy'); 
	Route::get('/posts/{id}/edit', 'PostController@edit')-> name('posts.edit'); 

	Route::get('/posts/create', 'PostController@create')->name('posts.create');


});

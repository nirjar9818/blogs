<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('admin/home', 'HomeController@admin')->name('admin.route')->middleware('admin');


Route::resource('user','UserManagementController');
Route::get('profile','UserManagementController@profile')->name('profile');
Route::put('profile','UserManagementController@updateProfile')->name('profile.update');
Route::put('profile/password', 'UserManagementController@changePassword')->name('profile.password');
Route::resource('category','CategoryManagementController');
Route::resource('post','PostController');
Route::get('/myPost','PostController@myPost')->name('post.myPost');
Route::get('/tag/{tag}','PostController@tag')->name('post.tag');
Route::resource('contact','ContactController');

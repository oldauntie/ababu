<?php

use App\Http\Controllers\ClinicController;
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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/noauth', function () {
    return view('noauth');
})->name('noauth');


// Route::get('/home', 'ClinicController@show')->name('home');
// Route::resource('clinics', 'ClinicController')->middleware('auth')->middleware('roles:root|admin');
Route::get('clinics/join', 'ClinicController@join')->name('clinic.join')->middleware('auth');
Route::resource('clinics', 'ClinicController')->middleware('clinic_access', 'auth');
Route::resource('clinics.pets', 'PetController')->middleware('clinic_access', 'auth');

Route::get('clinics/{clinic_id}/users', 'UserController@list')->name('clinics.users.list')->middleware('clinic_access', 'auth');
// Route::resource('clinics.users', 'UserController')->middleware('clinic_access', 'auth');

Route::get('/users/ajax', 'UserController@ajax')->name('users.ajax')->middleware('auth')->middleware('roles:root|admin');
Route::resource('users', 'UserController')->middleware('auth')->middleware('roles:root');


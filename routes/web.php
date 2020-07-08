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

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/noauth', function () {
    return view('noauth');
})->name('noauth');


// Route::get('/home', 'ClinicController@show')->name('home');
// Route::resource('clinics', 'ClinicController')->middleware('auth')->middleware('roles:root|admin');
Route::get('clinics/join', 'ClinicController@join')->name('clinic.join')->middleware('auth');
Route::get('clinics/create', 'ClinicController@create')->name('clinics.create')->middleware('auth');
Route::get('clinics/{clinic}/invite', 'ClinicController@invite')->name('clinics.invite')->middleware('clinic_roles:root|admin');
Route::post('clinics/{clinic}/send', 'ClinicController@send')->name('clinics.send')->middleware('clinic_roles:root|admin');
Route::post('clinics/store', 'ClinicController@store')->name('clinics.store')->middleware('auth');
Route::resource('clinics', 'ClinicController', ['except' => ['create', 'store', 'index']])->middleware('clinic_access');


Route::get('clinics/{clinic}/users', 'UserController@list')->name('clinics.users.list')->middleware('clinic_roles:root|admin');
Route::get('clinics/{clinic}/users/{user}', 'UserController@edit')->name('clinics.users.edit')->middleware('clinic_roles:root|admin');
Route::put('clinics/{clinic}/users/{user}', 'UserController@update')->name('clinics.users.update')->middleware('clinic_roles:root|admin');

Route::get('clinics/{clinic}/species', 'SpecieController@index')->name('clinics.species.index')->middleware('clinic_roles:root|admin');

Route::resource('clinics.pets', 'PetController')->middleware('clinic_access');


Route::get('/users/ajax', 'UserController@ajax')->name('users.ajax')->middleware('auth')->middleware('roles:root|admin');
Route::resource('users', 'UserController')->middleware('auth')->middleware('roles:root');


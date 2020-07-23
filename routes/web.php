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

// clinics
Route::get('clinics/join', 'ClinicController@join')->name('clinic.join')->middleware('auth');
Route::get('clinics/create', 'ClinicController@create')->name('clinics.create')->middleware('auth');
Route::delete('clinics/{clinic}', 'ClinicController@destroy')->name('clinics.destroy')->middleware('clinic_roles:root|admin');
Route::post('clinics/{clinic}/send', 'ClinicController@send')->name('clinics.send')->middleware('clinic_roles:root|admin');
Route::post('clinics/store', 'ClinicController@store')->name('clinics.store')->middleware('auth');
Route::get('clinics/{clinic}', 'ClinicController@show')->name('clinics.show')->middleware('clinic_access');
Route::put('clinics/{clinic}', 'ClinicController@update')->name('clinics.update')->middleware('clinic_roles:root|admin');
// Route::resource('clinics', 'ClinicController', ['except' => ['create', 'store', 'index', 'edit', 'destroy']])->middleware('clinic_access');

// users
Route::get('clinics/{clinic}/users', 'UserController@list')->name('clinics.users.list')->middleware('clinic_roles:root|admin');
Route::get('clinics/{clinic}/users/{user}', 'UserController@edit')->name('clinics.users.edit')->middleware('clinic_roles:root|admin');
Route::put('clinics/{clinic}/users/{user}', 'UserController@update')->name('clinics.users.update')->middleware('clinic_roles:root|admin');

// pets
Route::resource('clinics.pets', 'PetController')->middleware('clinic_access');
Route::get('clinics/{clinic}/ajax/get/{pets}', 'PetController@search')->name('pet.get')->middleware('clinic_access');

// species
Route::resource('clinics.species', 'SpeciesController')->middleware('clinic_roles:root|admin');
Route::get('clinics/{clinic}/species/ajax/get/{species}', 'SpeciesController@jsonGetPetDetails')->name('species.get')->middleware('auth')->middleware('roles:root|admin');
Route::get('/lives/ajax/search', 'LifeController@search')->name('lives.search')->middleware('auth')->middleware('roles:root|admin');

// root: to be implemented or deprecated
Route::get('/users/ajax', 'UserController@ajaxUserList')->name('users.ajax')->middleware('roles:root');


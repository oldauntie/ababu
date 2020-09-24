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

// owners
Route::get('clinics/{clinic}/owners/search', 'OwnerController@search')->name('clinics.owners.search')->middleware('clinic_access');
Route::get('clinics/{clinic}/owners/{owner}/get', 'OwnerController@get')->name('clinics.owners.get')->middleware('clinic_access');
Route::get('clinics/{clinic}/owners/list', 'OwnerController@list')->name('clinics.owners.list')->middleware('clinic_access');
Route::resource('clinics.owners', 'OwnerController')->middleware('clinic_access');

// pets
Route::get('clinics/{clinic}/pets/{pet}/get', 'PetController@get')->name('clinics.pets.get')->middleware('clinic_access')->middleware('can:cure,pet');
Route::get('clinics/{clinic}/pets/list/{return?}', 'PetController@list')->name('clinics.pets.list')->middleware('clinic_access');
Route::get('clinics/{clinic}/owners/{owner}/pets/list/{return?}', 'PetController@listByOwner')->middleware('clinic_access');
Route::resource('clinics.pets', 'PetController')->middleware('clinic_access');

// visit
Route::get('clinics/{clinic}/visits/{pet}', 'VisitController@show')->name('clinics.visits.show')->middleware('clinic_access');
Route::get('clinics/{clinic}/pet/{pet}/problems/{problem}/get', 'ProblemController@get')->name('clinics.problems.get')->middleware('clinic_access');

// @edit
Route::get('clinics/{clinic}/pet/{pet}/problem/diagnosis/{diagnosis}', 'ProblemController@getProblemByDiagnosis')->name('clinics.problems.by.diagnosis')->middleware('clinic_access');


// diagnosis
Route::get('/diagnoses/search', 'DiagnosisController@search')->name('diagnoses.search')->middleware('auth')->middleware('roles:root|admin|veterinarian');

// examinations
Route::get('clinics/{clinic}/diagnostic_tests/search', 'DiagnosticTestController@search')->name('clinics.diagnostic_tests.search')->middleware('auth')->middleware('roles:root|admin|veterinarian');
Route::get('clinics/{clinic}/pets/{pet}/examinations/list/{problem_id?}/{return?}', 'ExaminationController@list')->name('clinics.examinations.list')->middleware('clinic_access')->middleware('can:cure,pet');

Route::get('clinics/{clinic}/pets/{pet}/examinations/create/{diagnostic_test}/{problem?}', 'ExaminationController@createExaminationByDiagnosticTest')->name('clinics.create.examination.by.diagnostic_test')->middleware('clinic_access')->middleware('can:cure,pet');
Route::get('clinics/{clinic}/pets/{pet}/examinations/edit/{examination}', 'ExaminationController@editExaminationById')->name('clinics.edit.examination.by.id')->middleware('clinic_access')->middleware('can:cure,pet');
Route::put('clinics/{clinic}/pet/{pet}/examinations/{examination}', 'ExaminationController@update')->name('clinics.examinations.update')->middleware('clinic_access')->middleware('can:cure,pet');
Route::post('clinics/{clinic}/pet/{pet}/examinations', 'ExaminationController@store')->name('clinics.examinations.store')->middleware('clinic_access')->middleware('can:cure,pet');
Route::delete('clinics/{clinic}/pets/{pet}/examinations/{examination}', 'ExaminationController@destroy')->name('clinics.examinations.destroy')->middleware('clinic_access')->middleware('can:cure,pet');

// medicines & prescriptions
Route::get('clinics/{clinic}/medicines/search', 'MedicineController@search')->name('clinics.medicines.search')->middleware('auth')->middleware('roles:root|admin|veterinarian');
Route::get('clinics/{clinic}/pets/{pet}/prescriptions/list/{problem_id?}/{return?}', 'PrescriptionController@list')->name('clinics.prescriptions.list')->middleware('clinic_access')->middleware('can:cure,pet');

Route::get('clinics/{clinic}/pets/{pet}/prescriptions/create/{medicine}/{problem?}', 'PrescriptionController@createPrescriptionByMedicine')->name('clinics.create.prescription.by.medicine')->middleware('clinic_access')->middleware('can:cure,pet');
Route::get('clinics/{clinic}/pets/{pet}/prescriptions/edit/{prescription}', 'PrescriptionController@editPrescriptionById')->name('clinics.edit.prescription.by.id')->middleware('clinic_access')->middleware('can:cure,pet');
Route::put('clinics/{clinic}/pet/{pet}/prescriptions/{prescription}', 'PrescriptionController@update')->name('clinics.prescriptions.update')->middleware('clinic_access')->middleware('can:cure,pet');
Route::post('clinics/{clinic}/pet/{pet}/prescriptions', 'PrescriptionController@store')->name('clinics.prescriptions.store')->middleware('clinic_access')->middleware('can:cure,pet');
Route::delete('clinics/{clinic}/pets/{pet}/prescriptions/{prescription}', 'PrescriptionController@destroy')->name('clinics.prescriptions.destroy')->middleware('clinic_access')->middleware('can:cure,pet');

// notes
Route::put('clinics/{clinic}/pet/{pet}/notes/{note}', 'NoteController@update')->name('clinics.notes.update')->middleware('clinic_access')->middleware('can:cure,pet');
Route::post('clinics/{clinic}/pet/{pet}/notes', 'NoteController@store')->name('clinics.notes.store')->middleware('clinic_access')->middleware('can:cure,pet');
Route::delete('clinics/{clinic}/pets/{pet}/notes/{note}', 'NoteController@destroy')->name('clinics.notes.destroy')->middleware('clinic_access')->middleware('can:cure,pet');

// problems
Route::put('clinics/{clinic}/pet/{pet}/problems/{problem}', 'ProblemController@update')->name('clinics.problems.update')->middleware('clinic_access')->middleware('can:cure,pet');
Route::post('clinics/{clinic}/pet/{pet}/problems', 'ProblemController@store')->name('clinics.problems.store')->middleware('clinic_access')->middleware('can:cure,pet');


// species
Route::get('clinics/{clinic}/species/search', 'SpeciesController@search')->name('clinics.species.search')->middleware('clinic_access');
Route::resource('clinics.species', 'SpeciesController')->middleware('clinic_roles:root|admin');
Route::get('clinics/{clinic}/species/{species}', 'SpeciesController@details')->name('species.details')->middleware('auth')->middleware('roles:root|admin');
Route::get('/animalia/search', 'AnimaliaController@search')->name('animalia.search')->middleware('auth')->middleware('roles:root|admin');

// root: to be implemented or deprecated
Route::get('/users/ajax', 'UserController@ajaxUserList')->name('users.ajax')->middleware('roles:root');


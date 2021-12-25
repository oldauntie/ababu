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

Route::get('/credits', function () {
    return view('credits');
})->name('credits');

Route::get('/links', function () {
    return view('links');
})->name('links');

Route::get('/noauth', function () {
    return view('noauth');
})->name('noauth');

Route::get('/terms', function () {
    return view('terms');
})->name('terms');

// calendar
Route::get('clinics/{clinic}/calendars/events', 'CalendarEventController@events')->name('clinics.calendars.events');
Route::get('clinics/{clinic}/calendars/show', 'CalendarEventController@show')->name('clinics.calendars.show');
Route::post('clinics/{clinic}/calendars/manage', 'CalendarEventController@manage')->name('clinics.calendars.manage');

// contacts
Route::post('contacts/store', 'ContactController@store')->name('contacts.store')->middleware('auth');

// clinics
Route::get('clinics/join', 'ClinicController@join')->name('clinics.join')->middleware('auth');
Route::get('clinics/create', 'ClinicController@create')->name('clinics.create')->middleware('auth');
Route::delete('clinics/{clinic}', 'ClinicController@destroy')->name('clinics.destroy')->middleware('clinic_roles:root|admin');
Route::post('clinics/{clinic}/send', 'ClinicController@send')->name('clinics.send')->middleware('clinic_roles:root|admin');
Route::post('clinics/store', 'ClinicController@store')->name('clinics.store')->middleware('auth');
Route::get('clinics/{clinic}', 'ClinicController@show')->name('clinics.show')->middleware('clinic_access');
Route::put('clinics/{clinic}', 'ClinicController@update')->name('clinics.update')->middleware('clinic_roles:root|admin');

// change password
Route::get('password', 'UserController@editPassword')->name('password');
Route::post('password', 'UserController@updatePassword')->name('update.password');
Route::get('profile', 'UserController@editProfile')->name('profile');
Route::post('profile', 'UserController@updateProfile')->name('update.profile');

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
Route::get('clinics/{clinic}/visits/{pet}/print','VisitController@print')->name('clinics.visits.print')->middleware('clinic_access')->middleware('can:cure,pet');
Route::get('clinics/{clinic}/pets/{pet}/problems/{problem}/get', 'ProblemController@get')->name('clinics.problems.get')->middleware('clinic_access');

// @edit
Route::get('clinics/{clinic}/pets/{pet}/problem/diagnosis/{diagnosis}', 'ProblemController@getProblemByDiagnosis')->name('clinics.problems.by.diagnosis')->middleware('clinic_access');


// diagnosis
Route::get('/diagnoses/search', 'DiagnosisController@search')->name('diagnoses.search')->middleware('auth')->middleware('roles:root|admin|veterinarian');

// examinations
Route::get('clinics/{clinic}/diagnostic_tests/search', 'DiagnosticTestController@search')->name('clinics.diagnostic_tests.search')->middleware('auth')->middleware('roles:root|admin|veterinarian');
Route::get('clinics/{clinic}/pets/{pet}/examinations/list/{problem_id?}/{return?}', 'ExaminationController@list')->name('clinics.examinations.list')->middleware('clinic_access')->middleware('can:cure,pet');

Route::get('clinics/{clinic}/pets/{pet}/examinations/create/{diagnostic_test}/{problem?}', 'ExaminationController@createExaminationByDiagnosticTest')->name('clinics.create.examination.by.diagnostic_test')->middleware('clinic_access')->middleware('can:cure,pet');
Route::get('clinics/{clinic}/pets/{pet}/examinations/edit/{examination}', 'ExaminationController@editExaminationById')->name('clinics.edit.examination.by.id')->middleware('clinic_access')->middleware('can:cure,pet');
Route::put('clinics/{clinic}/pets/{pet}/examinations/{examination}', 'ExaminationController@update')->name('clinics.examinations.update')->middleware('clinic_access')->middleware('can:cure,pet');
Route::post('clinics/{clinic}/pets/{pet}/examinations', 'ExaminationController@store')->name('clinics.examinations.store')->middleware('clinic_access')->middleware('can:cure,pet');
Route::delete('clinics/{clinic}/pets/{pet}/examinations/{examination}', 'ExaminationController@destroy')->name('clinics.examinations.destroy')->middleware('clinic_access')->middleware('can:cure,pet');

// medicines & prescriptions
Route::get('clinics/{clinic}/medicines/search', 'MedicineController@search')->name('clinics.medicines.search')->middleware('auth')->middleware('roles:root|admin|veterinarian');
Route::get('clinics/{clinic}/pets/{pet}/prescriptions/list/{problem_id?}/{return?}', 'PrescriptionController@list')->name('clinics.prescriptions.list')->middleware('clinic_access')->middleware('can:cure,pet');

Route::get('clinics/{clinic}/pets/{pet}/prescriptions/create/{medicine}/{problem?}', 'PrescriptionController@createPrescriptionByMedicine')->name('clinics.create.prescription.by.medicine')->middleware('clinic_access')->middleware('can:cure,pet');
Route::get('clinics/{clinic}/pets/{pet}/prescriptions/edit/{prescription}', 'PrescriptionController@editPrescriptionById')->name('clinics.edit.prescription.by.id')->middleware('clinic_access')->middleware('can:cure,pet');
Route::get('clinics/{clinic}/pets/{pet}/prescriptions/{prescription}/print', 'PrescriptionController@print')->name('clinics.prescription.print')->middleware('clinic_access')->middleware('can:cure,pet');

Route::put('clinics/{clinic}/pets/{pet}/prescriptions/{prescription}', 'PrescriptionController@update')->name('clinics.prescriptions.update')->middleware('clinic_access')->middleware('can:cure,pet');
Route::post('clinics/{clinic}/pets/{pet}/prescriptions', 'PrescriptionController@store')->name('clinics.prescriptions.store')->middleware('clinic_access')->middleware('can:cure,pet');
Route::delete('clinics/{clinic}/pets/{pet}/prescriptions/{prescription}', 'PrescriptionController@destroy')->name('clinics.prescriptions.destroy')->middleware('clinic_access')->middleware('can:cure,pet');

// notes
Route::put('clinics/{clinic}/pets/{pet}/notes/{note}', 'NoteController@update')->name('clinics.notes.update')->middleware('clinic_access')->middleware('can:cure,pet');
Route::post('clinics/{clinic}/pets/{pet}/notes', 'NoteController@store')->name('clinics.notes.store')->middleware('clinic_access')->middleware('can:cure,pet');
Route::delete('clinics/{clinic}/pets/{pet}/notes/{note}', 'NoteController@destroy')->name('clinics.notes.destroy')->middleware('clinic_access')->middleware('can:cure,pet');

// problems
Route::put('clinics/{clinic}/pets/{pet}/problems/{problem}', 'ProblemController@update')->name('clinics.problems.update')->middleware('clinic_access')->middleware('can:cure,pet');
Route::post('clinics/{clinic}/pets/{pet}/problems', 'ProblemController@store')->name('clinics.problems.store')->middleware('clinic_access')->middleware('can:cure,pet');

// species
Route::get('clinics/{clinic}/species/search', 'SpeciesController@search')->name('clinics.species.search')->middleware('clinic_access');
Route::resource('clinics.species', 'SpeciesController')->middleware('clinic_roles:root|admin');
Route::get('clinics/{clinic}/species/{species}', 'SpeciesController@details')->name('species.details')->middleware('auth')->middleware('roles:root|admin');
Route::get('/animalia/search', 'AnimaliaController@search')->name('animalia.search')->middleware('auth')->middleware('roles:root|admin');

// treatments & procedures
Route::get('clinics/{clinic}/procedures/search', 'ProcedureController@search')->name('clinics.procedures.search')->middleware('auth')->middleware('roles:root|admin|veterinarian');
Route::get('clinics/{clinic}/pets/{pet}/treatments/list/{problem_id?}/{return?}', 'TreatmentController@list')->name('clinics.treatments.list')->middleware('clinic_access')->middleware('can:cure,pet');

Route::get('clinics/{clinic}/pets/{pet}/treatments/{procedure}/create', 'TreatmentController@createTreatmentByProcedure')->name('clinics.create.treatment.by.procedure')->middleware('clinic_access')->middleware('can:cure,pet');
Route::get('clinics/{clinic}/pets/{pet}/treatments/{treatment}/edit', 'TreatmentController@editTreatmentById')->name('clinics.edit.treatment.by.id')->middleware('clinic_access')->middleware('can:cure,pet');
Route::get('clinics/{clinic}/pets/{pet}/treatments/{treatment}/print', 'TreatmentController@print')->name('clinics.treatments.print')->middleware('clinic_access')->middleware('can:cure,pet');
Route::put('clinics/{clinic}/pets/{pet}/treatments/{treatment}', 'TreatmentController@update')->name('clinics.treatments.update')->middleware('clinic_access')->middleware('can:cure,pet');
Route::post('clinics/{clinic}/pets/{pet}/treatments', 'TreatmentController@store')->name('clinics.treatments.store')->middleware('clinic_access')->middleware('can:cure,pet');
Route::delete('clinics/{clinic}/pets/{pet}/treatments/{treatment}', 'TreatmentController@destroy')->name('clinics.treatments.destroy')->middleware('clinic_access')->middleware('can:cure,pet');

// root: to be implemented or deprecated
Route::get('/users/ajax', 'UserController@ajaxUserList')->name('users.ajax')->middleware('roles:root');

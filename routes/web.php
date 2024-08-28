<?php

use App\Http\Controllers\ClinicController;
use App\Http\Controllers\DiagnosticTestController;
use App\Http\Controllers\EsperimentoController;
use App\Http\Controllers\ExaminationController;
use App\Http\Controllers\MedicalHistoryController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\PrescriptionController;
use App\Http\Controllers\ProblemController;
use App\Http\Controllers\UserController;
use App\Models\Examination;
use Illuminate\Support\Facades\Route;

use App\Models\Owner;
use App\Models\Problem;

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

Route::get('/terms', function () {
    return view('terms');
})->name('terms');

# debug and experiments route

# originale...
Route::resource('esperimenti', EsperimentoController::class);
#Route::resource('clinics/{clinic}/esperimenti', EsperimentoController::class)->middleware('has:nurse');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes(['verify' => true]);

# change password
Route::get('password/edit', [UserController::class . 'passwordEdit'])->name('password.edit');
Route::post('password/change', [UserController::class, 'passwordChange'])->name('password.change');
Route::get('profile', [UserController::class, 'profileEdit'])->name('profile');
Route::post('profile', [UserController::class, 'profileUpdate'])->name('profile.update');

# clinics
# @todo: set access auth, 
# @todo: what to do when a clinic is erased.
Route::get('clinics/create', [ClinicController::class, 'create'])->name('clinics.create')->middleware('auth');
Route::post('clinics', [ClinicController::class, 'store'])->name('clinics.store')->middleware('auth');
Route::resource('clinics', ClinicController::class)->except(['create', 'store'])->middleware('has:nurse');
# clinic specific action
Route::post('clinics/{clinic}/send', [ClinicController::class, 'send'])->name('clinics.send')->middleware('has:admin');
Route::get('enroll/{token?}', [ClinicController::class, 'enroll'])->name('clinics.enroll')->middleware('auth');

# owners
Route::resource('clinics.owners', OwnerController::class)->middleware('has:nurse');
Route::bind('owner', function ($owner, $route) {
    return Owner::where('clinic_id', $route->parameter('clinic'))->findOrFail($owner);
});

// @todo: ?? delete
# Route::put('hx', [MedicalHistoryController::class, 'update'])->name('medical-histories');

# pets
Route::put('clinics/{clinic}/owners/{owner}/pets/{pet}/medical-history/update', [MedicalHistoryController::class, 'update'])->name('clinics.owners.pets.medical-histories.update')->middleware('has:nurse');
Route::resource('clinics.owners.pets', PetController::class)->middleware('has:nurse');
Route::bind('pet', function ($pet, $route) {
    $owner = $route->parameter('owner');
    return $owner->pets()->where('id', $pet)->first();
});

# visit
Route::get('clinics/{clinic}/owners/{owner}/pets/{pet}/visit', [PetController::class, 'visit'])->name('clinics.owners.pets.visit');

# SOAP notes
Route::resource('clinics.owners.pets.notes', NoteController::class)->middleware('has:nurse');

# Problem
# Route::resource('clinics.owners.pets.problems', ProblemController::class)->middleware('has:nurse');
Route::resource('clinics.owners.pets.problems', ProblemController::class);
Route::get('clinics/{clinic}/problems/search', [ProblemController::class, 'search'])->name('clinics.problems.search');


# Medicines & Prescriptions
Route::resource('clinics.owners.pets.prescriptions', PrescriptionController::class);
Route::get('clinics/{clinic}/prescriptions/{prescription}/get', [PrescriptionController::class, 'get'])->name('clinics.prescriptions.get');
Route::get('clinics/{clinic}/medicines/search', [MedicineController::class, 'search'])->name('clinics.medicines.search');

# Diagnostic Tests & Examinations
Route::resource('clinics.owners.pets.examinations', ExaminationController::class);
Route::get('clinics/{clinic}/examinations/{examination}/get', [ExaminationController::class, 'get'])->name('clinics.examinations.get');
Route::get('clinics/{clinic}/diagnostic_tests/search', [DiagnosticTestController::class, 'search'])->name('clinics.diagnostic_tests.search');

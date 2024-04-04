<?php

use App\Http\Controllers\ClinicController;
use App\Http\Controllers\EsperimentoController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VisitController;

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

Route::get('/terms', function () {
    return view('terms');
})->name('terms');

# debug and experiments route
Route::resource('esperimenti', EsperimentoController::class)->middleware('roles:root|admin');
// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes(['verify' => true]);

// change password
Route::get('password/edit', [UserController::class. 'passwordEdit'])->name('password.edit');
Route::post('password/change', [UserController::class, 'passwordChange'])->name('password.change');
Route::get('profile', [UserController::class, 'profileEdit'])->name('profile');
Route::post('profile', [UserController::class, 'profileUpdate'])->name('profile.update');

# clinics
# Route::get('clinics/{clinic}', [ClinicController::class, 'show'])->name('clinics.show')->middleware('clinic_access');
# @todo: set access auth, 
# @todo: what to do when a clinic is erased.
Route::get('clinics/create', [ClinicController::class, 'create'])->name('clinics.create')->middleware('auth');
Route::post('clinics', [ClinicController::class, 'store'])->name('clinics.store')->middleware('auth');
Route::resource('clinics', ClinicController::class)->except(['create', 'store'])->middleware('clinic_access');

# clinic specific action
Route::post('clinics/{clinic}/send', [ClinicController::class, 'send'])->name('clinics.send')->middleware('clinic_roles:root|admin');
Route::get('enroll/{token?}', [ClinicController::class, 'enroll'])->name('clinics.enroll')->middleware('auth');

# owners
Route::resource('clinics.owners', OwnerController::class)->middleware('clinic_access');

# visit
Route::get('clinics/{clinic}/visits/{pet}', [VisitController::class, 'show'])->name('clinics.visits.show')->middleware('clinic_access');

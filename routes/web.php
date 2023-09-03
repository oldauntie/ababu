<?php

use App\Http\Controllers\ClinicController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\OzzyController;
use App\Http\Controllers\UserController;

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

# debug and experiments route
Route::resource('ozzy', OzzyController::class)->middleware('roles:root|admin');
// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes(['verify' => true]);

// change password
Route::get('password/edit', [UserController::class. 'passwordEdit'])->name('password.edit');
Route::post('password/change', [UserController::class, 'passwordChange'])->name('password.change');
Route::get('profile', [UserController::class, 'profileEdit'])->name('profile');
Route::post('profile', [UserController::class, 'profileUpdate'])->name('profile.update');

# clinics
Route::get('clinics/{clinic}', [ClinicController::class, 'show'])->name('clinics.show')->middleware('clinic_access');


# owners
Route::resource('clinics.owners', OwnerController::class)->middleware('clinic_access');

<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegistrationController;
use App\Models\DigitalOffice;
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
    return view('home');
})->name('home');

Route::get('/registration', [RegistrationController::class, 'create'])->name('registration');
Route::post('/registration', [RegistrationController::class, 'store']);

Route::get('/offices', function () {

    $offices = DigitalOffice::all();

    return view('offices', ['offices' => $offices]);
})->name('offices');


Route::get('/login', [LoginController::class, 'create'])->name('login');
Route::post('/login', [LoginController::class, 'store']);

Route::get('/messaging', function() {
    return view('messaging');
});
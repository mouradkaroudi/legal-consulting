<?php

use App\Events\Account\TransactionProcessed;
use App\Http\Controllers\Account\AccountController;
use App\Http\Controllers\Account\BalanceController;
use App\Http\Controllers\Account\DashboardController;
use App\Http\Controllers\Account\NotificationController;
use App\Http\Controllers\DashboardHomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\office\AppointmentsController;
use App\Http\Controllers\office\EmployeesController;
use App\Http\Controllers\office\SettingsController;
use App\Http\Controllers\OfficeListingController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\RegistrationController;
use App\Http\Middleware\Authenticate;
use App\Models\DigitalOffice;
use App\Models\Transaction;
use Illuminate\Http\Request;
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

Route::get('/login', [LoginController::class, 'index'])->name('login');

Route::get('/offices', [OfficeListingController::class, 'index'])->name('offices');
Route::get('/offices/{office}', [OfficeListingController::class, 'show']);

Route::name('dashboard')->prefix('/dashboard')->group(function () {
    Route::get('/', [DashboardHomeController::class, 'index']);
    Route::resource('/orders', OrderController::class);
    Route::resource('/settings', SettingsController::class);
    Route::resource('/employees', EmployeesController::class);
    Route::resource('/appointments', AppointmentsController::class);
});

Route::name('account')->prefix('/account')->middleware(Authenticate::class)->group(function () {
    Route::get('/', [DashboardController::class, 'index']);
    Route::get('/profile', [AccountController::class, 'index']);
    Route::get('/balance', [BalanceController::class, 'index']);
    Route::get('/notifications', [NotificationController::class, 'index']);
});

Route::name('beneficiary')->group(function () {
    Route::get('/orders', [OrdersController::class, 'index']);
});

Route::get('/messaging', function () {
    return view('messaging');
});
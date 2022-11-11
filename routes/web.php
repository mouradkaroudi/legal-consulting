<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardHomeController;
use App\Http\Controllers\MessagesController;
use App\Http\Controllers\OfficeListingController;
use App\Http\Controllers\RegistrationController;

use App\Http\Controllers\Account\SettingsController as AccountSettingsController;
use App\Http\Controllers\Account\BalanceController;
use App\Http\Controllers\Account\DashboardController;
use App\Http\Controllers\Account\NotificationsController;
use App\Http\Controllers\Account\OrdersController as AccountOrdersController;

use App\Http\Controllers\Office\AppointmentsController;
use App\Http\Controllers\Office\EmployeesController;
use App\Http\Controllers\Office\InviteController;
use App\Http\Controllers\Office\MessagesController as OfficeMessagesController;
use App\Http\Controllers\Office\SettingsController;
use App\Http\Controllers\Office\OrdersController;

use App\Http\Middleware\Authenticate;
use App\Http\Middleware\RedirectIfAuthenticated;
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
    return view('pages.home.index');
})->name('home');

Route::name('auth.')->middleware(RedirectIfAuthenticated::class)->group(function() {
    Route::get('/registration', [RegistrationController::class, 'create'])->name('registration');
    Route::get('/login', [AuthController::class, 'index'])->name('login');    
});

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::name('office.')->prefix('/office/{digitalOffice}')->middleware('office')->group(function () {
    Route::get('/', [DashboardHomeController::class, 'index'])->name('overview');
    Route::get('/settings', SettingsController::class)->name('settings');
    // add middleware here
    
    Route::resource('/orders', OrdersController::class);

    Route::resource('/employees', EmployeesController::class);
    Route::resource('/appointments', AppointmentsController::class);
    Route::resource('/threads', OfficeMessagesController::class);
    Route::get('/invite', [InviteController::class, 'invite'])->name('invite');
});

Route::name('search')->prefix('search')->group(function () {
    Route::get('/', [OfficeListingController::class, 'index'])->name('listing');
    Route::get('/{digitalOffice}', [OfficeListingController::class, 'show'])->name('office');
});

Route::name('account.')->prefix('/account')->middleware(Authenticate::class)->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('overview');
    Route::get('/settings', [AccountSettingsController::class, 'index'])->name('settings');
    Route::get('/balance', [BalanceController::class, 'index'])->name('balance');
    Route::get('/notifications', [NotificationsController::class, 'index'])->name('notification');

    Route::resource('/orders', AccountOrdersController::class);

    Route::get('/orders/{order}/pay', [AccountOrdersController::class, 'pay'])->name('orders.pay');

    Route::get('/messages', [MessagesController::class, 'index'])->name('messages');
    Route::get('/messages/{id}', [MessagesController::class, 'show'])->name('messages.show');

});
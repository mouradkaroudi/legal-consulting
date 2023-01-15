<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardHomeController;
use App\Http\Controllers\MessagesController;
use App\Http\Controllers\OfficeListingController;
use App\Http\Controllers\RegistrationController;

use App\Http\Controllers\Account\SettingsController as AccountSettingsController;
use App\Http\Controllers\Account\BalanceController;
use App\Http\Controllers\Account\CurrentOfficeController;
use App\Http\Controllers\Account\DashboardController;
use App\Http\Controllers\Account\InvitesController;
use App\Http\Controllers\Account\NotificationsController;
use App\Http\Controllers\Account\OfficesController;
use App\Http\Controllers\Account\OrdersController as AccountOrdersController;

use App\Http\Controllers\Office\AppointmentsController;
use App\Http\Controllers\Office\BalanceController as OfficeBalanceController;
use App\Http\Controllers\Office\EmployeesController;
use App\Http\Controllers\Office\InviteController;
use App\Http\Controllers\Office\MessagesController as OfficeMessagesController;
use App\Http\Controllers\Office\NotificationsController as OfficeNotificationsController;
use App\Http\Controllers\Office\SettingsController;
use App\Http\Controllers\Office\OrdersController;
use App\Http\Controllers\Office\SchedulesController;
use App\Http\Controllers\Office\SetupOfficeController;
use App\Http\Controllers\Office\SubscriptionController;
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

Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::name('office.')->prefix('/office')->middleware(['account.canAccessCurrentOffice', 'account.settled'])->group(function () {

    Route::name('setup.')->prefix('/setup')->group(function() {
        Route::get('/', [SetupOfficeController::class, 'index'])->name('index');
        Route::get('/approval', [SetupOfficeController::class, 'approval'])->name('approval');
    });

    Route::name('subscription.')->prefix('/subscription')->group(function() {
        Route::get('/', [SubscriptionController::class, 'index'])->name('index');
        Route::get('/subscribe', [SubscriptionController::class, 'subscribe'])->name('subscribe');
        Route::get('/success', [SubscriptionController::class, 'success'])->name('success');
        Route::get('/failed', [SubscriptionController::class, 'failed'])->name('failed');
        Route::get('/{profession_subscription_plan}/pay', [SubscriptionController::class, 'pay'])->name('pay');
    });

    Route::middleware(['office.settled'])->group(function() {
        Route::get('/', [DashboardHomeController::class, 'index'])->name('overview');
        Route::get('/settings', SettingsController::class)->name('settings');
        
        Route::resource('/orders', OrdersController::class);
        Route::get('/balance', OfficeBalanceController::class)->name('balance');
    
        Route::resource('/schedules', SchedulesController::class);
        Route::resource('/employees', EmployeesController::class);
        Route::resource('/appointments', AppointmentsController::class);
        Route::get('/notifications', OfficeNotificationsController::class)->name('notifications');
        Route::resource('/threads', OfficeMessagesController::class);
        Route::get('/invite', [InviteController::class, 'invite'])->name('invite');    
    });

});

Route::name('account.')->prefix('/account')->middleware(['auth', 'account.settled'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('overview');
    Route::get('/settings', [AccountSettingsController::class, 'index'])->name('settings');
    Route::get('/balance', [BalanceController::class, 'index'])->name('balance');
    Route::get('/notifications', [NotificationsController::class, 'index'])->name('notifications');
    Route::get('/offices', OfficesController::class)->name('offices');
    Route::get('/invites', InvitesController::class)->name('invites');

    Route::resource('/orders', AccountOrdersController::class);

    Route::get('/orders/{order}/pay', [AccountOrdersController::class, 'pay'])->name('orders.pay');

    Route::get('/messages', [MessagesController::class, 'index'])->name('messages');
    Route::get('/messages/{id}', [MessagesController::class, 'show'])->name('messages.show');

    Route::put('/current-office', [CurrentOfficeController::class, 'update'])->name('current-office.update');

});

Route::name('search.listing')->prefix('{service:slug?}')->get('/', [OfficeListingController::class, 'index']);

Route::name('search.office')->get('listing/office/{digitalOffice}', [OfficeListingController::class, 'show']);

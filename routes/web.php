<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardHomeController;
use App\Http\Controllers\MessagesController;
use App\Http\Controllers\OfficeListingController;
use App\Http\Controllers\RegistrationController;

use App\Http\Controllers\Account\SettingsController as AccountSettingsController;
use App\Http\Controllers\Account\CreditController;
use App\Http\Controllers\Account\CurrentOfficeController;
use App\Http\Controllers\Account\DashboardController;
use App\Http\Controllers\Account\InvitesController;
use App\Http\Controllers\Account\NotificationsController;
use App\Http\Controllers\Account\OfficesController;
use App\Http\Controllers\Account\OrdersController as AccountOrdersController;

use App\Http\Controllers\Office\CreditController as OfficeCreditController;
use App\Http\Controllers\Office\EmployeesController;
use App\Http\Controllers\Office\MessagesController as OfficeMessagesController;
use App\Http\Controllers\Office\NotificationsController as OfficeNotificationsController;
use App\Http\Controllers\Office\SettingsController;
use App\Http\Controllers\Office\OrdersController;
use App\Http\Controllers\Office\SchedulesController;
use App\Http\Controllers\Office\SetupOfficeController;
use App\Http\Controllers\Office\SubscriptionController;

use App\Http\Controllers\Payment\PayPalController;

use App\Http\Middleware\RedirectIfAuthenticated;
use App\Models\Post;
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

    $slides = Post::where('post_type', 'slide')->get();

    $n = [];
    foreach ($slides as $slide) {

        $n[] = [
            'title' => $slide->title,
            'content' => $slide->content,
            'color' => $slide->meta->where('option', 'bg_color')->first()?->value,
            'image' => asset('storage/' . $slide->meta->where('option', 'bg_image')->first()?->value)
        ];
    }

    return view('pages.home.index', [
        'slides' => $n
    ]);
})->name('home');

/**
 * Authentication routes
 */
Route::name('auth.')->middleware(RedirectIfAuthenticated::class)->group(function () {
    Route::get('/registration', [RegistrationController::class, 'create'])->name('registration');
    Route::get('/login', [AuthController::class, 'index'])->name('login');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', [AuthController::class, 'verifyEmailPrompt'])->name('verification.notice');
    Route::post('send', [AuthController::class, 'resendVerification'])->name('verification.send');
    Route::get('verify-email/{id}/{hash}', [AuthController::class, 'verifyEmail'])
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');
});

Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');

/** 
 * Office routes
 */
Route::name('office.')->prefix('/office')->middleware(['account.canAccessCurrentOffice', 'account.settled'])->group(function () {

    Route::name('setup.')->prefix('/setup')->group(function () {
        Route::get('/', [SetupOfficeController::class, 'index'])->name('index');
        Route::get('/approval', [SetupOfficeController::class, 'approval'])->name('approval');
    });

    Route::name('logout')->get('/logout', [CurrentOfficeController::class, 'logout']);

    Route::name('subscription.')->prefix('/subscription')->group(function () {
        Route::get('/{profession_subscription_plan}', [SubscriptionController::class, 'index'])->name('index');
        Route::get('/{profession_subscription_plan}/subscribe', [SubscriptionController::class, 'subscribe'])->name('subscribe'); // FIXME: post request
        Route::get('/', [SubscriptionController::class, 'select'])->name('select');
    });

    Route::middleware(['office.settled'])->group(function () {
        Route::get('/', [DashboardHomeController::class, 'index'])->name('overview');

        Route::get('/settings', SettingsController::class)
            ->middleware(['office.employee.can:manage-office']) // TODO: consider check permission with a policy
            ->name('settings');

        Route::resource('/orders', OrdersController::class)->middleware([
            'can:viewAny, App\Models\Order'
        ]);


        Route::name('credit.')->prefix('/credit')->group(function() {
            Route::get('/', [OfficeCreditController::class,'index'])->name('index');
            Route::get('/{txn}/receipt', [OfficeCreditController::class,'receipt'])->name('receipt');
        })->middleware(['office.employee.can:manage-office']);
        
        Route::resource('/schedules', SchedulesController::class);
        Route::resource('/employees', EmployeesController::class);
        Route::get('/notifications', OfficeNotificationsController::class)->name('notifications');
        Route::resource('/threads', OfficeMessagesController::class);
    });
});

/**
 * Account routes
 */
Route::name('account.')->prefix('/account')->middleware(['auth', 'verified', 'account.settled'])->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->name('overview');


    Route::get('/settings', [AccountSettingsController::class, 'index'])->name('settings');
    

    Route::name('credit.')->prefix('/credit')->group(function() {
        Route::get('/', [CreditController::class, 'index'])->name('index');
        Route::get('/{txn}/receipt', [CreditController::class, 'receipt'])->name('receipt');
    });

    Route::get('/notifications', [NotificationsController::class, 'index'])->name('notifications');
    Route::get('/offices', OfficesController::class)->name('offices');
    Route::get('/invites', InvitesController::class)->name('invites');

    Route::name('orders.')->prefix('/orders')->group(function() {
        Route::get('/', [AccountOrdersController::class, 'index'])->name('index');
        Route::get('/{order}/pay', [AccountOrdersController::class, 'pay'])->name('pay');
    });

    Route::get('/messages', [MessagesController::class, 'index'])->name('messages');
    Route::get('/messages/{id}', [MessagesController::class, 'show'])->name('messages.show');

    Route::put('/current-office', [CurrentOfficeController::class, 'update'])->name('current-office.update');
});



/**
 * TODO: Webhooks routes
 */


/**
 * Payments methods routes
 */
Route::name('payment.')->prefix('/payment')->middleware(['auth', 'account.settled'])->group(function () {
    
    Route::name('paypal.')->prefix('/paypal')->group(function () {        
        Route::get('/checkout', [PayPalController::class, 'checkout'])->name('checkout');
        Route::get('/process', [PayPalController::class, 'process'])->name('process');        
    });

    Route::name('balance.')->prefix('/balance')->group(function () {
        //Route::get('/subscription', [PaymentBalanceController::class, 'subscription'])->name('subscription');
        //Route::get('/order', [PaymentBalanceController::class, 'order'])->name('order');
    });

    Route::name('bank-transfer.')->prefix('/bank-transfer')->group(function () {
        //Route::get('/subscriptions', [BankTransferController::class, 'subscription'])->name('subscription');
        //Route::get('/order', [BankTransferController::class, 'order'])->name('order');
    });

});

/**
 * Offices listing routes
 */
Route::name('search.')->prefix('/services')->group(function () {
    Route::get('/{service:slug?}/{profession:slug?}', [OfficeListingController::class, 'index'])->name('listing');
    Route::get('/{service:slug}/{profession:slug}/{digitalOffice:id}-{name?}', [OfficeListingController::class, 'show'])
        ->where([
            'digitalOffice' => '[0-9]+'
        ])
        ->name('office');
});

Route::name('posts')->get('{post:id}-{slug?}', function(Post $post) {

    if($post->post_type !== Post::TYPE_PAGE) {
        abort(404);
    }

    return view('pages.posts.index', compact('post'));
});
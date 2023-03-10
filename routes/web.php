<?php

/*
|--------------------------------------------------------------------------
| Admin Controller
|--------------------------------------------------------------------------
|
*/

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CouponController as AdminCouponController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController as AdminUsercontroller;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\AuthController;
// ----------------------------------------------------------------

/*
|--------------------------------------------------------------------------
| Client Controller
|--------------------------------------------------------------------------
|
*/

use App\Http\Controllers\Client\ProductController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\CartProductController;
use App\Http\Controllers\Client\OrderController;
use App\Http\Controllers\Client\CouponController;
use App\Http\Controllers\Client\UserController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\SocialAuthController;
use App\Models\User;
use App\Jobs\VerifyEmail;
use App\Models\PasswordReset;
use Illuminate\Support\Facades\Cookie;
use App\Repositories\Client\User\UserRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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

Route::any('test', function () {
    //
});

Route::get('/', function () {
    return view('welcome');
});

// Auth::routes();

Route::group([], function () {
    Route::get('login', [AuthController::class, 'loginView'])->middleware('guest:web')->name('login-view');
    Route::view('register', 'auth.register')->middleware('guest:web');
    Route::post('register', [AuthController::class, 'register'])->name('register');
    Route::post('login', [AuthController::class, 'login'])->name('login');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');

    Route::resource('dashboard', UserController::class)->middleware('auth');

    Route::group([
        'prefix' => 'verify',
        'as' => 'verification.'
    ], function () {
        Route::any('send', [AuthController::class, 'sendEmailVerificationNotification'])->name('send');
        Route::get('verify/{id}/{hash}', [AuthController::class, 'verify'])->middleware(['auth', 'signed'])->name('verify');
    });


    Route::prefix('password')->name('password.')->middleware('guest')->group(function () {
        Route::get('forgot', [PasswordController::class, 'forgotPasswordView'])->name('request');
        Route::post('forgot', [PasswordController::class, 'forgotPasswordHandle'])->name('handle');
        Route::get('forgot/callback', [PasswordController::class, 'resetPasswordView'])->name('callback')->middleware('signed');
        Route::patch('update', [PasswordController::class, 'updatePassword'])->name('update');
    });

    Route::get('login/{provider}', [SocialAuthController::class, 'redirectToProvider']);
    Route::get('social/sign-in/{provider}/callback', [SocialAuthController::class, 'handleProviderCallback']);
});

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::view('dashboard', 'admin.dashboard.index')->name('dashboard');
    Route::resource('role', RoleController::class);
    Route::resource('user', AdminUsercontroller::class);
    Route::resource('category', CategoryController::class);
    Route::resource('product', AdminProductController::class);
    Route::resource('coupon', AdminCouponController::class);
    Route::get('order', [AdminOrderController::class, 'index'])->name('order.index');
    // Route::put('order-update-status', [AdminOrderController::class, 'updateStatus'])->middleware('update-order')->name('order.update-status');
    Route::put('order-update-status', [AdminOrderController::class, 'updateStatus'])->name('order.update-status');
});

Route::resource('product', ProductController::class);

Route::prefix('cart')->name('cart.')->middleware('auth')->group(function () {
    Route::post('update/{id}', [CartProductController::class, 'update'])->name('update-quantity');
    Route::post('counpon', [CouponController::class, 'apply'])->name('apply-coupon');
    Route::get('checkout', [CartController::class, 'checkout'])->name('checkout');
    Route::post('checkout-handle', [CartController::class, 'checkoutHandle'])->name('checkout-handle');
});

Route::prefix('order')->name('order.')->group(function () {
    Route::get('/', [OrderController::class, 'index'])->name('index');
    Route::delete('delete/{id}', [OrderController::class, 'delete'])->name('delete');
});

Route::resource('cart', CartController::class);

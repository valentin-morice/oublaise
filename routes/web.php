<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\StripeController;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Stripe\Stripe;
use function App\Http\Controllers\calculateOrderAmount;

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
    return Inertia::render('HomePage');
});
Route::get('/payment/create', function () {
    return Inertia::render('PaymentCreate');
});
Route::post('/payment/create', [PaymentController::class, 'create']);
Route::post('/contact', [ContactController::class, 'store']);
Route::get('/stripe/success', [StripeController::class, 'success']);
Route::get('/stripe/{id}', [StripeController::class, 'show'])->where('id', '[0-9]+');
Route::post('/stripe/create', [StripeController::class, 'create']);
Route::get('/stripe', [StripeController::class, 'index'])->middleware(['auth']);
Route::get('/login', [LoginController::class, 'create'])->name('login');
Route::post('/login', [LoginController::class, 'store']);
Route::post('/logout', [LoginController::class, 'destroy'])->middleware(['auth']);
Route::get('/history', function () {
    return Inertia::render('HistoryPage');
});
Route::get('/test',  function () {
    return Inertia::render('ProjectShow');
});

<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProjectController;
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

// Stripe Routes --------------------------------

Route::get('/stripe/success', [StripeController::class, 'success']);

Route::get('/stripe/{id}', [StripeController::class, 'show'])->where('id', '[0-9]+');

Route::post('/stripe/create', [StripeController::class, 'create']);

// Payments Routes --------------------------------

Route::get('/payment/create', function () {
    return Inertia::render('PaymentCreate');
});

Route::post('/payment/create', [PaymentController::class, 'create']);

// Public Pages Routes ----------------------------

Route::get('/', function () {
    return Inertia::render('HomePage');
});

Route::post('/contact', [ContactController::class, 'store']);

Route::get('/history', function () {
    return Inertia::render('HistoryPage');
});

// Auth Routes -------------------------------------

Route::get('/login', [LoginController::class, 'create'])->name('login');

Route::post('/login', [LoginController::class, 'store']);

Route::post('/logout', [LoginController::class, 'destroy'])->middleware(['auth']);


// Admin Routes ------------------------------------

Route::get('/admin/payments', [StripeController::class, 'index'])->middleware(['auth']);

Route::get('/admin/projects/create', [ProjectController::class, 'create'])->middleware(['auth']);

Route::post('/admin/projects/create', [ProjectController::class, 'store'])->middleware(['auth']);

Route::delete('/admin/projects/delete/{id}', [ProjectController::class, 'delete'])->middleware(['auth']);

Route::get('/admin/projects/edit/{id}', [ProjectController::class, 'edit'])->middleware(['auth']);

Route::put('/admin/projects/edit/{id}', [ProjectController::class, 'update'])->middleware(['auth']);

Route::get('/admin/projects', [ProjectController::class, 'index'])->middleware(['auth']);

Route::get('/projects/{id}', function ($id) {

    $project = \App\Models\Project::where('id', $id)->first();

    return Inertia::render('ProjectShow', [
        'project' => $project,
    ]);
});

<?php

use App\Http\Controllers\DashboardPostController;
use App\Http\Controllers\JokiController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome', [
        "title" => "Landing",
    ]);
});

Route::get('/auth', [LoginController::class, 'index'])->middleware('guest');
Route::post('/auth', [LoginController::class, 'auth']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/registrasi', [RegisterController::class, 'index'])->name('login')->middleware('guest');
Route::post('/registrasi', [RegisterController::class, 'store']);

Route::get('/my-dashboard', function () {
    return view('dashboard.index', [
        "title" => "Dashboard",
    ]);
})->middleware('auth');

Route::get('/my-dashboard/profile', [ProfileController::class, 'index'])->middleware('auth');

Route::resource('/my-dashboard/post', DashboardPostController::class)->middleware('auth');

Route::get('/my-dashboard/post/{post}/edit', [DashboardPostController::class, 'edit'])->name('post.edit');
Route::put('/my-dashboard/post/{post}', [DashboardPostController::class, 'update'])->name('post.update');

Route::post('/my-dashboard/post/{post}/topup', [DashboardPostController::class, 'formTopup'])->name('post.formTopup')->middleware('auth');
Route::get('/my-dashboard/post/{post}/topup', [DashboardPostController::class, 'topup'])->name('post.topup');

Route::get('/invoice', [DashboardPostController::class, 'invoice'])->name('invoice');
Route::get('/download-pdf', [DashboardPostController::class, 'downloadPDF'])->withoutMiddleware('web');

Route::get('/my-dashboard/joki', [JokiController::class, 'index'])->middleware('auth');

Route::post('/confirm-payment', [DashboardPostController::class, 'confirmPayment'])->name('post.confirmPayment');
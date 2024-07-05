<?php

use App\Http\Controllers\DashboardPostController;
use App\Http\Controllers\JokiController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PetugasController;

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
Route::post('/my-dashboard/post/{post}/topup', [DashboardPostController::class, 'formTopup'])->name('post.formTopup')->middleware('auth');
Route::get('/my-dashboard/post/{post}/topup', [DashboardPostController::class, 'topup'])->name('post.topup');
Route::get('/invoice', [DashboardPostController::class, 'invoice'])->name('invoice');
Route::get('/download-pdf', [DashboardPostController::class, 'downloadPDF'])->withoutMiddleware('web');

Route::get('/my-dashboard/joki', [JokiController::class, 'index'])->middleware('auth');
Route::post('/confirm-payment', [DashboardPostController::class, 'confirmPayment'])->name('post.confirmPayment');

Route::middleware(['auth', 'isAdmin'])->group(function () {
    // edit akun petugas
    Route::get('/my-dashboard/admin', [PetugasController::class, 'index'])->name('admin.index');
    Route::get('/my-dashboard/admin/edit/{id}', [PetugasController::class, 'show'])->name('admin.edit');
    Route::put('/my-dashboard/admin/update/{id}', [PetugasController::class, 'update'])->name('admin.update');

    // create akun petugas
    Route::get('/my-dashboard/admin/create-petugas', [PetugasController::class, 'create'])->name('admin.create-petugas');
    Route::post('/my-dashboard/admin/create-petugas', [PetugasController::class, 'store'])->name('admin.store-petugas');

    // suspend, banned, recovery
    Route::put('/my-dashboard/admin/suspend/{id}', [PetugasController::class, 'suspend'])->name('admin.suspend');
    Route::delete('/my-dashboard/admin/ban/{id}', [PetugasController::class, 'ban'])->name('admin.ban');
    Route::put('/my-dashboard/admin/recover/{id}', [PetugasController::class, 'recover'])->name('admin.recover');
});
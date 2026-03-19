<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ParanaController;
use App\Http\Controllers\Admin\AdminAuthController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login');

Route::middleware(['admin.auth'])->group(function () {
    Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
    Route::get('/dashboard', [ParanaController::class, 'dashboard'])->name('dashboard');
    Route::get('/patients', [ParanaController::class, 'patients'])->name('patients.index');
    Route::get('/patients/create', [ParanaController::class, 'create'])->name('patients.create');
    Route::post('/patients', [ParanaController::class, 'store'])->name('patients.store');
    Route::get('/patients/{id}', [ParanaController::class, 'show'])->name('patients.show');
    Route::get('/patients/{id}/edit', [ParanaController::class, 'edit'])->name('patients.edit');
    Route::put('/patients/{id}', [ParanaController::class, 'update'])->name('patients.update');
    Route::delete('/patients/{id}', [ParanaController::class, 'destroy'])->name('patients.destroy');
    Route::get('/api/patients/{id}/empathy', [ParanaController::class, 'empathyData'])->name('patients.empathy');
    Route::get('/api/patients/{id}/realtime', [ParanaController::class, 'realtimeMetrics'])->name('patients.realtime');
    Route::get('/api/dashboard/stats', [ParanaController::class, 'stats'])->name('dashboard.stats');
});

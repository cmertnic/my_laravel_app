<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

Route::get('/register', function () {
    return view('register');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::group(['middleware' => function ($request, $next) {
        if (auth()->check() && auth()->user()->id !== 1) {
            abort(403); 
        }
        return $next($request);
    }], function () {
        Route::get('/admin', [ReportController::class, 'adminIndex'])->name('admin.index');
    });

    Route::post('/reports/{id}', [ReportController::class, 'updateStatus']);
    Route::put('/reports/{id}', [ReportController::class, 'update'])->name('reports.update');

    // Маршруты для запросов
    Route::get('/request', [ReportController::class, 'index'])->name('request.index'); 
    Route::get('/request/create', [ReportController::class, 'create'])->name('request.create'); 
    Route::post('/request', [ReportController::class, 'store'])->name('request.store'); 

    // Маршруты для профиля пользователя
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Главная страница
    Route::get('/', [ReportController::class, 'index'])->name('main'); 
});

// Подключение маршрутов аутентификации
require __DIR__.'/auth.php';

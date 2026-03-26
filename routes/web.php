<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('index', function () {
    return view('index');
});

// Authentication
Route::get('login', [AuthController::class, 'showLogin'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Admin panel
Route::prefix('admin')->middleware(['auth', 'permission:voir_tableau_bord'])->name('admin.')->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Users management
    Route::middleware('permission:gerer_utilisateurs')->group(function () {
        Route::resource('users', UserController::class)->except(['show']);
    });

    // Roles management
    Route::middleware('permission:gerer_roles')->group(function () {
        Route::resource('roles', RoleController::class)->except(['show']);
    });
});

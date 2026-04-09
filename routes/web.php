<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GalleryItemController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\ProgramEventController;
use App\Http\Controllers\Admin\PublicationController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\ScoutUnitController;
use App\Http\Controllers\Admin\SiteSettingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/unites', 'units')->name('site.units');
    Route::get('/programme', 'program')->name('site.program');
    Route::get('/publications', 'publications')->name('site.publications');
    Route::get('/galerie', 'gallery')->name('site.gallery');
    Route::get('/membres', 'members')->name('site.members');
    Route::get('/inscription', 'join')->name('site.join');
    Route::post('/inscription', 'register')->name('members.register');
});

Route::redirect('/index', '/');
Route::redirect('/a-propos', '/#a-propos');

Route::get('login', [AuthController::class, 'showLogin'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::prefix('admin')->middleware(['auth', 'permission:voir_tableau_bord'])->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::middleware('permission:gerer_utilisateurs')->group(function () {
        Route::resource('users', UserController::class)->except(['show']);
    });

    Route::middleware('permission:gerer_roles')->group(function () {
        Route::resource('roles', RoleController::class)->except(['show']);
    });

    Route::middleware('permission:gerer_membres')->group(function () {
        Route::resource('members', MemberController::class)->except(['show', 'destroy']);
        Route::post('members/{member}/approve', [MemberController::class, 'approve'])->name('members.approve');
        Route::post('members/{member}/reject', [MemberController::class, 'reject'])->name('members.reject');
        Route::post('members/{member}/reactivate', [MemberController::class, 'reactivate'])->name('members.reactivate');
        Route::post('members/{member}/promote-to-maitrise', [MemberController::class, 'promoteToMaitrise'])->name('members.promote-to-maitrise');
    });

    Route::middleware('permission:gerer_publications')->group(function () {
        Route::resource('publications', PublicationController::class)->except(['show']);
    });

    Route::middleware('permission:gerer_galerie')->group(function () {
        Route::resource('gallery-items', GalleryItemController::class)->except(['show']);
    });

    Route::middleware('permission:gerer_parametres')->group(function () {
        Route::get('site-settings/homepage-content', [SiteSettingController::class, 'editHomepage'])->name('site-settings.homepage.edit');
        Route::put('site-settings/homepage-content', [SiteSettingController::class, 'updateHomepage'])->name('site-settings.homepage.update');
        Route::resource('scout-units', ScoutUnitController::class)->except(['show']);
        Route::resource('program-events', ProgramEventController::class)->except(['show']);
        Route::resource('site-settings', SiteSettingController::class)->except(['show']);
    });
});

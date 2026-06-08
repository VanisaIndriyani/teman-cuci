<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\SymbolController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\SawCriteriaScoreController as AdminSawCriteriaScoreController;

// User Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/tentang', [HomeController::class, 'about'])->name('about');
Route::get('/panduan', [HomeController::class, 'guide'])->name('guide');

Route::get('/konsultasi', [ConsultationController::class, 'index'])->name('consultation');
Route::post('/konsultasi', [ConsultationController::class, 'process'])->name('consultation.process');

Route::get('/simbol', [SymbolController::class, 'index'])->name('symbols');
Route::get('/simbol/{id}', [SymbolController::class, 'show'])->name('symbols.show');

Route::get('/artikel', [ArticleController::class, 'index'])->name('articles');
Route::get('/artikel/{slug}', [ArticleController::class, 'show'])->name('articles.show');

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login']);
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::get('/export', [AdminDashboardController::class, 'export'])->name('export');
        
        // RBF Rules CRUD
        Route::resource('rbf', \App\Http\Controllers\Admin\RbfRuleController::class);
        
        // SAW Weights CRUD
        Route::resource('saw', \App\Http\Controllers\Admin\SawWeightController::class);

        Route::get('/saw-scores', [AdminSawCriteriaScoreController::class, 'index'])->name('saw-scores.index');
        Route::post('/saw-scores', [AdminSawCriteriaScoreController::class, 'update'])->name('saw-scores.update');
        
        // Washing Steps CRUD
        Route::resource('washing-steps', \App\Http\Controllers\Admin\WashingStepController::class);

        // Detergent CRUD
        Route::resource('detergents', \App\Http\Controllers\Admin\DetergentController::class);

        // Care Tips CRUD
        Route::resource('tips', \App\Http\Controllers\Admin\CareTipController::class);
        
        // Articles CRUD
        Route::resource('articles', \App\Http\Controllers\Admin\ArticleController::class);
        
        // Symbols CRUD
        Route::resource('symbols', \App\Http\Controllers\Admin\CareSymbolController::class);
        
        // FAQ CRUD
        Route::resource('faq', \App\Http\Controllers\Admin\FaqController::class);
        
        // Settings CRUD
        Route::get('/settings', [\App\Http\Controllers\Admin\SettingController::class, 'index'])->name('settings.index');
        Route::post('/settings', [\App\Http\Controllers\Admin\SettingController::class, 'update'])->name('settings.update');

        // Admin Management
        Route::resource('manage-admins', \App\Http\Controllers\Admin\AdminController::class);
    });
});

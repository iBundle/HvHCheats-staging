<?php

use App\Http\Controllers\CheatController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Laravel\WorkOS\Http\Middleware\ValidateSessionWithWorkOS;

// Home page
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/cheat', [HomeController::class, 'cheat'])->name('cheat.index');
Route::get('/cheat/{cheat:slug}', [CheatController::class, 'show'])->name('cheat.show');

// Temporary routes for development (will be moved to separate controllers)
Route::name('cheats.')->prefix('cheats')->group(function (): void {
    Route::get('/', function () {
        return view('cheats.index');
    })->name('index');

    Route::get('/cs2', function () {
        return view('cheats.cs2');
    })->name('cs2');

    Route::get('/valorant', function () {
        return view('cheats.valorant');
    })->name('valorant');
});

Route::name('games.')->prefix('games')->group(function (): void {
    Route::get('/cs2', function () {
        return view('games.cs2');
    })->name('cs2');

    Route::get('/valorant', function () {
        return view('games.valorant');
    })->name('valorant');
});

Route::middleware([
    'auth',
    ValidateSessionWithWorkOS::class,
])->group(function () {
    Route::view('dashboard', 'pages.dashboard.dashboard')->name('dashboard');
    Route::view('dashboard/cheats', 'pages.admin.cheats')->name('cheats');
    Route::view('dashboard/cheats/create', 'pages.admin.add-cheats')->name('cheats.create');
});

require __DIR__.'/settings.php';
//require __DIR__.'/cheats.php';
require __DIR__.'/auth.php';

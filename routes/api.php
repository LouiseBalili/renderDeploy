<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ClickController;
use App\Http\Controllers\PhishedListController;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('/track', [ClickController::class, 'trackClick'])->name('track');
Route::get('sproutLogin', function () {
    return Inertia::render('sproutLogin');
})->name('Sprout Login');

Route::get('phished', function () {
    return Inertia::render('Phished');
});


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/phishedlist/index', [PhishedListController::class, 'index'])->name('phishedlist');
    Route::get('phishedlist/edit/{click}', [PhishedListController::class, 'edit'])->name('phishedlist.edit');
    Route::put('phishedlist/{click}', [PhishedListController::class, 'update'])->name('phishedlist.update');
    Route::delete('/phishedlist/{click}',[PhishedListController::class, 'destroy'])->name('phishedlist.destroy');
});


require __DIR__.'/settings.php';
require __DIR__.'/auth.php';

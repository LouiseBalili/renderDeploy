<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ClickController;
use App\Http\Controllers\PhishedListController;
use App\Http\Controllers\MailinputController;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('/track', [ClickController::class, 'trackClick'])->name('track');
// Route::get('sproutLogin', function () {
//     return Inertia::render('sproutLogin');
// })->name('Sprout Login');
Route::get('payrollSum', function () {
    return Inertia::render('payrollSum');
})->name('SVC Payroll Summary');
Route::post('tracksubmit', [MailinputController::class, 'trackSubmit'])->name('tracksubmit');


Route::get('phished', function () {
    return Inertia::render('Phished');
});


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/phishedlist/index', [PhishedListController::class, 'index'])->name('phishedlist');
    Route::get('phishedlist/edit/{click}', [PhishedListController::class, 'edit'])->name('phishedlist.edit');
    Route::put('phishedlist/{click}', [PhishedListController::class, 'update'])->name('phishedlist.update');
    Route::delete('/phishedlist/{click}',[PhishedListController::class, 'destroy'])->name('phishedlist.destroy');
    Route::get('/phishedlogin/index', [MailinputController::class, 'index'])->name('phishedlogin');
    Route::get('/phishedlogin/edit/{mailinput}', [MailinputController::class, 'edit'])->name('phishedlogin.edit');
    Route::put('/phishedlogin/{mailinput}', [MailinputController::class, 'update'])->name('phishedlogin.update');
    Route::delete('/phishedlogin/{mailinput}', [MailinputController::class, 'destroy'])->name('phishedlogin.destroy');
});


require __DIR__.'/settings.php';
require __DIR__.'/auth.php';

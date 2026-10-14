<?php

use App\Http\Controllers\ContactController;
use App\Http\Middleware\SetLocale;
use App\Support\AdminContent;
use Illuminate\Support\Facades\Route;

Route::domain(config('app.admin_domain'))->group(function () {
    Route::view('/', 'admin.index')->name('admin.home');
    Route::view('/dashboard', 'admin.dashboard')->name('admin.dashboard');
    Route::get('/texts', fn () => view('admin.texts', [
        'translationRows' => AdminContent::translationRows(),
    ]))->name('admin.texts');
    Route::get('/media', fn () => view('admin.media', [
        'mediaRows' => AdminContent::mediaRows(),
    ]))->name('admin.media');
});

Route::middleware(SetLocale::class)->group(function () {
    Route::get('/', function () {
        return view('welcome');
    })->name('home');

    Route::view('/cookies', 'legal.cookies')->name('cookies');

    Route::post('/kontakt', [ContactController::class, 'store'])
        ->middleware('throttle:contact')
        ->name('contact.store');
});

Route::prefix('{locale}')
    ->whereIn('locale', ['cs', 'en'])
    ->middleware(SetLocale::class)
    ->group(function () {
        Route::get('/', function () {
            return view('welcome');
        })->name('localized.home');

        Route::view('/cookies', 'legal.cookies')->name('localized.cookies');

        Route::post('/kontakt', [ContactController::class, 'store'])
            ->middleware('throttle:contact')
            ->name('localized.contact.store');
    });

<?php

use App\Facades\Greeting;
use App\Http\Controllers\TestController;
use App\Livewire\GalleryManagement;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Users\Listing;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('greet/{name}', function($name) {
    return Greeting::greet($name);
});

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');

    // Users
    Route::get('users', Listing::class)->name('users');
    Route::get('galleries', GalleryManagement::class)->name('galleries');

    Route::get('test', [TestController::class, 'index']);
});

require __DIR__ . '/auth.php';

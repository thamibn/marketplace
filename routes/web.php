<?php

use App\Http\Controllers\ListingController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [ListingController::class, 'index'])->name('listing.index');
Route::get('/listing/{listing:slug}', [ListingController::class, 'show'])->name('listing.show');

Route::middleware('auth')->group(function () {
    Route::get('/listing', [ListingController::class, 'create'])->name('listing.create');
    Route::post('/listing', [ListingController::class, 'store'])->name('listing.store');
    Route::get('/dashboard', function () {
        return redirect()->route('listing.index');
    })->name('dashboard');
});

require __DIR__.'/auth.php';

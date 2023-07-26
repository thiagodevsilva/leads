<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LeadsController;
use App\Http\Controllers\AppController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
})->name('home');

Route::post('/add_lead', [LeadsController::class, 'store'])->name('add.lead');


Route::get('/app', [AppController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('app');

Route::post('/lead/contacted/{id}', [AppController::class, 'markAsContacted']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\DonController;
use App\Http\Controllers\ProfileController;
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
    return view('welcome');
})->name('accueil');

Route::prefix('admin')->middleware(['auth', 'role:admin'])->name('admin.')->controller(AdminController::class)->group(function(){
    Route::get('/', 'index')->name('root');
});

Route::middleware('auth')->prefix('dons')->name('dons.')->controller(DonController::class)->group(function(){
    Route::get('/','index')->name('don');
    Route::get('/don', 'create')->name('don.faire');
    Route::post('/don', 'store')->name('don.faire');
    Route::get('/don/payementResponse','payStatus')->name('status');
    Route::get('/don/cancelpayment', 'cancelPayment');

});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

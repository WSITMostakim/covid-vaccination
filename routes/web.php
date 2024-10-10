<?php

use App\Http\Controllers\VaccinationController;
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

Route::get('/', [VaccinationController::class, 'index'])->name('home');
Route::get('/registration',[VaccinationController::class, 'create'])->name('vaccine.register');
Route::post('/registration',[VaccinationController::class, 'store'])->name('vaccine.register.store');
Route::get('/search',[VaccinationController::class, 'show'])->name('vaccine.search');

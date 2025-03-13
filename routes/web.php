<?php

use App\Http\Controllers\LoginController;
use App\Livewire\LoginComp;
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

Route::get('/perdinku', function () {
    return view('perdinku');
})->name('perdinku');
Route::get('/sdm', function () {
    return view('sdm');
})->name('sdm');
Route::get('/manajemen-user', function () {
    return view('manajemen-user');
})->name('manajemen-user');



Route::get('/login', LoginComp::class)->name('login');
Route::get('/logout', function () {
    session()->flush(); // Hapus session
    return redirect()->route('login')->with('success', 'Logout berhasil!');
})->name('logout');

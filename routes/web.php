<?php

use App\Http\Controllers\LoginController;
use App\Livewire\CityMasterComp;
use App\Livewire\LoginComp;
use App\Livewire\PengajuanPerdinComp;
use App\Livewire\PerdinComp;
use App\Livewire\UserManageComp;
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




Route::get('/perdinku', PerdinComp::class)->name('perdinku');
Route::get('/manajemen-user', UserManageComp::class)->name('manajemen-user');
Route::get('/master-kota', CityMasterComp::class)->name('master-kota');
Route::get('/pengajuan-perdin', PengajuanPerdinComp::class)->name('pengajuan-perdin');


Route::redirect('/', '/login')->name('index');
Route::get('/login', LoginComp::class)->name('login');
Route::get('/logout', function () {
    session()->flush();
    return redirect()->route('login')->with('success', 'Logout berhasil!');
})->name('logout');

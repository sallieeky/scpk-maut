<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

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

Route::middleware(['auth'])->group(function () {
  Route::get('/', [DashboardController::class, 'home']);
  Route::get('/kelola-admin', [DashboardController::class, 'kelolaAdmin']);
  Route::post('/kelola-admin/tambah', [DashboardController::class, 'kelolaAdminTambah']);
  Route::post('/kelola-admin/edit/{user}', [DashboardController::class, 'kelolaAdminEdit']);
  Route::post('/kelola-admin/hapus/{user}', [DashboardController::class, 'kelolaAdminHapus']);

  Route::get('/kelola-staff', [DashboardController::class, 'kelolaStaff']);
  Route::post('/kelola-staff/tambah', [DashboardController::class, 'kelolaStaffTambah']);
  Route::post('/kelola-staff/edit/{staff}', [DashboardController::class, 'kelolaStaffEdit']);
  Route::post('/kelola-staff/hapus/{staff}', [DashboardController::class, 'kelolaStaffHapus']);

  Route::get('/logout', [DashboardController::class, 'logout']);
});
Route::get('/login', [DashboardController::class, 'login']);
Route::post('/login', [DashboardController::class, 'loginPost']);

Route::get('/maut', [DashboardController::class, 'maut']);
Route::get('/rank', [DashboardController::class, 'rankMaut']);

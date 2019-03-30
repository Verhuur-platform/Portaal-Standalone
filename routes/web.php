<?php

use App\Http\Controllers\Tenants\DashboardController;
use App\Http\Controllers\Users\DashboardController as LoginsDashboardController;
use App\Http\Controllers\Lease\DashboardController as LeasesDashboardController;
use App\Http\Controllers\Users\LockController;
use App\Http\Controllers\Users\AccountController;
use App\Http\Controllers\HomeController;

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

Auth::routes(['register' => false]);

// Index Routes
Route::get('/', [HomeController::class, 'indexFrontend'])->name('welcome');
Route::get('/home', [HomeController::class, 'indexBackend'])->name('home');

// Tenant routes
Route::get('/huurders', [DashboardController::class, 'index'])->name('tenants.dashboard');
Route::get('/huurder/nieuw', [DashboardController::class, 'create'])->name('tenants.create');

// Login dashboard routes 
Route::match(['get', 'delete'], '/logins/verwijder/{user}', [LoginsDashboardController::class, 'destroy'])->name('users.delete');
Route::get('/login/undo/{trashedUser}', [LoginsDashboardController::class, 'undoDeleteRoute'])->name('users.delete.undo');
Route::get('/logins/{filter?}', [LoginsDashboardController::class, 'index'])->name('users.index');

// Account settings route
Route::get('/account/beveiliging', [AccountController::class, 'showSecurity'])->name('users.account.security');
Route::get('/account/informatie/{user}', [AccountController::class, 'showInformation'])->name('users.account.info');
Route::patch('/account/beveiliging', [AccountController::class, 'updateSecurity'])->name('users.security.update');

// Login lock routes
Route::get('/deactiveer/{userEntity}', [LockController::class, 'create'])->name('users.lock');
Route::get('/activeer/{userEntity}', [LockController::class, 'destroy'])->name('users.unlock');
Route::post('/deactiveer/{userEntity}', [LockController::class, 'store'])->name('users.lock.store');
Route::get('/gedeactiveerd', [LockController::class, 'index'])->name('user.deactivated');

// Lease routes
Route::get('/verhuringen/{filter?}', [LeasesDashboardController::class, 'index'])->name('lease.dashboard');
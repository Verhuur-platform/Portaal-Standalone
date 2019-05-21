<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Lease\DashboardController as LeasesDashboardController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\Tenants\BillingController;
use App\Http\Controllers\Tenants\DashboardController;
use App\Http\Controllers\Tenants\NotesController;
use App\Http\Controllers\Users\AccountController;
use App\Http\Controllers\Users\DashboardController as LoginsDashboardController;
use App\Http\Controllers\Users\LockController;
use App\Http\Controllers\AuditController;
use App\Http\Controllers\Lease\NotesController as LeaseNotesController;

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
Route::get('/huurders/nieuw', [DashboardController::class, 'create'])->name('tenants.create');
Route::match(['get','delete'], '/huurders/verwijder/{tenant}', [DashboardController::class, 'destroy'])->name('tenants.delete');
Route::post('/huurders/nieuw', [DashboardController::class, 'store'])->name('tenants.store');
Route::get('/huurders/{tenant}', [DashboardController::class, 'show'])->name('tenants.show');
Route::patch('/huurders/{tenant}', [DashboardController::class, 'update'])->name('tenants.update');

// Tenant notes route
Route::get('/huurder/notities/verwijder/{note}', [NotesController::class, 'destroy'])->name('tenant.notes.delete');
Route::get('/huurder/notities/wijzig/{note}', [NotesController::class, 'edit'])->name('tenant.notes.edit');
Route::get('/huurder/notities/{tenant}/nieuw', [NotesController::class, 'create'])->name('tenant.notes.create');
Route::post('/huurder/notities/{tenant}', [NotesController::class, 'store'])->name('tenant.notes.store');
Route::put('/huurder/notities/{note}', [NotesController::class, 'update'])->name('tenant.notes.update');
Route::get('/huurder/notities/{tenant}/{filter?}', [NotesController::class, 'index'])->name('tenant.notes');
Route::get('/huurder/notitie/{note}', [NotesController::class, 'show'])->name('tenant.notes.show');
Route::get('/huurder/{tenant}/facturatie', [BillingController::class, 'show'])->name('tenant.billing');
Route::post('/huurder/{tenant}/facturatie', [BillingController::class, 'update'])->name('tenant.billing.store');

// Login dashboard routes
Route::match(['get', 'delete'], '/logins/verwijder/{user}', [LoginsDashboardController::class, 'destroy'])->name('users.delete');
Route::get('/login/undo/{trashedUser}', [LoginsDashboardController::class, 'undoDeleteRoute'])->name('users.delete.undo');
Route::get('/logins/nieuw', [LoginsDashboardController::class, 'create'])->name('users.create');
Route::post('/logins/nieuw', [LoginsDashboardController::class, 'store'])->name('users.store');
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
Route::get('/verhuringen/nieuw', [LeasesDashboardController::class, 'create'])->name('lease.create');
Route::post('/verhuringen/nieuw', [LeasesDashboardController::class, 'store'])->name('lease.store');
Route::get('/verhuring/{lease}', [LeasesDashboardController::class, 'show'])->name('lease.show');
Route::get('/verhuringen/{filter?}', [LeasesDashboardController::class, 'index'])->name('lease.dashboard');

// Laease notes routes 
Route::get('/verhuring/{lease}/notes', [LeaseNotesController::class, 'index'])->name('lease.notes.dashboard');

// Notifications routes
Route::get('/notificaties/lees-alles', [NotificationsController::class, 'markAll'])->name('notifications.markAll');
Route::get('/notificaties/{type?}', [NotificationsController::class, 'index'])->name('notifications.index');

// Audit routes
Route::get('/audit', [AuditController::class, 'index'])->name('audit.index');
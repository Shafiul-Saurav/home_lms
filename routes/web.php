<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Backend\ModuleController;
use App\Http\Controllers\Trash\RoleTrashController;
use App\Http\Controllers\Trash\UserTrashController;
use App\Http\Controllers\Trash\ModuleTrashController;
use App\Http\Controllers\Backend\AdminLoginController;
use App\Http\Controllers\Backend\PermissionController;
use App\Http\Controllers\Frontend\UserLogoutController;
use App\Http\Controllers\Trash\PermissionTrashController;
use App\Http\Controllers\Backend\HomeController as BackendHomeController;

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

/*
|--------------------------------------------------------------------------
| Frontend
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('frontend.pages.home');
});

Route::prefix('user')->middleware('auth', 'is_user')->group(function(){
    Route::get('/dashboard', [HomeController::class, 'userDashboard'])->name('user.dashboard');
    Route::post('/logout', [UserLogoutController::class, 'logout'])->name('user.logout');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

/*
|--------------------------------------------------------------------------
| Backend
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->group(function(){

    Route::get('/login', [AdminLoginController::class, 'loginPage'])->name('admin.loginpage');
    Route::post('/login', [AdminLoginController::class, 'login'])->name('admin.login');
});

Route::prefix('admin')->middleware('auth', 'is_admin')->group(function(){
    Route::get('/dashboard', [BackendHomeController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::post('/logout', [AdminLoginController::class, 'adminLogout'])->name('admin.logout');

    // Module Route
    Route::get('modules/trash', [ModuleTrashController::class, 'trash'])
    ->name('modules.trash');
    Route::get('modules/{module_slug}/restore', [ModuleTrashController::class, 'restore'])
    ->name('modules.restore');
    Route::delete('modules/{module_slug}/forcedelete', [ModuleTrashController::class, 'forceDelete'])
    ->name('modules.forcedelete');
    Route::resource('/modules', ModuleController::class);

    // Permission Route
    Route::get('permissions/trash', [PermissionTrashController::class, 'trash'])
    ->name('permissions.trash');
    Route::get('permissions/{permission_slug}/restore', [PermissionTrashController::class, 'restore'])
    ->name('permissions.restore');
    Route::delete('permissions/{permission_slug}/forcedelete', [PermissionTrashController::class, 'forceDelete'])
    ->name('permissions.forcedelete');
    Route::resource('/permissions', PermissionController::class);

    // Role Route
    Route::get('roles/trash', [RoleTrashController::class, 'trash'])
    ->name('roles.trash');
    Route::get('roles/{role_slug}/restore', [RoleTrashController::class, 'restore'])
    ->name('roles.restore');
    Route::delete('roles/{role_slug}/forcedelete', [RoleTrashController::class, 'forceDelete'])
    ->name('roles.forcedelete');
    Route::resource('roles', RoleController::class);

    // User Route
    Route::get('/users/trash', [UserTrashController::class, 'trash'])->name('users.trash');
    Route::get('/users/restore/{id}', [UserTrashController::class, 'restore'])
    ->name('users.restore');
    Route::delete('/users/forcedelete/{id}', [UserTrashController::class, 'forceDelete'])
    ->name('users.forcedelete');

    // Ajax Call Active
    Route::get('check/user/is_active/{user_id}', [UserController::class, 'checkActive'])
        ->name('user.is_active.ajax');
    Route::resource('/users', UserController::class);
});

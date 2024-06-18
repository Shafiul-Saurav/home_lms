<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Backend\AdminLoginController;
use App\Http\Controllers\Backend\HomeController as BackendHomeController;
use App\Http\Controllers\Frontend\UserLogoutController;

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

// Route::get('/', function () {
//     return view('backend.pages.dashboard');
// });

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
});

<?php


use App\Http\Controllers\Admin\AudioController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UsersController;
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


Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');


Route::group(['prefix' => '', 'middleware' => 'auth'], function () {
    Route::get('/dashboard', [DashboardController::class, 'showDashboard'])->name('show.dashboard');

    Route::prefix('categories')->name('category.')->group(function () {
        Route::get('', [CategoryController::class, 'index'])->name('index');
        Route::post('', [CategoryController::class, 'store'])->name('store');
        Route::get('create', [CategoryController::class, 'create'])->name('create');
        Route::get('{id}', [CategoryController::class, 'show'])->name('show');
        Route::put('{category}', [CategoryController::class, 'update'])->name('update');
        Route::delete('{category}', [CategoryController::class, 'destroy'])->name('destroy');
    });
    Route::get('datatables/categories', [CategoryController::class, 'datatables'])->name('category.datatables');


    Route::prefix('audios')->name('audio.')->group(function () {
        Route::get('', [AudioController::class, 'index'])->name('index');
        Route::post('', [AudioController::class, 'store'])->name('store');
        Route::get('create', [AudioController::class, 'create'])->name('create');
        Route::get('{id}', [AudioController::class, 'show'])->name('show');
        Route::put('{audio}', [AudioController::class, 'update'])->name('update');
        Route::delete('{audio}', [AudioController::class, 'destroy'])->name('destroy');
    });
    Route::get('datatables/audios', [AudioController::class, 'datatables'])->name('audio.datatables');

    Route::prefix('users')->name('user.')->group(function () {
        Route::get('', [UsersController::class, 'index'])->name('index');
        Route::post('', [UsersController::class, 'store'])->name('store');
        Route::get('create', [UsersController::class, 'create'])->name('create');
        Route::get('{id}', [UsersController::class, 'show'])->name('show');
        Route::put('{user}', [UsersController::class, 'update'])->name('update');
        Route::delete('{user}', [UsersController::class, 'destroy'])->name('destroy');
    });
    Route::get('datatables/users', [UsersController::class, 'datatables'])->name('user.datatables');

    Route::prefix('roles')->name('role.')->group(function () {
        Route::get('', [RoleController::class, 'index'])->name('index');
        Route::post('', [RoleController::class, 'store'])->name('store');
        Route::get('create', [RoleController::class, 'create'])->name('create');
        Route::get('{id}', [RoleController::class, 'show'])->name('show');
        Route::put('{role}', [RoleController::class, 'update'])->name('update');
        Route::delete('{role}', [RoleController::class, 'destroy'])->name('destroy');
    });
    Route::get('datatables/roles', [RoleController::class, 'datatables'])->name('role.datatables');

});



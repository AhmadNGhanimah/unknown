<?php


use Illuminate\Support\Facades\Auth;
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

//Route::prefix('admin')->name('admin.')->group(function () {
//    Route::get('login', [AuthController::class,'showLogin'])->name('login.show');
//    Route::post('login', [AuthController::class,'login'])->name('login.submit');
//    Route::post('logout', [AuthController::class,'logout'])->name('logout');
//});

//Route::prefix('admin')->middleware('auth')->name('admin.')->group(function () {
//    Route::get('dashboard', function () {
//        return view('livewire.index');
//    })->name('dashboard');
//});



Route::prefix('categories')->name('category.')->group(function () {
    Route::get('', [\App\Http\Controllers\admin\CategoryController::class,'index'])->name('index');
    Route::post('', [\App\Http\Controllers\admin\CategoryController::class,'store'])->name('store');
    Route::get('create', [\App\Http\Controllers\admin\CategoryController::class,'create'])->name('create');
    Route::get('{id}', [\App\Http\Controllers\admin\CategoryController::class,'show'])->name('show');
    Route::put('{category}', [\App\Http\Controllers\admin\CategoryController::class,'update'])->name('update');
    Route::delete('{category}', [\App\Http\Controllers\admin\CategoryController::class,'destroy'])->name('destroy');
});
Route::get('datatables/categories',  [\App\Http\Controllers\admin\CategoryController::class,'datatables'])->name('category.datatables');


Route::prefix('audios')->name('audio.')->group(function () {
    Route::get('', [\App\Http\Controllers\admin\AudioController::class,'index'])->name('index');
    Route::post('', [\App\Http\Controllers\admin\AudioController::class,'store'])->name('store');
    Route::get('create', [\App\Http\Controllers\admin\AudioController::class,'create'])->name('create');
    Route::get('{id}', [\App\Http\Controllers\admin\AudioController::class,'show'])->name('show');
    Route::put('{audio}', [\App\Http\Controllers\admin\AudioController::class,'update'])->name('update');
    Route::delete('{audio}', [\App\Http\Controllers\admin\AudioController::class,'destroy'])->name('destroy');
});
Route::get('datatables/audios',  [\App\Http\Controllers\admin\AudioController::class,'datatables'])->name('audio.datatables');

Route::prefix('users')->name('users.')->group(function () {
    Route::get('', [\App\Http\Controllers\admin\UsersController::class,'index'])->name('index');
    Route::post('', [\App\Http\Controllers\admin\UsersController::class,'store'])->name('store');
    Route::get('create', [\App\Http\Controllers\admin\UsersController::class,'create'])->name('create');
    Route::get('{id}', [\App\Http\Controllers\admin\UsersController::class,'show'])->name('show');
    Route::put('{user}', [\App\Http\Controllers\admin\UsersController::class,'update'])->name('update');
    Route::delete('{user}', [\App\Http\Controllers\admin\UsersController::class,'destroy'])->name('destroy');
});
Route::get('datatables/users',  [\App\Http\Controllers\admin\UsersController::class,'datatables'])->name('users.datatables');


Route::view('user','pages.user');
Route::view('role','pages.role');

//Route::resource('tutorial-list', TutorialsController::class)
//    ->only(['store', 'update', 'destroy'])
//    ->middleware(['permission:write tutorial']);
//Route::get('datatables/tutorial-list', [TutorialsController::class, 'datatables'])->middleware(['permission:read tutorial'])->name('tutorial-list.datatables');
//
//Route::view('audio','pages.audio');



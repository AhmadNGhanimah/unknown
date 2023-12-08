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



Route::get('categories', [\App\Http\Controllers\admin\CategoryController::class,'index'])->name('category.index');
Route::get('categories/create', [\App\Http\Controllers\admin\CategoryController::class,'create'])->name('category.create');
Route::get('categories/{id}', [\App\Http\Controllers\admin\CategoryController::class,'show'])->name('category.show');
Route::post('categories', [\App\Http\Controllers\admin\CategoryController::class,'store'])->name('category.store');
Route::put('categories/{category}', [\App\Http\Controllers\admin\CategoryController::class,'update'])->name('category.update');

Route::delete('categories/{Category}', [\App\Http\Controllers\admin\CategoryController::class,'destroy'])->name('category.destroy');
Route::get('datatables/categories',  [\App\Http\Controllers\admin\CategoryController::class,'datatables'])->name('category.datatables');
Route::view('user','pages.user');
Route::view('role','pages.role');

//Route::resource('tutorial-list', TutorialsController::class)
//    ->only(['store', 'update', 'destroy'])
//    ->middleware(['permission:write tutorial']);
//Route::get('datatables/tutorial-list', [TutorialsController::class, 'datatables'])->middleware(['permission:read tutorial'])->name('tutorial-list.datatables');
//
//Route::view('audio','pages.audio');



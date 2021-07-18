<?php

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


Route::get('/', [App\Http\Controllers\CategoryController::class, 'index']);
Route::get('/subcategory',[App\Http\Controllers\SubcategoryController::class, 'show']);

Route::get('/category', [App\Http\Controllers\CategoryController::class, 'index']);
Route::get('/addcategory',function () {
        return view('addcategory');
    }
);
Route::get('/addsubcategory',[App\Http\Controllers\SubcategoryController::class, 'index']);

Route::post('/addsubcategory', [App\Http\Controllers\SubcategoryController::class, 'create'])->name('subcategory.create');
Route::post('/addcategory', [App\Http\Controllers\CategoryController::class, 'create'])->name('category.create');
Route::post('/edit/{id}', [App\Http\Controllers\CategoryController::class, 'edit']);
Route::post('/subcategory/edit/{id}', [App\Http\Controllers\SubcategoryController::class, 'edit']);
Route::post('/update/{id}', [App\Http\Controllers\CategoryController::class, 'update']);
Route::post('/updatesubid/{id}', [App\Http\Controllers\SubcategoryController::class, 'update']);

Route::get('search', [App\Http\Controllers\CategoryController::class,'search']);

Route::get('subsearch', [App\Http\Controllers\SubcategoryController::class,'search']);
Route::post('/category/delete/{id}', [App\Http\Controllers\CategoryController::class, 'destroy']);
Route::post('/subcategory/delete/{id}', [App\Http\Controllers\SubcategoryController::class, 'destroy']);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

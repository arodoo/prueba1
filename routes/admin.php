<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\UserController;

Route::get('', [HomeController::class, 'index']);

Route::group(['prefix' => 'admin'], function(){
    Route::get('/usuarios',[App\Http\Controllers\Admin\HomeController::class, 'usuarios'])->name('admin.usuarios');
    Route::get('/producto',[App\Http\Controllers\Admin\HomeController::class, 'producto'])->name('admin.producto');
    Route::get('/categorias',[App\Http\Controllers\Admin\HomeController::class, 'categorias'])->name('admin.categorias');
    Route::get('/productos',[App\Http\Controllers\Admin\HomeController::class, 'productos'])->name('admin.productos');
    Route::get('/carritos',[App\Http\Controllers\Admin\HomeController::class, 'carritos'])->name('admin.carritos');

});


Route::group(['prefix' => 'users'], function(){
    Route::get('/usuarios',[App\Http\Controllers\Admin\UserController::class, 'index'])->name('users.index');
    Route::get('/nuevo',[App\Http\Controllers\Admin\UserController::class, 'create'])->name('users.create');
    Route::post('/store',[App\Http\Controllers\Admin\UserController::class, 'store'])->name('users.store');
    Route::get('/edit/{id}',[App\Http\Controllers\Admin\UserController::class, 'edit'])->name('users.edit');
    Route::put('/{id}',[App\Http\Controllers\Admin\UserController::class, 'update'])->name('users.update');
    Route::get('/show/{id}',[App\Http\Controllers\Admin\UserController::class, 'show'])->name('users.show');
    Route::get('/delete/{id}',[App\Http\Controllers\Admin\UserController::class, 'delete'])->name('users.delete');
    Route::get('{id}/destroy',[App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('users.destroy');
});

Route::group(['prefix' => 'category'], function(){
    Route::get('/categorias',[App\Http\Controllers\Admin\Categorycontroller::class, 'index'])->name('category.index');
    Route::get('/nueva',[App\Http\Controllers\Admin\Categorycontroller::class, 'create'])->name('category.create');
    Route::post('/store',[App\Http\Controllers\Admin\Categorycontroller::class, 'store'])->name('category.store');
    Route::get('/edit/{id}',[App\Http\Controllers\Admin\Categorycontroller::class, 'edit'])->name('category.edit');
    Route::put('/{id}',[App\Http\Controllers\Admin\Categorycontroller::class, 'update'])->name('category.update');
    Route::get('/delete/{id}',[App\Http\Controllers\Admin\Categorycontroller::class, 'delete'])->name('category.delete');
    Route::get('/{id}/destroy',[App\Http\Controllers\Admin\Categorycontroller::class, 'destroy'])->name('category.destroy');
    Route::get('/show/{id}',[App\Http\Controllers\Admin\Categorycontroller::class, 'show'])->name('category.show');
});
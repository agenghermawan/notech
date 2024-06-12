<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProductController::class, 'index'])->name('product.index');
Route::post('/store/item', [ProductController::class, 'store'])->name('store.item');
Route::delete('/delete/item/{id}', [ProductController::class ,'destroy'])->name('product.delete');

Route::put('/update/item/{id}', [ProductController::class, 'update'])->name('product.update');

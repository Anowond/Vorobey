<?php

use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\VideoController;

Route::get('/', [IndexController::class, 'index'])->name('index');
Route::get('/videos', [VideoController::class, 'index'])->name('videos');
Route::get('/videos/{video}', [VideoController::class, 'show'])->name('videos.show');
Route::get('/shop', [ShopController::class, 'index'])->name('shop');

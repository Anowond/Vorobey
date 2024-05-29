<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\URL;
use Spatie\Sitemap\SitemapGenerator;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\RegisterController;

// Base
Route::get('/', [IndexController::class, 'index'])->name('index');

// Videos
Route::get('/videos', [VideoController::class, 'index'])->name('videos');
Route::get('/videos/{video}', [VideoController::class, 'show'])->name('videos.show');
Route::get('/tags/{tag}', [VideoController::class, 'videosByTag'])->name('videos.byTag');
Route::post('/videos/{video}/comment', [VideoController::class, 'comment'])->name('comment')->middleware('auth');
// Route store pour le test
Route::post('/videos', [VideoController::class, 'store'])->name('videos.store');

// Register & Login
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])
->name('register')->middleware('guest');
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Home
Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');
Route::patch('/home', [HomeController::class, 'updatePassword'])->name('updatePassword');

// Admin
Route::get('/admin', [AdminController::class, 'index'])->name('admin')->middleware('admin');
// Admin videos
Route::get('/admin/video/edit/{video}', [AdminController::class, 'edit'])->name('admin.edit.video')->middleware('admin');
Route::patch('/admin/video/edit/{video}', [AdminController::class, 'update'])->name('admin.update')->middleware('admin');
// Admin users
Route::get('/admin/user/edit/{user}', [UserController::class, 'edit'])->name('admin.edit.user')->middleware('admin');


// Sitemap
Route::get('/sitemap/videos', [SitemapController::class, 'videos'])->name('sitemap.videos');
Route::get('/sitemap/videos/{video}', [SitemapController::class, 'show'])->name('sitemap.show');
Route::get('/sitemap/index', [SitemapController::class, 'index'])->name('sitemap.index');

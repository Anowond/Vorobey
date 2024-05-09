<?php

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

Route::get('/', [IndexController::class, 'index'])->name('index');

Route::get('/videos', [VideoController::class, 'index'])->name('videos');
Route::get('/videos/{video}', [VideoController::class, 'show'])->name('videos.show');
Route::get('/tags/{tag}', [VideoController::class, 'videosByTag'])->name('videos.byTag');
Route::post('/videos/{video}/comment', [VideoController::class, 'comment'])->name('comment')->middleware('auth');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register')->middleware('guest');
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');
Route::patch('/home', [HomeController::class, 'updatePassword'])->name('updatePassword');

Route::get('/shop', [ShopController::class, 'index'])->name('shop');

Route::resource('/admin/videos', AdminController::class)->except('create', 'show')->names('admin.video')->middleware('admin');

Route::get('/sitemap/videos', [SitemapController::class, 'videos'])->name('sitemap.videos');
Route::get('/sitemap/videos/{video}', [SitemapController::class, 'show'])->name('sitemap.show');
Route::get('/sitemap/index', [SitemapController::class, 'index'])->name('sitemap.index');

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SigninController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\JurnalisController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\DashboardPostController;

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

Route::get('/', [PostController::class, 'index'])->name('home');
Route::get('/post', [PostController::class, 'index'])->name('post');
Route::get('/post/{post:slug}', [PostController::class, 'show'])->name('detail.post');

Route::get('/jurnalis', [JurnalisController::class, 'index'])->name('jurnalis');

Route::get('/signin', [SigninController::class, 'index'])->name('sign.in')->middleware('guest');
Route::post('/signin', [SigninController::class, 'authenticate'])->name('sign.auth');
Route::get('/signout', [SigninController::class, 'signout'])->name('sign.out');

Route::resource('/signup', SignupController::class)->middleware('guest');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

Route::get('/dashboard/posts/checkSlug', [DashboardPostController::class, 'checkSlug'])->middleware('auth');
Route::resource('/dashboard/posts', DashboardPostController::class)->middleware('auth');

//pengecualian show
Route::resource('/dashboard/categories', AdminCategoryController::class)->except('show')->middleware('admin');
Route::get('/dashboard/categories/checkSlug', [AdminCategoryController::class, 'checkSlug'])->middleware('admin');

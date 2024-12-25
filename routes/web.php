<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ExamResultController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Models\Categories;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Auth::routes();

Route::prefix('admin')->group(function () {
    Route::get('/', [PostController::class, 'index'])->name('admin.index');
    Route::get('/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/store', [PostController::class, 'store'])->name('posts.store');
    Route::get('/{id}', [PostController::class, 'show'])->name('posts.show');
    Route::post('/check', [PostController::class, 'check'])->name('posts.check');
});

Route::group(['prefix' => 'category'], function() {
	Route::get('/{id}', [CategoriesController::class, 'show'])->name('cat.show');
});

Route::group(['prefix' => 'exam-results'], function() {
	Route::get('/', [ExamResultController::class, 'index'])->name('er.index');
	Route::post('/create', [ExamResultController::class, 'store'])->name('er.store');
});

Route::get('/exam-results/user-score', [ExamResultController::class, 'userscore'])->name('er.userscore');

Route::get('/user/{id}', [UserController::class, 'show'])->name('users.show');

Route::group(['prefix' => 'admins'], function() {

	Route::get('/', [AdminController::class,'index'])->name('admin.index');
	Route::get('/posts', [AdminController::class,'posts'])->name('admin.posts');
	Route::get('/categories', [AdminController::class,'categories'])->name('admin.categories');

	Route::get('/categories/create', [CategoriesController::class,'create'])->name('cat.create');

	Route::post('/categories/store', [CategoriesController::class,'store'])->name('cat.store');

	Route::get('/users', [AdminController::class,'users'])->name('admin.users');

	Route::get('/users/create', [UserController::class,'create'])->name('users.create');
	Route::post('/users/store', [UserController::class, 'store'])->name('users.store');

});
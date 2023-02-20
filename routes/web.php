<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TrashedPostController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
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

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/explore', [PageController::class, 'explore'])->name('explore');
Route::get('/topics', [PageController::class, 'topics'])->name('topics');
Route::get('/write', [PageController::class, 'write'])->name('write')->middleware('auth');
Route::post('/store', [PageController::class, 'storeArticle'])->name('storeArticle')->middleware('auth');
Route::get('/authors', [PageController::class, 'authors'])->name('authors')->middleware('auth');
Route::get('/topics/{post}', [PageController::class, 'viewArticle'])->name('viewArticle');
Route::get('/categories/{category}', [PageController::class, 'categoryPost'])->name('categoryPost');
Route::get('/tags/{tag}', [PageController::class, 'tagPost'])->name('tagPost');
Route::get('/author/{user}', [PageController::class, 'author'])->name('author');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/admin/register', [AdminController::class, 'register'])->name('admin.register');
Route::post('/admin/create', [AdminController::class, 'store'])->name('admin.store');

Route::middleware(['auth', 'role'])->group(function () {
    Route::resource("dashboard/categories", CategoryController::class);
    Route::resource("dashboard/tags", TagController::class);
    Route::resource("dashboard/posts", PostController::class);
    Route::resource("dashboard/users", UserController::class);
    Route::post('dashboard/users/{user}/changerole', [UserController::class, 'changeRole'])->name('users.changeRole');
    Route::get('dashboard/search',[ SearchController::class, 'search'])->name('search');
    Route::get('/dashboard/create', [UserController::class, 'create']);
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::resource("/dashboard/trashed", TrashedPostController::class);
    Route::put('/dashboard/posts/{post}/featured', [PostController::class, 'toggleFeatured'])->name('posts.toggleFeatured');
    Route::put('/dashboard/posts/{post}/picked', [PostController::class, 'togglePicked'])->name('posts.togglePicked');
    Route::post('/dashboard/posts/{post}/increasePopularity', [PostController::class, 'increasePopularity'])->name('posts.increasePopularity');
});


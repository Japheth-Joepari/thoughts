<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\SearchController;
use App\Http\Controllers\admin\TagController;
use App\Http\Controllers\admin\PostController;
use App\Http\Controllers\admin\TrashedPostController;
use App\Http\Controllers\admin\UserController;

use App\Http\Controllers\pages\CategoryTagController;
use App\Http\Controllers\pages\ClapsController;
use App\Http\Controllers\pages\ContactController;
use App\Http\Controllers\pages\ExploreController;
use App\Http\Controllers\pages\HomeController;
use App\Http\Controllers\pages\ProfileController;
use App\Http\Controllers\pages\TopicsController;
use App\Http\Controllers\pages\SearchResultController;


use App\Http\Controllers\pages\viewArticleController;
use App\Http\Controllers\pages\ArticleController;
use App\Http\Controllers\pages\DeleteReplyController;
use App\Http\Controllers\SocialAuthController;

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
Route::get('/admin/register', [AdminController::class, 'register'])->name('admin.register');
Route::post('/admin/create', [AdminController::class, 'store'])->name('admin.store');
Route::middleware(['auth', 'role'])->group(function () {
    Route::get('/dashboard',  [DashboardController::class, 'index'])->name('dashboard');
    Route::resource("dashboard/categories", CategoryController::class);
    Route::resource("dashboard/tags", TagController::class);
    Route::resource("dashboard/posts", PostController::class);
    Route::resource("dashboard/users", UserController::class);
    Route::post('dashboard/users/{user}/changerole', [UserController::class, 'changeRole'])->name('users.changeRole');
    Route::get('dashboard/search',[ SearchController::class, 'search'])->name('search');
    Route::get('/dashboard/create', [UserController::class, 'create']);
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource("/dashboard/trashed", TrashedPostController::class);
    Route::put('/dashboard/posts/{post}/featured', [PostController::class, 'toggleFeatured'])->name('posts.toggleFeatured');
    Route::put('/dashboard/posts/{post}/picked', [PostController::class, 'togglePicked'])->name('posts.togglePicked');
    Route::post('/dashboard/posts/{post}/increasePopularity', [PostController::class, 'increasePopularity'])->name('posts.increasePopularity');
});


Route::get('/back', function() {
    return redirect()->intended();
});
Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/explore', [ExploreController::class, 'explore'])->name('explore');
Route::get('/topics', [TopicsController::class, 'topics'])->name('topics');
Route::get('/write', [ArticleController::class, 'write'])->name('write')->middleware('auth');
Route::get('/write/{post}', [ArticleController::class, 'editArticle'])->name('editArticle')->middleware('auth');
Route::post('/write/{post}', [ArticleController::class, 'updateArticle'])->name('updateArticle')->middleware('auth');
Route::post('/write/{post}/delete', [ArticleController::class, 'deleteArticle'])->name('deleteArticle')->middleware('auth');
Route::post('/deletereply/{reply}/delete', [DeleteReplyController::class, 'deleteReply'])->name('deleteReply')->middleware('auth');


// Route::post('/comment/{post}', [CommentController::class, 'comments'])->name('comments')->middleware('auth');


Route::post('/store', [ArticleController::class, 'storeArticle'])->name('storeArticle')->middleware('auth');
Route::get('/topics/{post}', [viewArticleController::class, 'viewArticle'])->name('viewArticle');
Route::get('/categories/{category}', [CategoryTagController::class, 'categoryPost'])->name('categoryPost');
Route::get('/tags/{tag}', [CategoryTagController::class, 'tagPost'])->name('tagPost');
Route::get('/author/{user}', [ProfileController::class, 'author'])->name('author');
Route::get('editprofile/{user}', [ProfileController::class, 'editProfile'])->name('editProfile')->middleware('auth');
Route::post('/update/{user}', [ProfileController::class, 'updateProfile'])->name('updateProfile')->middleware('auth');
Route::post('toggleClap/{post}', [ClapsController::class, 'toggleClap'])->name('toggleClap')->middleware('auth');
Route::get('contact', [ContactController::class, 'contact'])->name('contact');
Route::get('search',[ SearchResultController::class, 'search'])->name('searchPost');

// Socialite Routes GOOGLE
Route::get('/auth/google', [SocialAuthController::class, 'redirectToGoogle'])->name('googleAuth');
Route::get('/auth/google/callback', [SocialAuthController::class, 'handleGoogleCallback']);

// Socialite Routes github
Route::get('/auth/github', [SocialAuthController::class, 'redirectToGithub']);
Route::get('/auth/github/callback', [SocialAuthController::class, 'handleGithubCallback']);

// Socialite Routes facebook
// Route::get('/auth/facebook', [SocialAuthController::class, 'redirectToFacebook']);
// Route::get('/auth/facebook/callback', [SocialAuthController::class, 'handleFacebookCallback']);



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    //
});

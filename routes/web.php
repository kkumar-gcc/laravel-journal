<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\PrivateProfileController;
use App\Http\Controllers\PublicProfileController;
use App\Http\Controllers\TagController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');
Route::group(['middleware' => ['auth']], function () {
    // Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::post('/comment', [CommentController::class, 'store']);
    Route::post('/reply/{id}', [CommentController::class, 'store']);
    Route::get("/settings", [PrivateProfileController::class, 'index']);
    Route::put("/settings/social-links", [PrivateProfileController::class, 'social']);
    Route::post("/profile/update", [PrivateProfileController::class, 'store']);
    Route::put("/user/password/update", [UserController::class, 'resetPassword']);

    Route::get("/new-blog", [BlogController::class, 'create'])->name("new-blog");
    Route::put("/new-blog", [BlogController::class, 'store'])->name("blog.create");
    Route::get("/blogs/edit/{title}", [BlogController::class, 'edit']);
    Route::put("/blogs/edit", [BlogController::class, 'editStore'])->name('blogs.edit');
    Route::get("/blogs/manage/{title}", [BlogController::class, 'manage']);
    Route::put("/blogs/manage/seo", [BlogController::class, 'seo'])->name('blogs.manage.seo');
    Route::put("/blogs/manage", [BlogController::class, 'manageStore'])->name('blogs.manage');
    Route::get("/blogs/stats/{title}", [BlogController::class, 'stats']);
});
Route::get("/blogs", [BlogController::class, 'index'])->name('blogs');
Route::get("/blogs/{slug}", [BlogController::class, 'show']);
Route::get("blogs/tagged/{slug}", [BlogController::class, "tagSearch"]);
Route::get("/tags", [TagController::class, 'index'])->name('tags');
Route::get("users/{username}", [PublicProfileController::class, 'index']);
require __DIR__ . '/auth.php';

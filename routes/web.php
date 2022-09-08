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

    Route::get("/new-blog", [BlogController::class, 'create'])->name("blog.create");
    // Route::middleware(['cors'])->group(function () {
    //     Route::post("blog/draft", [BlogController::class, 'draft'])->name("blog.draft");
    //     Route::put("blog/create", [BlogController::class, 'post']);
    //     Route::get("/blogs/edit/{title}", [BlogController::class, 'edit']);
    //     Route::put("/blogs/edit", [BlogController::class, 'editStore'])->name('blogs.edit');
    //     Route::get("/blogs/manage/{title}", [BlogController::class, 'manage']);
    //     Route::put("/blogs/manage/seo", [BlogController::class, 'seo'])->name('blogs.manage.seo');
    //     Route::put("/blogs/manage", [BlogController::class, 'manageStore'])->name('blogs.manage');
    //     Route::get("/blogs/stats/{title}", [BlogController::class, 'stats']);
    //     Route::get("blogs/{id}/statics", [BlogController::class, 'statics']);
    //     Route::get("/drafts/{id}", [PrivateProfileController::class, 'draft']);
    //     Route::delete("blog/{id}/delete", [BlogController::class, 'destroy']);
    //     Route::put("/follow", [FriendshipController::class, 'store'])->name("follow");
    //     Route::put("/bloglike/create", [BlogLikeController::class, 'like'])->name("bloglike.create");
    //     Route::put("/blogdislike/create", [BlogLikeController::class, 'dislike'])->name("blogdislike.create");
    //     Route::put("/commentlike/create", [CommentLikeController::class, 'like'])->name("commentlike.create");
    //     Route::put("/commentdislike/create", [CommentLikeController::class, 'dislike'])->name("commentdislike.create");
    //     Route::put("/replylike/create", [ReplyLikeController::class, 'like'])->name("replylike.create");
    //     Route::put("/replydislike/create", [ReplyLikeController::class, 'dislike'])->name("replydislike.create");
    //     Route::put("/bookmark/create", [BookmarkController::class, 'store'])->name("bookmark.create");
    //     Route::put("/blogpin/create", [BlogPinController::class, 'store'])->name("blogpin.create");
    //     Route::put("/comment/create", [CommentController::class, 'store'])->name("comment.create");
    //     Route::put("/reply/create", [ReplyController::class, 'store'])->name("reply.create");
    //     Route::put("tag/create", [TagController::class, 'store'])->name('tag.create');
    //     Route::get("/example", function () {
    //         return view('example');
    //     });
    // });
});
Route::get("/blogs", [BlogController::class, 'index'])->name('blogs');
Route::get("/blogs/{slug}", [BlogController::class, 'show']);
Route::get("blogs/tagged/{slug}", [BlogController::class, "tagSearch"]);
Route::get("/tags", [TagController::class, 'index'])->name('tags');
Route::get("users/{username}", [PublicProfileController::class, 'index']);
require __DIR__ . '/auth.php';

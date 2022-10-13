<?php

use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PrivateProfileController;
use App\Http\Controllers\PublicProfileController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

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
})->name('home');

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::group(['middleware' => ['auth', 'verified']], function () {
    // Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::post('/comment', [CommentController::class, 'store']);
    Route::post('/reply/{id}', [CommentController::class, 'store']);
    Route::get("/settings", [PrivateProfileController::class, 'index']);
    Route::put("/settings/social-links", [PrivateProfileController::class, 'social']);
    Route::post("/profile/update", [PrivateProfileController::class, 'store']);
    Route::put("/user/password/update", [UserController::class, 'resetPassword']);

    Route::get("/new-blog", [BlogController::class, 'create'])->name("new-blog");
    Route::get("/blogs/edit/{slug}", [BlogController::class, 'edit']);
    Route::put("/blogs/edit", [BlogController::class, 'editStore'])->name('blogs.edit');
    Route::get("/blogs/manage/{slug}", [BlogController::class, 'manage']);
    Route::put("/blogs/manage/seo", [BlogController::class, 'seo'])->name('blogs.manage.seo');
    Route::put("/blogs/manage", [BlogController::class, 'manageStore'])->name('blogs.manage');
    Route::get("/blogs/stats/{slug}", [BlogController::class, 'stats']);
    Route::get("/notifications",[NotificationController::class,"index"]);
});
Route::middleware(['auth','verified','admin'])->name('admin.')->prefix('admin')->group(function(){
   Route::get('/',[IndexController::class,'index']);
   Route::resource('/roles',RoleController::class);
   Route::resource('/permissions',PermissionController::class);
   Route::get('/users',[IndexController::class,'users'])->name('users.index');
   Route::get('/tags',[IndexController::class,'tags'])->name('tags.index');
});

Route::get("/blogs", [BlogController::class, 'index'])->name('blogs');
Route::get("/blogs/{slug}", [BlogController::class, 'show']);
Route::get("blogs/tagged/{slug}", [BlogController::class, "tagSearch"]);
Route::get("/tags", [TagController::class, 'index'])->name('tags');
Route::get("/users", [UserController::class, 'index'])->name('users');
Route::get("users/{username}", [PublicProfileController::class, 'index']);

require __DIR__ . '/auth.php';

<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $posts = App\Models\Posts::all();  // or select based on conditions
    $users = App\Models\User::all();  // or select based on conditions
    return view('welcome', compact('posts', 'users'));
});

Route::get('/editprofile', function () {
    return view('editprofile');
});


Route::get('/admin/posts', function () {
    $posts = App\Models\Posts::all();
    return view('admin.posts', compact('posts'));
});

Route::get('/admin/users', function () {
    $users = \App\Models\User::all();
    return view('admin.users', compact('users'));
});

Route::get('/member', function () {
    $users = \App\Models\User::all();
    return view('member', compact('users'));
});


Auth::routes();

Route::get('/', [App\Http\Controllers\Controller::class, 'welcome'])->name('welcome');
Route::get('/member', [App\Http\Controllers\MemberController::class, 'index'])->name('member');;
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/admin/home',[App\Http\Controllers\HomeController::class, 'adminHome'])->name('admin.home')->middleware('isAdmin');

Route::get('/admin/users',[App\Http\Controllers\Controller::class, 'adminUsers'])->name('admin.users')->middleware('isAdmin');
Route::get('/admin/posts', [App\Http\Controllers\Controller::class, 'adminPosts'])->name('admin.posts')->middleware('isAdmin');

Route::get('/editprofile', [App\Http\Controllers\HomeController::class, 'editProfile'])->name('editprofile');
Route::get('/userpost', [App\Http\Controllers\PostsController::class, 'userpost'])->name('userpost');


Route::post('/update-name', [App\Http\Controllers\UserController::class, 'updateName'])->name('update-name');
Route::post('/update-password', [App\Http\Controllers\UserController::class, 'updatePassword'])->name('update-password');

Route::post('posts/data/{id}', [App\Http\Controllers\PostsController::class, 'postsData'])->name('posts.data');
Route::post('posts/{post}/comment', [App\Http\Controllers\PostsController::class, 'comment'])->name('post.comment');
Route::post('posts/{post}/comment/store', [\App\Http\Controllers\CommentController::class, 'store'])->name('comment.store');
Route::get('comment/{comment}/edit', [App\Http\Controllers\CommentController::class, 'edit'])->name('comment.edit');
Route::put('comments/{comment}', [\App\Http\Controllers\CommentController::class, 'update'])->name('comment.update');
Route::delete('comment/{comment}', [App\Http\Controllers\CommentController::class, 'destroy'])->name('comment.destroy');
Route::delete('posts/{post}/delete', [App\Http\Controllers\PostsController::class, 'destroy'])->name('posts.delete');


Route::controller(App\Http\Controllers\PostsController::class)->group(function () {
    Route::get('posts', 'index');
    Route::get('posts/data/{id}', 'postsData');
    Route::get('posts/create', 'create');
    Route::post('posts/create', 'store');
    Route::get('posts/{id}/edit', 'edit');
    Route::put('posts/{id}/edit', 'update');
    Route::get('posts/{id}/delete', 'destroy');
    Route::get('search', 'search');
    Route::get('searchUser', 'searchUser');
    Route::get('searchNormal', 'searchNormal');
});

Route::controller(App\Http\Controllers\UserController::class)->group(function () {
    Route::get('user', 'index');
    Route::get('user/{id}/edit', 'edit');
    Route::put('user/{id}/edit', 'update');
    Route::get('user/{id}/delete', 'destroy');
    
});


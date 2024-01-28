<?php

use App\Http\Controllers\CommentsController;
use App\Http\Controllers\MembershipsController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\SubscriptionsController;
use Illuminate\Support\Facades\Route;

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

require __DIR__.'/auth.php';

Route::get('/', function () {
    return view('layouts.homepage');
});

// Profile Page
Route::get('/{id}', [ProfileController::class, 'profile'])->name('profile.view');

// Single Post View
Route::get('/post/{id}', [PostsController::class, 'single'])->name('posts.single');

Route::get('/dashboard', function () {
    return view('layouts.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    // Comments
    Route::get('/dashboard/comments', [CommentsController::class, 'index'])->name('memberships.index');
    Route::get('/dashboard/comments/add', [CommentsController::class, 'create'])->name('memberships.create');
    Route::post('/dashboard/comments/save', [CommentsController::class, 'save'])->name('memberships.save');
    Route::get('/dashboard/comments/edit', [CommentsController::class, 'edit'])->name('memberships.update');
    Route::post('/dashboard/comments/update', [CommentsController::class, 'update'])->name('memberships.update');
    Route::get('/dashboard/comments/delete', [CommentsController::class, 'destroy'])->name('memberships.delete');

    // Memberships
    Route::get('/dashboard/memberships', [MembershipsController::class, 'index'])->name('memberships.index');
    Route::get('/dashboard/memberships/add', [MembershipsController::class, 'create'])->name('memberships.create');
    Route::post('/dashboard/memberships/save', [MembershipsController::class, 'save'])->name('memberships.save');
    Route::get('/dashboard/memberships/edit', [MembershipsController::class, 'edit'])->name('memberships.update');
    Route::post('/dashboard/memberships/update', [MembershipsController::class, 'update'])->name('memberships.update');
    Route::get('/dashboard/memberships/delete', [MembershipsController::class, 'destroy'])->name('memberships.delete');

    // Posts
    Route::get('/dashboard/posts', [PostsController::class, 'index'])->name('posts.index');
    Route::get('/dashboard/posts/add', [PostsController::class, 'create'])->name('posts.create');
    Route::post('/dashboard/posts/save', [PostsController::class, 'store'])->name('posts.save');
    Route::get('/dashboard/posts/edit', [PostsController::class, 'edit'])->name('posts.edit');
    Route::post('/dashboard/posts/update', [PostsController::class, 'update'])->name('posts.update');
    Route::get('/dashboard/posts/delete', [PostsController::class, 'destroy'])->name('posts.delete');

    // Profiles
    Route::get('/dashboard/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/dashboard/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/dashboard/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Staff
    Route::get('/dashboard/staff', [StaffController::class, 'index'])->name('staff.index');
    Route::get('/dashboard/staff/remove/{id}', [StaffController::class, 'remove'])->name('staff.remove');
    Route::get('/dashboard/staff/add', [StaffController::class, 'create'])->name('staff.create');
    Route::post('/dashboard/staff/save', [StaffController::class, 'save'])->name('staff.save');

    // Subscriptions
    Route::get('/dashboard/subscriptions', [SubscriptionsController::class, 'index'])->name('subscription.index');

});



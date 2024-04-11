<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FollowController;

Auth::routes();

    Route::group(['middleware' => 'auth'], function(){
        Route::get('/', [HomeController::class, 'index'])->name('home');

        // Task
        Route::post('/task/store', [TaskController::class, 'store'])->name('task.store');
        Route::patch('/task/{id}/edit', [TaskController::class, 'editStatus'])->name('task.edit');
        Route::get('/task/pending', [TaskController::class, 'showPending'])->name('task.pending');
        Route::get('/task/completed', [TaskController::class, 'showCompleted'])->name('task.completed');
        Route::get('/task/friends', [TaskController::class, 'showFriendTask'])->name('task.friend');
        Route::delete('/task/{id}/destroy', [TaskController::class, 'destroy'])->name('task.destroy');

        // Profile
        Route::get('/profile/{id}', [UserController::class, 'show'])->name('profile');
        Route::get('/profile/{id}/edit', [UserController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile/update', [UserController::class, 'update'])->name('profile.update');

        // Follow
        Route::post('/follow/{user_id}/store', [FollowController::class, 'store'])->name('follow.store');
        Route::delete('/follow/{user_id}/destroy', [FollowController::class, 'destroy'])->name('follow.destroy');
    });
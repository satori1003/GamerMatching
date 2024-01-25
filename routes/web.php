<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TalkController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentController;

Route::get('/home', [GameController::class, 'index'])->name('Home');

Route::get('/games/{game}',[GameController::class,'show']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::controller(GameController::class)->middleware(['auth'])->group(function(){
    Route::get('/', 'index')->name('index');    
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/talk/{user}', [TalkController::class, 'openTalk']);

Route::post('/talk', [GameController::class, 'sendMessage']);

Route::get('/messages/{message}',[GameController::class,'comment']);

Route::post('/comments/{comment_id}/comments',[CommentController::class,'store']);
Route::get('/comments/{comment_id}',[CommentController::class,'destroy']);
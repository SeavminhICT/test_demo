<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/blogs', [PageController::class, 'blog'])->name('blog.index');
Route::get('/blog/{id}', [PageController::class, 'post'])->name('blog.show');
Route::get('/experiments', [PageController::class, 'experiments'])->name('experiments');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');

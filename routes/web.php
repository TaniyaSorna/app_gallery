<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\AlbumPhotoController;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::resource('/album', AlbumController::class);

// Route::resource('/album-phpto', AlbumPhotoController::class);




Route::view('/', 'layouts.sideapp');


Route::resource('/album', AlbumController::class);

Route::get('/photo/create/{album_id}', [PhotoController::class, 'create'])->name('photo.create');
Route::post('/photo/{album_id}', [PhotoController::class, 'store'])->name('photo.store');
Route::delete('/photos/{photo}', [PhotoController::class, 'destroy'])->name('photo.destroy');



Route::view('/login', 'user.login')->name('login');
Route::view('/registration', 'User.registration')->name('registration');



Route::post('/registration', [UserController::class, 'registration']);
Route::post('/login', [UserController::class, 'login']);

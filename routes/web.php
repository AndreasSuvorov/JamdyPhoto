<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/{uuid}', [App\Http\Controllers\AlbumController::class, 'show'])->name('album.show');
Route::post('/album/{id}/media/upload', [App\Http\Controllers\AlbumController::class, 'uploadMedia'])->name('media.upload');
Route::get('/album/{id}/media/download', [App\Http\Controllers\AlbumController::class, 'downloadMedia'])->name('media.download');

Route::middleware('auth')->group(function () {
    Route::controller(\App\Http\Controllers\AlbumController::class)->group(function() {

        Route::get('/album', 'admin')->name('album');
        Route::get('/album/edit/{id?}', 'edit')->name('album.edit');
        Route::post('/album/create', 'create')->name('album.create');
        Route::post('/album/update/{id}', 'update')->name('album.update');


    });

});

<?php

use Illuminate\Support\Facades\Route;
use Modules\Storage\Http\Controllers\CommentController;
use Modules\Storage\Http\Controllers\StarredController;
use Modules\Storage\Http\Controllers\StorageController;

/*
|--------------------------------------------------------------------------
| Storage Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your module. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

ladmin()->route(function () {
    Route::group(['prefix' => 'storage', 'as' => 'storage.'], function () {

        Route::controller(StorageController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/', 'store')->name('store');
            Route::post('/upload', 'upload')->name('upload');
            Route::get('/download', 'download')->name('download');
            Route::delete('/delete', 'destroy')->name('destroy');
            Route::get('/details', 'details')->name('details');
            Route::post('/star', 'star')->name('star');
            Route::post('/comment', 'comment')->name('comment');
            Route::delete('/comment/{id}', 'delete_comment')->name('delete-comment');
        });
    });
});

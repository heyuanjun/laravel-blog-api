<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\MusicController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('', function () {
    return phpinfo();
});

Route::group([
    'middleware' => ['cors']
], function () {

    // articles
    Route::group(['prefix' => 'articles'], function () {
        Route::get('', [ArticleController::class, 'articles']);
    });

    // categories
    Route::group(['prefix' => 'categories'], function () {
        Route::get('', [CategoryController::class, 'categories']);
    });

    // messages
    Route::group(['prefix' => 'messages'], function () {
        Route::get('', [MessageController::class, 'messages']);
    });

    // music
    Route::group(['prefix' => 'music'], function () {
        Route::get('{id}', [MusicController::class, 'music']);
    });

});

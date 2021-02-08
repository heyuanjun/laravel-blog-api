<?php

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

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', ['prefix' => 'api',
    'namespace' => 'App\Http\Controllers\V1',
    'middleware' => ['cors']], function () use ($api) {

    // articles
    $api->group(['prefix' => 'articles'], function () use ($api) {
        $api->get('', 'ArticleController@articles');
        $api->get('recent', 'ArticleController@recentArticles');
        $api->get('{id}/detail', 'ArticleController@getArticleById');
    });

    // categories
    $api->group(['prefix' => 'categories'], function () use ($api) {
        $api->get('', 'CategoryController@categories');
        $api->post('many', 'CategoryController@getManyCategories');
    });

    // labels
    $api->group(['prefix' => 'labels'], function () use ($api) {
        $api->get('', 'LabelController@labels');
        $api->get('info', 'LabelController@getLabelInfo');
    });

    // messages
    $api->group(['prefix' => 'messages'], function () use ($api) {
        $api->get('', 'MessageController@messages');
        $api->post('leave', 'MessageController@leaveMessage');
    });

    // music
    $api->get('music/{id}', 'MusicController@music');

    // messages
    $api->group(['prefix' => 'photos'], function () use ($api) {
        $api->get('', 'PhotoController@photos');
    });

});

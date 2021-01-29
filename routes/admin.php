<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', ['prefix' => 'admin',
    'namespace' => 'App\Http\Controllers\Admin',
    'middleware' => ['cors']], function () use ($api) {

    $api->post('register', 'AuthController@register');
    $api->post('login', 'AuthController@login');

    $api->group(['middleware' => 'refresh'], function () use ($api) {
        $api->post('logout', 'AuthController@logout');
        $api->post('refresh', 'AuthController@refresh');
        $api->post('adminInfo', 'AuthController@getAdminWithMe');
        $api->get('guard', 'AuthController@guard');

        // articles
        $api->group(['prefix' => 'articles'], function () use ($api) {
            $api->get('', 'ArticleController@articles');
            $api->get('recent', 'ArticleController@recentArticles');
            $api->get('{id}/detail', 'ArticleController@getArticleById');
            $api->post('{id}/delete', 'ArticleController@deleteArticleById');
            $api->post('push', 'ArticleController@pushArticle');
        });
    });

});

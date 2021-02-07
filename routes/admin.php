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
    $api->post('photos/upload', 'PhotoController@uploadPhoto');

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
            $api->post('write', 'ArticleController@writeArticle');
        });

        // admins
        $api->group(['prefix' => 'admins'], function () use ($api) {
            $api->get('', 'AdminController@admins');
            $api->post('write', 'AdminController@writeAdmin');
            $api->post('{id}/delete', 'AdminController@deleteAdminById');
        });

        // photos
        $api->group(['prefix' => 'photos'], function () use ($api) {
            $api->post('write', 'PhotoController@writePhoto');
        });

    });

});

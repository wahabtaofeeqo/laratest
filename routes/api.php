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
Route::prefix('articles')->group(function () {
    Route::get('', 'ArticleController@index');
    Route::get('{id}', 'ArticleController@show');
    Route::get('{id}/like', 'ArticleController@likeArticle');
    Route::get('{id}/view', 'ArticleController@viewArticle');
    Route::get('{id}/comments', 'ArticleController@comments');
    Route::post('{id}/comments', 'ArticleController@addComment');

    Route::post('/', 'ArticleController@store');
});

<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'MainController@home');

Route::get('articles/overview', 'ArticleController@index')->name('articles.index');
Route::get('articles/new', 'ArticleController@create')->name('articles.create');
Route::post('articles/store', 'ArticleController@store')->name('articles.store');


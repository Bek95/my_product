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

//Articles Routes
Route::get('articles/overview', 'ArticleController@index')->name('articles.index');
Route::get('articles/new', 'ArticleController@create')->name('articles.create');
Route::post('articles/store', 'ArticleController@store')->name('articles.store');
Route::get('articles/{id}/edit', 'ArticleController@edit')->name('articles.edit');
Route::put('articles/{id}/update', 'ArticleController@update')->name('articles.update');
Route::get('articles/{id}/destroy', 'ArticleController@destroy')->name('articles.destroy');

//Categories Routes
Route::get('categories/overview', 'CategoryController@index')->name('categories.index');
Route::get('categories/new', 'CategoryController@create')->name('categories.create');
Route::post('categories/store', 'CategoryController@store')->name('categories.store');
Route::get('categories/{id}/edit', 'CategoryController@edit')->name('categories.edit');
Route::put('categories/{id}/update', 'CategoryController@update')->name('categories.update');
Route::get('categories/{id}/show', 'CategoryController@showArticleByCategory')->name('categories.show');


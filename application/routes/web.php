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

//Categories Routes
Route::get('categories/overview', 'CategorieController@index')->name('categories.index');
Route::get('categories/new', 'CategorieController@create')->name('categories.create');
Route::post('categories/store', 'CategorieController@store')->name('categories.store');
Route::get('categories/{id}/edit', 'CategorieController@edit')->name('categories.edit');
Route::put('categories/{id}/update', 'CategorieController@update')->name('categories.update');


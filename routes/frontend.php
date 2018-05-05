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



Route::get('/', 'IndexController@welcome')->name('home');

//news
Route::get('/news', 'NewsController@all')->name('news');
Route::get('/news/{id}/detail', 'NewsController@detail')->name('news.detail');

//events
Route::get('/events', 'EventsController@all')->name('events');
Route::get('/events/{id}/detail', 'EventsController@detail')->name('events.detail');

//gallery
Route::get('/galleryAlbums', 'GalleryController@albums')->name('gallery.albums');
Route::get('/album/{id}/gallery', 'GalleryController@single')->name('gallery.single');

//albums
Route::get('/albums', 'MusicAlbumsController@all')->name('albums');
Route::get('/albums/{id}/songs', 'MusicAlbumsController@single')->name('albums.single');

//songs
Route::get('/song/{id}', 'SongsController@single')->name('song.single');

//TODO song view

//simple pages
Route::get('/biography', 'SimplePageController@biography')->name('biography');
Route::get('/contactUs', 'SimplePageController@contactUs')->name('contactUs');
Route::post('/contactUs', 'SimplePageController@sendEmail')->name('sendEmail');


Route::post('/session', 'SessionsController@store')->name('session');
//Route::get('/logout', 'SessionsController@destroy')->name('session.destroy');
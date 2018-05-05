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



Route::get('/', 'LoginController@login')->name('index');
Route::post('/', 'LoginController@create')->name('login');
Route::get('/logout', 'LoginController@destroy')->name('logout');
Route::get('/dashboard', 'DashboardController@store')->name('dashboard');


//admins
Route::get('/cms_users/create', 'CmsUsersController@create')->name('cms_users.create');
Route::get('/cms_users/{id}/edit', 'CmsUsersController@edit')->name('cms_users.edit');
Route::get('/cms_users/all', 'CmsUsersController@all')->name('cms_users.all');
Route::post('/cms_users/store', 'CmsUsersController@store')->name('cms_users.store');
Route::post('/cms_users/update', 'CmsUsersController@update')->name('cms_users.update');
Route::post('/cms_users/delete', 'CmsUsersController@delete')->name('cms_users.delete');

//news
Route::get('/news/create', 'NewsController@create')->name('news.create');
Route::get('/news/{id}/edit', 'NewsController@edit')->name('news.edit');
Route::get('/news/all', 'NewsController@all')->name('news.all');
Route::post('/news/store', 'NewsController@store')->name('news.store');
Route::post('/news/{id}/edit', 'NewsController@edit')->name('news.edit');
Route::post('/news/delete', 'NewsController@delete')->name('news.delete');
Route::post('/news/deleteFile', 'NewsController@deleteFile')->name('news.delete-file-aj');

//news
Route::get('/events/create', 'EventsController@create')->name('events.create');
Route::get('/events/{id}/edit', 'EventsController@edit')->name('events.edit');
Route::get('/events/all', 'EventsController@all')->name('events.all');
Route::post('/events/store', 'EventsController@store')->name('events.store');
Route::post('/events/{id}/edit', 'EventsController@edit')->name('events.edit');
Route::post('/events/delete', 'EventsController@delete')->name('events.delete');
Route::post('/events/deleteFile', 'EventsController@deleteFile')->name('events.delete-file-aj');


//music albums
Route::get('/music_albums/create', 'MusicAlbumsController@create')->name('music_albums.create');
Route::get('/music_albums/{id}/edit', 'MusicAlbumsController@edit')->name('music_albums.edit');
Route::get('/music_albums/all', 'MusicAlbumsController@all')->name('music_albums.all');
Route::post('/music_albums/store', 'MusicAlbumsController@store')->name('music_albums.store');
Route::post('/music_albums/{id}/edit', 'MusicAlbumsController@edit')->name('music_albums.edit');
Route::post('/music_albums/delete', 'MusicAlbumsController@delete')->name('music_albums.delete');
Route::post('/music_albums/deleteFile', 'MusicAlbumsController@deleteFile')->name('music_albums.delete-file-aj');

//news
Route::get('/music/create', 'SongsController@create')->name('music.create');
Route::get('/music/{id}/edit', 'SongsController@edit')->name('music.edit');
Route::get('/music/all', 'SongsController@all')->name('music.all');
Route::post('/music/store', 'SongsController@store')->name('music.store');
Route::post('/music/changeStatus', 'SongsController@changeStatus')->name('music.changeStatus');
Route::post('/music/{id}/edit', 'SongsController@edit')->name('music.edit');
Route::post('/music/delete', 'SongsController@delete')->name('music.delete');
Route::post('/music/deleteFile', 'SongsController@deleteFile')->name('music.delete-file-aj');

//photo albums
Route::get('/photo_albums/create', 'PhotoAlbumsController@create')->name('photo_albums.create');
Route::get('/photo_albums/{id}/edit', 'PhotoAlbumsController@edit')->name('photo_albums.edit');
Route::get('/photo_albums/all', 'PhotoAlbumsController@all')->name('photo_albums.all');
Route::post('/photo_albums/store', 'PhotoAlbumsController@store')->name('photo_albums.store');
Route::post('/photo_albums/{id}/edit', 'PhotoAlbumsController@edit')->name('photo_albums.edit');
Route::post('/photo_albums/delete', 'PhotoAlbumsController@delete')->name('photo_albums.delete');
Route::post('/photo_albums/deleteFile', 'PhotoAlbumsController@deleteFile')->name('photo_albums.delete-file-aj');
Route::post('/photo_albums/deleteBackground', 'PhotoAlbumsController@deleteBackground')->name('photo_albums.delete-background-aj');
Route::post('/photo_albums/deletePicture', 'PhotoAlbumsController@deletePicture')->name('photo_albums.delete-picture-aj');
Route::post('/photo_albums/uploadFile', 'PhotoAlbumsController@uploadPictureFile')->name('photo_albums.upload-file-aj');

//Tasks
Route::post('/task/store', 'TasksController@store')->name('task.store');
Route::post('/task/deleteCompleted', 'TasksController@deleteCompleted')->name('task.deleteCompleted');
Route::post('/task/changeStatus', 'TasksController@changeStatus')->name('task.changeStatus');

//Background
Route::post('/background/store', 'BackgroundController@store')->name('background.store');







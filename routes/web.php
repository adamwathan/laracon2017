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

Route::get('/', function () {
    return redirect('/podcasts');
});

Route::get('/podcasts',                             'PodcastsController@index');
Route::get('/podcasts/new',                         'PodcastsController@create');
Route::post('/podcasts',                            'PodcastsController@store');
Route::get('/podcasts/{id}',                        'PodcastsController@show');
Route::get('/podcasts/{id}/edit',                   'PodcastsController@edit');
Route::patch('/podcasts/{id}',                      'PodcastsController@update');
Route::delete('/podcasts/{id}',                     'PodcastsController@destroy');

Route::post('/podcasts/{id}/publish',          'PodcastsController@published');
Route::post('/podcasts/{id}/unpublish',          'PodcastsController@unpublished');
Route::post('/podcasts/{id}/subscribe',          'PodcastsController@subscribed');
Route::post('/podcasts/{id}/unsubscribe',          'PodcastsController@unsubscribed');

Route::get('/episodes',                             'EpisodesController@index');
Route::get('/episodes/{id}',                        'EpisodesController@show');
Route::get('/episodes/{id}/edit',                   'EpisodesController@edit');
Route::patch('/episodes/{id}',                      'EpisodesController@update');

Route::get('/podcasts/{id}/episodes',               'PodcastEpisodesController@index');
Route::post('/podcasts/{id}/episodes',              'PodcastEpisodesController@store');
Route::get('/podcasts/{id}/episodes/new',           'PodcastEpisodesController@create');

Route::put('/podcasts/{id}/cover-image',            'PodcastCoverImageController@update');

Route::post('/subscriptions',                       'SubscriptionsController@store');
Route::delete('/subscriptions/{id}',                'SubscriptionsController@destroy');

Route::post('/published-podcasts',                  'PublishedPodcastsController@store');
Route::delete('/published-podcasts/{id}',           'PublishedPodcastsController@destroy');

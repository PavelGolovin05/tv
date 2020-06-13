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

Auth::routes();

Route::get('/addChannelToFavourite', 'UserFavouriteChannelController@addChannelAction');
Route::get('/home', function () {
    return view('home');
});
Route::group(['prefix'=>'channels'], function (){
    Route::get('/allChannels', 'TvChannelsController@allChannelsAction');
    Route::get('/channel/{name}', 'TvChannelsController@chosenChannelAction');
    Route::get('/findChannel', 'TvChannelsController@findChannelAction');
});

Route::get('/allTelecasts', 'TelecastsController@allTelecastsAction');
Route::get('/findTelecasts', 'TelecastsController@findTelecastsAction');
Route::get('/myChannels','UserFavouriteChannelController@myChannelsAction')->middleware('auth');
Route::get('/deleteFavourite','UserFavouriteChannelController@deleteFavouriteAction')->middleware('auth');
Route::get('/statistic','StatisticController@indexAction');
Route::get('/chosenChannelStatistic','StatisticController@chosenChannelStatisticAction');

Route::group(['prefix'=>'admin'], function (){
    Route::get('/index', 'AdminController@indexAction');
    Route::get('/channels', 'AdminController@channelsAction');
    Route::get('/addChannel', 'AdminController@addChannelAction');
    Route::get('/telecasts', 'AdminController@telecastsAction');
    Route::get('/addTelecast', 'AdminController@addTelecastAction');
    Route::get('/telecastShow', 'AdminController@telecastShowAction');
    Route::get('/addTelecastShow', 'AdminController@addTelecastShowAction');
    Route::get('/staff', 'AdminController@staffAction');
    Route::get('/addStaff', 'AdminController@addStaffAction');
    Route::get('/telecastStaff', 'AdminController@telecastStaffAction');
    Route::get('/addTelecastStaff', 'AdminController@addTelecastStaffAction');
});

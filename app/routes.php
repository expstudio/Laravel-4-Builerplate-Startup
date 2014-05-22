<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', 'HomeController@showWelcome');

Route::get('admin', array('as' => 'admin..dashboard.index', 'uses' => 'admin\DashboardController@index'));

Route::resource('/pages', 'PagesController');

Route::group(array('prefix' => 'admin'), function() {
	Route::resource('/pages', 'admin\PagesController');
	Route::resource('/settings', 'admin\SettingsController');
});
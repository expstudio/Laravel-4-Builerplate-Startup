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

Route::filter('auth', function()
{
    if ( Auth::guest() ) // If the user is not logged in
    {
        return Redirect::guest('user/login');
    }
});

// Only authenticated users will be able to access routes that begins with
// 'admin'. Ex: 'admin/posts', 'admin/categories'.
Route::when('admin*', 'auth'); 

Route::get('/', 'HomeController@showWelcome');

Route::get('admin', array('as' => 'admin..dashboard.index', 'uses' => 'admin\DashboardController@index'));

Route::resource('/pages', 'PagesController');

Route::get('/posts/tags/{tags}', array('as' => 'post.index.tag', 'uses' => 'PostsController@index_tag'));
Route::get('/posts/category/{id}', array('as' => 'post.index.category', 'uses' => 'PostsController@index_category'));
Route::resource('/posts', 'PostsController');

Route::get('/products/tags/{tags}', array('as' => 'products.index.tag', 'uses' => 'ProductsController@index_tag'));
Route::get('/products/category/{id}', array('as' => 'products.index.category', 'uses' => 'ProductsController@index_category'));
Route::resource('/products', 'ProductsController');

Route::resource('/portfolios', 'PortfoliosController');
Route::get('/portfolios/{id}/box', array('uses' => 'PortfoliosController@show_box'));

Route::post('/upload', array('as' => 'upload', 'uses' => 'UploadController@upload'));

Route::group(array('prefix' => 'admin'), function() {
	Route::resource('/posts', 'admin\PostsController');
	Route::get( '/posts/{id}/translation', array('as' => 'admin..post_translations.set', 'uses' => 'admin\PostTranslationsController@set_translation'));
	Route::post('/posts/{id}/translation', array('as' => 'admin..post_translations.store', 'uses' => 'admin\PostTranslationsController@store'));
	Route::resource('/portfolios', 'admin\PortfoliosController');
	Route::get( '/portfolios/{id}/translation', array('as' => 'admin..portfolio_translations.set', 'uses' => 'admin\PortfolioTranslationsController@set_translation'));
	Route::post('/portfolios/{id}/translation', array('as' => 'admin..portfolio_translations.store', 'uses' => 'admin\PortfolioTranslationsController@store'));
	Route::resource('/pages', 'admin\PagesController');
	Route::get( '/pages/{id}/translation', array('as' => 'admin..page_translations.set', 'uses' => 'admin\PageTranslationsController@set_translation'));
	Route::post('/pages/{id}/translation', array('as' => 'admin..page_translations.store', 'uses' => 'admin\PageTranslationsController@store'));
	Route::resource('/settings', 'admin\SettingsController');
	Route::resource('/categories', 'admin\CategoriesController');
	Route::resource('/products', 'admin\ProductsController');
	Route::resource('/product_categories', 'admin\ProductCategoriesController');
	Route::get( '/products/{id}/translation', array('as' => 'admin..product_translations.set', 'uses' => 'admin\ProductTranslationsController@set_translation'));
	Route::post('/products/{id}/translation', array('as' => 'admin..product_translations.store', 'uses' => 'admin\ProductTranslationsController@store'));
	Route::resource('/users', 'admin\UsersController');
	Route::resource('/menus', 'admin\MenusController');
	Route::post('/menus_update', array('uses' => 'admin\MenusController@updateList'));
	Route::get('sitemap', array('as' => 'admin..sitemap.index', 'uses' => 'admin\SitemapController@index'));
});
Route::get('sitemap.xml', function(){ return Redirect::to('sitemap_index.xml'); });
Route::get('sitemap_index.xml', function(){ return View::make('sitemap_index'); });
Route::get('post-sitemap.xml', array('as' => 'admin..sitemap.index', 'uses' => 'admin\SitemapController@index'));
// Confide routes
Route::get( 'login',                  	   'UserController@login');
Route::get( 'user/login',                  'UserController@login');
Route::post('user/login',                  array( 'as'=>'user..login.do_login', 'uses' => 'UserController@do_login'));
Route::get( 'user/confirm/{code}',         'UserController@confirm');
Route::get( 'user/forgot_password',        'UserController@forgot_password');
Route::post('user/forgot_password',        'UserController@do_forgot_password');
Route::get( 'user/reset_password/{token}', 'UserController@reset_password');
Route::post('user/reset_password',         'UserController@do_reset_password');
Route::get( 'user/logout',                 'UserController@logout');

Route::post('contact', function() {

    $fromEmail = Input::get('email');
    $fromName = Input::get('email');
    $subject = Input::get('subject');
    $data = array( 'message' => Input::get('message') );

    $toEmail = 'waycs16@gmail.com';
    $toName = 'Advance Enpower';

    Mail::send('emails.contact', $data, function($message) use ($toEmail, $toName, $fromEmail, $fromName, $subject)
    {
        $message->to($toEmail, $toName);

        $message->from($fromEmail, $fromName);

        $message->subject($subject);
    });
    
    return Redirect::back();
});
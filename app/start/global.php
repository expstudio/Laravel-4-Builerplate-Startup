<?php

/*
|--------------------------------------------------------------------------
| Register The Laravel Class Loader
|--------------------------------------------------------------------------
|
| In addition to using Composer, you may use the Laravel class loader to
| load your controllers and models. This is useful for keeping all of
| your classes in the "global" namespace without Composer updating.
|
*/

ClassLoader::addDirectories(array(

	app_path().'/commands',
	app_path().'/controllers',
	app_path().'/models',
	app_path().'/database/seeds',

));

/*
|--------------------------------------------------------------------------
| Application Error Logger
|--------------------------------------------------------------------------
|
| Here we will configure the error logger setup for the application which
| is built on top of the wonderful Monolog library. By default we will
| build a basic log file setup which creates a single file for logs.
|
*/

Log::useFiles(storage_path().'/logs/laravel.log');

/*
|--------------------------------------------------------------------------
| Application Error Handler
|--------------------------------------------------------------------------
|
| Here you may handle any errors that occur in your application, including
| logging them or displaying custom views for specific errors. You may
| even register several error handlers to handle different types of
| exceptions. If nothing is returned, the default error view is
| shown, which includes a detailed stack trace during debug.
|
*/

App::error(function(Exception $exception, $code)
{
	Log::error($exception);
});

/*
|--------------------------------------------------------------------------
| Maintenance Mode Handler
|--------------------------------------------------------------------------
|
| The "down" Artisan command gives you the ability to put an application
| into maintenance mode. Here, you will define what is displayed back
| to the user if maintenance mode is in effect for the application.
|
*/

App::down(function()
{
	return Response::make("Be right back!", 503);
});

/*
|--------------------------------------------------------------------------
| Require The Filters File
|--------------------------------------------------------------------------
|
| Next we will load the filters file for the application. This gives us
| a nice separate location to store our route and application filter
| definitions instead of putting them all in the main routes file.
|
*/

Page::saving(function($page)
{
  if(!$page->slug)
    $page->slug = Str::slug($page->title);
});

Post::saving(function($post)
{
  if(!$post->slug)
    $post->slug = Str::slug($post->title);
});

Portfolio::saving(function($portfolio)
{
  if(!$portfolio->slug)
    $portfolio->slug = Str::slug($portfolio->title);
});

Category::saving(function($category)
{
  if(!$category->slug)
    $category->slug = Str::slug($category->name_en);
});

PageTranslation::saving(function($page)
{
  if(!$page->slug)
    $page->slug = Str::slug($page->title);
});

PostTranslation::saving(function($post)
{
  if(!$post->slug)
    $post->slug = Str::slug($post->title);
});

PortfolioTranslation::saving(function($portfolio)
{
  if(!$portfolio->slug)
    $portfolio->slug = Str::slug($portfolio->title);
});

ProductTranslation::saving(function($product)
{
  if(!$product->slug)
    $product->slug = Str::slug($product->title);
});

Profile::saving(function($profile)
{
  if(!$profile->slug)
    $profile->slug = Str::slug($profile->name);
});

Tag::saving(function($tag)
{
  if(!$tag->slug)
    $tag->slug = Str::slug($tag->name);
});

Product::saving(function($post)
{
  if(!$post->slug)
    $post->slug = Str::slug($post->title);
});

require app_path().'/filters.php';

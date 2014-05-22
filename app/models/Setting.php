<?php

class Setting extends Eloquent {
	protected $guarded = array();
	protected static $setting = null;
	protected $attributes = array(
	'site_meta' => 'Laravel 4 Boilerplate Admin by expstudio.net',
	'site_keyword' => 'Laravel 4 Boilerplate Admin by expstudio.net',
	'site_title' => 'Laravel 4 Boilerplate',
	'site_name' => 'Laravel 4 Boilerplate',
	'copy_right' => 'Laravel 4 Boilerplate Admin copy right © 2014 powered by expstudio.net',
	'app_key' => '',
	'app_secret' => '',
	'page_id' => ''
	);

	public static $rules = array(
		'site_title' => 'required',
		'site_name' => 'required',
		'copy_right' => 'required'
	);

	public static function SITE_TITLE(){
		$setting = self::$setting == null ? Setting::firstOrFail() : self::$setting;
		return $setting->site_title;
	}

	public static function PAGE_ID(){
		$setting = self::$setting == null ? Setting::firstOrFail() : self::$setting;
		return $setting->page_id;
	}

	public static function APP_KEY(){
		$setting = self::$setting == null ? Setting::firstOrFail() : self::$setting;
		return $setting->app_key;
	}

	public static function APP_SECRET(){		
		$setting = self::$setting == null ? Setting::firstOrFail() : self::$setting;
		return $setting->app_secret;
	}
}

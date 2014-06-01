<?php

class Menu extends Eloquent {
    public $timestamps = false;

	protected $guarded = array();
  
	protected $attributes = array(
		'menu_id' => '0'
	);


	public static $rules = array(
		'title' => 'required',
		'title_en' => 'required',
		'path' => 'required',
	);

	public function parent(){
		return $this->belongsTo('Menu', 'menu_id');
	}

	public function subMenus(){
		return $this->hasMany('Menu', 'menu_id');
	}
}
<?php

class Tag extends Eloquent {
    public $timestamps = false;

	protected $guarded = array();
  
	protected $attributes = array(
		'count' => 0,
	);


	public static $rules = array(
		'name' => 'required'
	);
}
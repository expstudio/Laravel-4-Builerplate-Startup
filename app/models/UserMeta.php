<?php

class UserMeta extends Eloquent {

	protected $guarded = array();
  
	protected $attributes = array(
	);


	public static $rules = array(
		'meta_key' => 'required'
	);

	public function user() {
		return $this->belongsTo('User', 'user_id');
	}
}
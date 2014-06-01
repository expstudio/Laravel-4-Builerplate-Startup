<?php

class PostMeta extends Eloquent {
    public $timestamps = false;

	protected $guarded = array();
  
	protected $attributes = array(
	);


	public static $rules = array(
		'meta_key' => 'required'
	);

	public function post() {
		return $this->belongsTo('Post', 'post_id');
	}
}
<?php
use Expstudio\LaraClip\LaraClip;

class Profile extends LaraClip {

  public function __construct(array $attributes = array()) {
    $this->hasAttachedFile('cover', array(
            'styles' => array(
                          'large' => '640x480#',
                          'medium' => '300x200#',
                          'thumb' => '100x100#'
                        )
        ));

      parent::__construct($attributes);
  }
  
	protected $guarded = array();

	public static $rules = array(
		'name' => 'required',
		'title' => 'required',
		'about' => 'required',
	);

	public function user(){
		return $this->belongsTo('User', 'user_id');
	}

}

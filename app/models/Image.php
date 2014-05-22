<?php
use Expstudio\LaraClip\LaraClip;

class Image extends LaraClip {

  public function __construct(array $attributes = array()) {
    $this->hasAttachedFile('image', array(
            'styles' => array(
                          'large' => '450x450#',
                          'thumb' => '100x100#'
                        )
        ));

      parent::__construct($attributes);
  }

	protected $guarded = array();

	public static $rules = array(
    'image' => 'required',
    'caption' => 'required'
	);

}

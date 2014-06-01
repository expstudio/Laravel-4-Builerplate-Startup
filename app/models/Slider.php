<?php

class Slider extends Eloquent {
	use Codesleeve\Stapler\Stapler;

  public function __construct(array $attributes = array()) {
      $this->hasAttachedFile('image', [
          'styles' => [
            'large' => '1024x1024',
            'medium' => '400x400',
            'thumb' => '100x100'
          ]
      ]);

      parent::__construct($attributes);
  }
  
	protected $guarded = array();

	public static $rules = array(
		'title' => 'required',
		'subtitle' => 'required'
	);
}

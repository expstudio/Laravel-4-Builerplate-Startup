<?php
use Expstudio\LaraClip\LaraClip;

class ProductCategory extends LaraClip {
    public $timestamps = false;
	public function __construct(array $attributes = array()) {
		$this->hasAttachedFile('image', array(
		        'styles' => array(		                      
		                      'thumb' => '100x100#'
		                    )
		    ));

		  parent::__construct($attributes);
	}

	protected $guarded = array();
  
	protected $attributes = array(
		'name_en' => '',
		'name_th' => '',
		'product_category_id' => '0'
	);


	public static $rules = array(
		'name' => 'required'
	);

	public function posts(){
		return $this->belongsToMany('Post', 'product_categories_posts', 'product_category_id', 'post_id');
	}

	public function parent(){
		return $this->belongsTo('ProductCategory', 'product_category_id');
	}

	public function subCategories(){
		return $this->hasMany('ProductCategory', 'product_category_id');
	}
}
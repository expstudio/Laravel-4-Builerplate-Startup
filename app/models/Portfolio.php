<?php
use Expstudio\LaraClip\LaraClip;

class Portfolio extends LaraClip {

  public function __construct(array $attributes = array()) {
    $this->hasAttachedFile('cover', array(
            'styles' => array(
                          'large' => '640x480#',
                          'medium' => '300x200#',
                          'thumb' => '100x100#'
                        )
        ));

    $this->hasAttachedFile('desktop', array(
            'styles' => array(
                          'large' => '640x480#',
                          'medium' => '300x200#',
                          'thumb' => '100x100#'
                        )
        ));
    
    $this->hasAttachedFile('tablet', array(
            'styles' => array(
                          'large' => '640x480#',
                          'medium' => '300x200#',
                          'thumb' => '100x100#'
                        )
        ));
    
    $this->hasAttachedFile('mobile', array(
            'styles' => array(
                          'large' => '480x640#',
                          'medium' => '200x300#',
                          'thumb' => '100x100#'
                        )
        ));

      parent::__construct($attributes);
  }
  
  protected $attributes = array(
  );

  protected $guarded = array();

  public static $rules = array(
    'title' => 'required',
    'content' => 'required'
  );  

  public function user() {
    return $this->belongsTo('User', 'user_id');
  }

  public function translation(){
    return $this->hasMany('PortfolioTranslation', 'page_id');
  }

  public function images() {
    return $this->belongsToMany('Image', 'images_portfolios', 'image_id', 'portfolio_id');
  }
}


class PortfolioTranslation extends Eloquent {

  protected $attributes = array(
    'locale' => 'en'
  );

  protected $guarded = array();

  public static $rules = array(
    'page_id' => 'required',
    'locale' => 'required',
    'title' => 'title',
    'content' => 'content'
  );  
}
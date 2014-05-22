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
   'parent_id' => 0,
  );

  protected $guarded = array();

  public static $rules = array(
    'title' => 'required',
    'content' => 'required'
  );  

  public function slug(){

    if($this->slug)
      return $this->slug;
    else
      return $this->id;
  }

  public function user() {
    return $this->belongsTo('User', 'user_id');
  }

}

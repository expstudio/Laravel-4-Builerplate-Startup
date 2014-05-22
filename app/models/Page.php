<?php
use Expstudio\LaraClip\LaraClip;

class Page extends LaraClip {

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
  
  protected $attributes = array(
   'parent_id' => 0,
   'tags' => ''
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

  public function images() {
    return $this->belongsToMany('Image', 'images_pages', 'image_id', 'page_id');
  }

  public function parentPage() {
    return $this->belongsTo('Page', 'parent_id');
  }

  public function subPages() {
    return $this->hasMany('Page', 'parent_id');
  }

  public function user() {
    return $this->belongsTo('User', 'user_id');
  }

}

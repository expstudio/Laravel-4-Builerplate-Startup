<?php
use Expstudio\LaraClip\LaraClip;

class Post extends LaraClip {

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
    return $this->belongsToMany('Image', 'images_posts', 'image_id', 'post_id');
  }

  public function user() {
    return $this->belongsTo('User', 'user_id');
  }

  public function categories(){
    return $this->belongsToMany('Category', 'categories_posts', 'category_id', 'post_id');
  }

  public function metas(){
    return $this->hasMany('PostMeta', 'post_id');
  }
}

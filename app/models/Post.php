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

  public function images() {
    return $this->belongsToMany('Image', 'images_posts', 'image_id', 'post_id');
  }

  public function user() {
    return $this->belongsTo('User', 'user_id');
  }

  public function categories(){
    return $this->belongsToMany('Category', 'categories_posts', 'post_id', 'category_id')->withPivot('posts');
  }

  public function metas(){
    return $this->hasMany('PostMeta', 'post_id');
  }

  public function translation(){
    return $this->hasMany('PostTranslation', 'page_id');
  }
}

class PostTranslation extends Eloquent {

  protected $attributes = array(
    'locale' => 'en'
  );

  protected $guarded = array();

  public static $rules = array(
    'post_id' => 'required',
    'locale' => 'required',
    'title' => 'required',
    'content' => 'required'
  );  
}


class ProductTranslation extends Eloquent {
  protected $table = 'post_translations';
  protected $attributes = array(
    'locale' => 'en'
  );

  protected $guarded = array();

  public static $rules = array(
    'post_id' => 'required',
    'locale' => 'required',
    'title' => 'required',
    'content' => 'required'
  );  
}
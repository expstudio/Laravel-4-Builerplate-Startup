<?php

class Comment extends Eloquent {

  protected $guarded = array();
  
  protected $attributes = array(
  );


  public static $rules = array(
    'author' => 'required',
    'email' => 'required',
    'content' => 'required'
  );

  public function post() {
    return $this->belongsTo('Post', 'post_id');
  }

  public function parent(){
    return $this->belongsTo('Comment', 'comment_id');
  }

}
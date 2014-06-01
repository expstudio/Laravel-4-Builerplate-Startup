<?php

class PageTranslation extends Eloquent {

  protected $attributes = array(
     'locale' => 'en'
  );

  protected $guarded = array();

  public static $rules = array(
    'page_id' => 'required',
    'locale' => 'required',
    'title' => 'required',
    'content' => 'required'
  );  
}

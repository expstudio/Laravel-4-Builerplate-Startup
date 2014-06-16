<?php
use Expstudio\LaraClip\LaraClip;

class Product extends Post {
  protected $table = 'posts';

  public static $metas = array(
      'price' => 'Price Range',
      'code' => 'Code',
      'size' => 'Size',
      'brand' => 'Brand',
    );

  public function __construct(array $attributes = array()) {
      parent::__construct($attributes);
  }
  
  protected $attributes = array(
    'post_type' => 'product'
  );

  public function translation(){
    return $this->hasMany('ProductTranslation', 'page_id');
  }

  public function categories(){
    return $this->belongsToMany('ProductCategory', 'product_categories_posts', 'post_id', 'product_category_id')->withPivot('products');
  }

  public function code(){
    $code = $this->metas()->where('meta_key','=','code')->first();
    return $code ? $code->meta_value : '';
  }

  public function price(){
    $price = $this->metas()->where('meta_key','=','price')->first();
    return $price ? $price->meta_value : '';
  }

  public function style(){
    $style = $this->metas()->where('meta_key','=','style')->first();
    return $style ? $style->meta_value : '';
  }

  public function living_area(){
    $living_area = $this->metas()->where('meta_key','=','living_area')->first();
    return $living_area ? $living_area->meta_value : '';
  }

  public function land_area(){
    $land_area = $this->metas()->where('meta_key','=','land_area')->first();
    return $land_area ? $land_area->meta_value : '';
  }

  public function floor(){
    $floor = $this->metas()->where('meta_key','=','floor')->first();
    return $floor ? $floor->meta_value : '';
  }

  public function room(){
    $room = $this->metas()->where('meta_key','=','room')->first();
    return $room ? $room->meta_value : '';
  }

  public function room_other(){
    $room_other = $this->metas()->where('meta_key','=','room_other')->first();
    return $room_other ? $room_other->meta_value : '';
  }

  public function living_area_dimension(){
    $living_area_dimension = $this->metas()->where('meta_key','=','living_area_dimension')->first();
    return $living_area_dimension ? $living_area_dimension->meta_value : '';
  }

  public function land_area_dimension(){
    $land_area_dimension = $this->metas()->where('meta_key','=','land_area_dimension')->first();
    return $land_area_dimension ? $land_area_dimension->meta_value : '';
  }

  public function material_standard(){
    $material_standard = $this->metas()->where('meta_key','=','material_standard')->first();
    return $material_standard ? $material_standard->meta_value : '';
  }
}
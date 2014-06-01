<?php

class TagsController extends BaseController {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	public static function addTag($tags)
	{
		if($tags)
		{
			$tags_array = explode(',', $tags);
			foreach ($tags_array as $tag_str) {
				$tag_str = strtolower($tag_str);
				$tag = Tag::where('name', '=', trim($tag_str))->first();
	
				if(!$tag)
				{
					$tag = new Tag;
					$tag->name = $tag_str;
					$tag->save();
				}
			}
		}
	}

	public function show_post($tag){

	}

	public function show_product($tag){

	}

}

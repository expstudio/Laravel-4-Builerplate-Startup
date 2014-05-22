<?php

namespace Expstudio\FriendlyUrl;


interface SluggableInterface {

	public function getSlug();

	public function sluggify($force=false);

	public function resluggify();

}
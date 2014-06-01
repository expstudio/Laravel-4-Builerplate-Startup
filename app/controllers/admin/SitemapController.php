<?php
namespace admin;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Category;
use Post;
use Product;
use Page;
use Portfolio;
use DB;
use User;
use DateTime;
use Sitemap;

class SitemapController extends \BaseController {



	public function __construct(Category $category)
	{
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		// Prepare data for the lastmod tag
		$date_time = new DateTime('now');

		$categories = Category::all();
		$posts = Post::all();

		Sitemap::addLink('posts', $date_time);

		Sitemap::addCollection($posts, 'posts');

		echo Sitemap::getSitemapXml();
		exit;
	}

}

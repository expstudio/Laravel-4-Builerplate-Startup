<?php
namespace admin;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Post;
use Image;
use DB;
use User;
use Auth;
use TagsController;

class PostsController extends \BaseController {

	/**
	 * Post Repository
	 *
	 * @var Post
	 */
	protected $post;

	public function __construct(Post $post)
	{
		$this->post = $post;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$posts = Post::where('post_type', '=', 'post')->orderBy('created_at', 'DESC')->paginate(10);

		return View::make('admin.posts.index', compact('posts'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('admin..posts.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = array_except(Input::all(), array('_method', "null", "action"));
		$images = array();
		if(isset($input['images']))
		{
			$images = $input['images'];
			unset($input['images']);
		}
		
		unset($input['files']);

		$categories_id = array();
		if(isset($input['category_id']))
		{
			$categories_id = $input['category_id'];
			unset($input['category_id']);
		}
		
		$validation = Validator::make($input, Post::$rules);

		if ($validation->passes())
		{
			$input['user_id'] = Auth::user()->id;
			$post = $this->post->create($input);

			foreach ($images as $image) {
				$image = Image::create(array('caption' => '', 'image' => $image));
				$post->images()->attach($image);
			}

			foreach ($categories_id as $category_id) {
				$post->categories()->attach($category_id);
			}

			TagsController::addTag($post->tags);

			return Redirect::route('admin..posts.index');
		}

		return Redirect::route('admin..posts.create')
			->withInput()
			->withErrors($validation)
			->with('message', 'There were validation errors.');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$post = $this->post->find($id);
		$post_categories = $post->categories()->select('categories_posts.category_id')->lists('category_id');

		if (is_null($post))
		{
			return Redirect::route('admin.posts.index');
		}

		return View::make('admin.posts.edit', compact('post', 'post_categories'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$input = array_except(Input::all(), array('_method', "null", "action"));

		$images = array();
		$deleted_files = array();

		if(isset($input['images']))
		{
			$images = $input['images'];
			unset($input['images']);
		}

		if(isset($input['deleted_files']))
		{
			$deleted_files = $input['deleted_files'];
			unset($input['deleted_files']);
		}

		unset($input['files']);

		$categories_id = array();
		if(isset($input['category_id']))
		{
			$categories_id = $input['category_id'];
			unset($input['category_id']);
		}

		$validation = Validator::make($input, Post::$rules);

		if ($validation->passes())
		{
			$post = $this->post->find($id);
			$post->update($input);

			foreach ($images as $image) {
				$image = Image::create(array('caption' => '', 'image' => $image));
				$post->images()->attach($image);
			}

			foreach ($deleted_files as $file_id) {
				Image::find($file_id)->delete();
			}

			$post->categories()->detach();
			foreach ($categories_id as $category_id) {
				$post->categories()->attach($category_id);
			}

			TagsController::addTag($post->tags);
			
			return Redirect::route('admin..posts.index', $id);
		}

		return Redirect::route('admin..posts.edit', $id)
			->withInput()
			->withErrors($validation)
			->with('message', 'There were validation errors.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->post->find($id)->delete();

		return Redirect::route('admin..posts.index');
	}

}

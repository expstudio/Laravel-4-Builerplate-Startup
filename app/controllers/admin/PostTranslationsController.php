<?php
namespace admin;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Post;
use PostTranslation;
use Image;
use User;
use Auth;


class PostTranslationsController extends \BaseController {


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function set_translation($id)
	{
		$post = Post::find($id);
		$post_translation = PostTranslation::where('post_id', '=', $post->id)->where('locale', '=', 'en')->first();
		
		if($post_translation == null)
		{
			$post_translation = new PostTranslation;
			$post_translation->post_id = $post->id;
			$post_translation->locale = "en";
			$post_translation->title = $post->title;
			$post_translation->summary = $post->summary;
			$post_translation->content = $post->content;
			$post_translation->user_id = Auth::user()->id;
			$post_translation->save();
		}

		return View::make('admin.posts.translation.set', compact('post_translation', 'post'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store($id)
	{
		$input = Input::all();
		$input['post_id'] = $id;
		$input['locale'] = 'en';

		$validation = Validator::make($input, PostTranslation::$rules);
		
		if ($validation->passes())
		{
			$post = Post::find($id);
			$post_translation = PostTranslation::where('post_id', '=', $post->id)->where('locale', '=', 'en')->first();

			$post_translation->title = $input['title'];
			$post_translation->summary = $input['summary'];
			$post_translation->content = $input['content'];

			$post_translation->save();

			return Redirect::route('admin..posts.edit', $id);
		}

		return Redirect::route('admin..post_translations.set', $id)
			->withInput()
			->withErrors($validation)
			->with('message', 'There were validation errors.');
	}
}
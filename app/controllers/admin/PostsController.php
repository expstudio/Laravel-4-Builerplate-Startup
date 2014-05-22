<?php

class PostsController extends BaseController {

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
		$post = $this->post->all();

		return View::make('posts.index', compact('post'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$post = null;
		$post = Post::where('slug', '=', $id)->first();
		$post = $post ? $post : $this->post->findOrFail($id);
		return View::make('posts.show', compact('post'));
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

		if (is_null($post))
		{
			return Redirect::route('post.index');
		}

		return View::make('posts.edit', compact('post'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$input = array_except(Input::all(), '_method');
		unset($input['files']);
		$validation = Validator::make($input, Post::$rules);

		if ($validation->passes())
		{
			$post = $this->post->find($id);
			$post->update($input);

			return Redirect::route('post.show', $id);
		}

		return Redirect::route('post.edit', $id)
			->withInput()
			->withErrors($validation)
			->with('message', 'There were validation errors.');
	}
}

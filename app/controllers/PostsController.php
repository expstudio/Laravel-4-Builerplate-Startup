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
		$categories = $this->getCategories();
		$posts = $this->post->where('post_type', '=', 'post')->orderBy('id', 'desc')->paginate(10);
        return View::make('posts.index', compact('posts', 'categories'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$categories = $this->getCategories();
		$post = $this->post->where('slug', '=', $id)->first();

		$post = $post ? $post : $this->post->findOrFail($id);

		return View::make('posts.show', compact('post', 'categories'));
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index_category($id)
	{
		$categories = $this->getCategories();
		$category = Category::where('slug', '=', $id)->first();

		$category = $category ? $category : Category::findOrFail($id);
		
		$post_ids = $category->posts()->lists('post_id');
		
		$posts = Post::whereIn('id', $post_ids)->paginate(10);
    return View::make('posts.index', compact('posts', 'categories'));
	}

	public function index_tag($tags)
	{
		$categories = $this->getCategories();
		$tag = Tag::where('slug', '=', $tags)->first();
		$tag = $tag ? $tag : Tag::findOrFail($id);

		$posts = $this->post->where('tags', 'like', "%".$tag->name."%")->orderBy('id', 'desc')->paginate(10);
        return View::make('posts.index', compact('posts', 'categories'));
	}

	private function getCategories(){
		$categories = Category::with('subCategories')->where('category_id', '0')->get();

		return $categories;
	}

}

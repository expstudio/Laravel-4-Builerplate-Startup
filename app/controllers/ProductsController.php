<?php

class ProductsController extends BaseController {

	/**
	 * Product Repository
	 *
	 * @var Product
	 */
	protected $product;

	public function __construct(Product $product)
	{
		$this->product = $product;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$categories = $this->getCategories();
		$products = $this->product->where('post_type', '=', 'product')->orderBy('id', 'desc')->paginate(10);
        return View::make('products.index', compact('products'));
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
		$product = $this->product->where('slug', '=', $id)->first();

		$product = $product ? $product : $this->product->findOrFail($id);

		return View::make('products.show', compact('product', 'categories'));
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index_category($id)
	{
		$categories = $this->getCategories();
		$category = ProductCategory::where('slug', '=', $id)->first();

		$category = $category ? $category : ProductCategory::findOrFail($id);
		
		$post_ids = $category->posts()->lists('post_id');
		
		$posts = Product::whereIn('id', $post_ids)->paginate(10);
    	return View::make('products.index', compact('posts', 'categories'));
	}

	public function index_tag($tags)
	{
		$categories = $this->getCategories();
		$tag = Tag::where('slug', '=', $tags)->first();
		$tag = $tag ? $tag : Tag::findOrFail($id);

		$posts = $this->post->where('tags', 'like', "%".$tag->name."%")->orderBy('id', 'desc')->paginate(10);
        return View::make('products.index', compact('posts', 'categories'));
	}

	private function getCategories(){
		$categories = ProductCategory::with('subCategories')->where('product_category_id', '0')->get();

		return $categories;
	}

}

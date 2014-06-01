<?php
namespace admin;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Product;
use Image;
use DB;
use User;
use PostMeta;
use Auth;

class ProductsController extends \BaseController {

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
		$products = Product::where('post_type', '=', 'product')->orderBy('created_at', 'DESC')->paginate(10);

		return View::make('admin.products.index', compact('products'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('admin..products.create');
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
		if(isset($input['product_category_id']))
		{
			$categories_id = $input['product_category_id'];
			unset($input['product_category_id']);
		}

		$metas = array();
		if(isset($input['metas']))
		{
			$metas = $input['metas'];
			unset($input['metas']);
		}
		
		$validation = Validator::make($input, Product::$rules);

		if ($validation->passes())
		{
			$input['user_id'] = Auth::user()->id;
			$product = $this->product->create($input);

			foreach ($images as $image) {
				$image = Image::create(array('caption' => '', 'image' => $image));
				$product->images()->attach($image);
			}

			foreach ($categories_id as $category_id) {
				$product->categories()->attach($category_id);
			}

			foreach (Product::$metas as $key => $val) {
				$value = isset($metas[$key]) ? $metas[$key] : '';
				PostMeta::create(array('post_id' => $product->id, 'meta_key' => $key, 'meta_value' => $value ));
			}

			return Redirect::route('admin..products.index');
		}

		return Redirect::route('admin..products.create')
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
		$product = $this->product->find($id);
		$product_categories = $product->categories()->select('product_categories_posts.product_category_id')->lists('product_category_id');
		$meta_list = $product->metas()->lists('meta_value', 'meta_key');
		
		if (is_null($product))
		{
			return Redirect::route('admin.products.index');
		}

		return View::make('admin.products.edit', compact('product', 'product_categories', 'meta_list'));
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
		if(isset($input['product_category_id']))
		{
			$categories_id = $input['product_category_id'];
			unset($input['product_category_id']);
		}
		
		$metas = array();
		if(isset($input['metas']))
		{
			$metas = $input['metas'];
			unset($input['metas']);
		}

		$validation = Validator::make($input, Product::$rules);
		if ($validation->passes())
		{
			$product = $this->product->find($id);
			$product->update($input);
			
			foreach ($images as $image) {
				$image = Image::create(array('caption' => '', 'image' => $image));
				$product->images()->attach($image);
			}

			foreach ($deleted_files as $file_id) {
				Image::find($file_id)->delete();
			}

			$product->categories()->detach();
			foreach ($categories_id as $category_id) {
				$product->categories()->attach($category_id);
			}

			foreach (Product::$metas as $key => $val) {
				$value = isset($metas[$key]) ? $metas[$key] : '';
				$meta = PostMeta::where('post_id', '=', $product->id)->where('meta_key', '=', $key)->first();
				$meta->meta_value = $value;
				$meta->save();
			}
			
			return Redirect::route('admin..products.index', $id);
		}

		return Redirect::route('admin..products.edit', $id)
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
		$this->product->find($id)->delete();

		return Redirect::route('admin..products.index');
	}

}

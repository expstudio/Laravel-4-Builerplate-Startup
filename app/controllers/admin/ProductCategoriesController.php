<?php
namespace admin;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use ProductCategory;
use DB;
use User;

class ProductCategoriesController extends \BaseController {

	/**
	 * ProductCategory Repository
	 *
	 * @var ProductCategory
	 */
	protected $product_category;

	public function __construct(ProductCategory $product_category)
	{
		$this->product_category = $product_category;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$product_categories = ProductCategory::with('subCategories')->where('product_category_id', '0')->get();

		return View::make('admin.product_categories.index', compact('product_categories'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$product_categories = ProductCategory::with('subCategories')->where('product_category_id', '0')->get();

		return View::make('admin.product_categories.index', compact('product_categories'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		
		$input['name'] = $input['name_th'].' - '.$input['name_en'];

		$validation = Validator::make($input, ProductCategory::$rules);

		if ($validation->passes())
		{
			$product_category = $this->product_category->create($input);

			return Redirect::route('admin..product_categories.index');
		}

		return Redirect::route('admin..product_categories.index')
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
		$product_category = $this->product_category->find($id);
		$product_categories = ProductCategory::with('subCategories')->where('product_category_id', '0')->get();

		if (is_null($product_category))
		{
			return Redirect::route('admin.product_categories.index');
		}

		return View::make('admin.product_categories.index', compact('product_category', 'product_categories'));
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

		$input['name'] = $input['name_th'].' - '.$input['name_en'];

		$validation = Validator::make($input, ProductCategory::$rules);

		if ($validation->passes())
		{
			$product_category = $this->product_category->find($id);
			$product_category->update($input);
			
			return Redirect::route('admin..product_categories.index', $id);
		}

		return Redirect::route('admin..product_categories.index', $id)
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
		$this->product_category->find($id)->delete();

		return Redirect::route('admin..product_categories.index');
	}

}

<?php
namespace admin;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Category;
use DB;
use User;

class CategoriesController extends \BaseController {

	/**
	 * Category Repository
	 *
	 * @var Category
	 */
	protected $category;

	public function __construct(Category $category)
	{
		$this->category = $category;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$categories = Category::with('subCategories')->where('category_id', '0')->get();

		return View::make('admin.categories.index', compact('categories'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$categories = Category::with('subCategories')->where('category_id', '0')->get();

		return View::make('admin.categories.index', compact('categories'));
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

		$validation = Validator::make($input, Category::$rules);

		if ($validation->passes())
		{
			$category = $this->category->create($input);

			return Redirect::route('admin..categories.index');
		}

		return Redirect::route('admin..categories.index')
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
		$category = $this->category->find($id);
		$categories = Category::with('subCategories')->where('category_id', '0')->get();

		if (is_null($category))
		{
			return Redirect::route('admin.categories.index');
		}

		return View::make('admin.categories.index', compact('category', 'categories'));
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

		$validation = Validator::make($input, Category::$rules);

		if ($validation->passes())
		{
			$category = $this->category->find($id);
			$category->update($input);
			
			return Redirect::route('admin..categories.index', $id);
		}

		return Redirect::route('admin..categories.index', $id)
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
		$this->category->find($id)->delete();

		return Redirect::route('admin..categories.index');
	}

}

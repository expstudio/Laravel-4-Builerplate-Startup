<?php
namespace admin;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Product;
use ProductTranslation;
use Image;
use User;
use Auth;


class ProductTranslationsController extends \BaseController {


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function set_translation($id)
	{
		$product = Product::find($id);
		$product_translation = ProductTranslation::where('post_id', '=', $product->id)->where('locale', '=', 'en')->first();
		
		if($product_translation == null)
		{
			$product_translation = new ProductTranslation;
			$product_translation->post_id = $product->id;
			$product_translation->locale = "en";
			$product_translation->title = $product->title;
			$product_translation->summary = $product->summary;
			$product_translation->content = $product->content;
			$product_translation->user_id = Auth::user()->id;
			$product_translation->save();
		}

		return View::make('admin.products.translation.set', compact('product_translation', 'product'));
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

		$validation = Validator::make($input, ProductTranslation::$rules);
		
		if ($validation->passes())
		{
			$product = Product::find($id);
			$product_translation = ProductTranslation::where('post_id', '=', $product->id)->where('locale', '=', 'en')->first();

			$product_translation->title = $input['title'];
			$product_translation->summary = $input['summary'];
			$product_translation->content = $input['content'];

			$product_translation->save();

			return Redirect::route('admin..products.edit', $id);
		}

		return Redirect::route('admin..product_translations.set', $id)
			->withInput()
			->withErrors($validation)
			->with('message', 'There were validation errors.');
	}
}
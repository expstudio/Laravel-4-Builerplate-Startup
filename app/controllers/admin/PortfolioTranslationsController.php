<?php
namespace admin;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Portfolio;
use PortfolioTranslation;
use Image;
use User;
use Auth;


class PortfolioTranslationsController extends \BaseController {


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function set_translation($id)
	{
		$portfolio = Portfolio::find($id);
		$portfolio_translation = PortfolioTranslation::where('portfolio_id', '=', $portfolio->id)->where('locale', '=', 'en')->first();
		
		if($portfolio_translation == null)
		{
			$portfolio_translation = new PortfolioTranslation;
			$portfolio_translation->portfolio_id = $portfolio->id;
			$portfolio_translation->locale = "en";
			$portfolio_translation->title = $portfolio->title;
			$portfolio_translation->customer = $portfolio->customer;
			$portfolio_translation->content = $portfolio->content;
			$portfolio_translation->user_id = Auth::user()->id;
			$portfolio_translation->save();
		}

		return View::make('admin.portfolios.translation.set', compact('portfolio_translation', 'portfolio'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store($id)
	{
		$input = Input::all();
		$input['portfolio_id'] = $id;
		$input['locale'] = 'en';

		$validation = Validator::make($input, PortfolioTranslation::$rules);
		
		if ($validation->passes())
		{
			$portfolio = Portfolio::find($id);
			$portfolio_translation = PortfolioTranslation::where('portfolio_id', '=', $portfolio->id)->where('locale', '=', 'en')->first();

			$portfolio_translation->title = $input['title'];
			$portfolio_translation->customer = $input['customer'];
			$portfolio_translation->content = $input['content'];

			$portfolio_translation->save();

			return Redirect::route('admin..portfolios.edit', $id);
		}

		return Redirect::route('admin..portfolio_translations.set', $id)
			->withInput()
			->withErrors($validation)
			->with('message', 'There were validation errors.');
	}
}
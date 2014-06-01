<?php
namespace admin;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Page;
use PageTranslation;
use Image;
use User;
use Auth;


class PageTranslationsController extends \BaseController {


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function set_translation($id)
	{
		$page = Page::find($id);
		$page_translation = PageTranslation::where('page_id', '=', $page->id)->where('locale', '=', 'en')->first();
		
		if($page_translation == null)
		{
			$page_translation = new PageTranslation;
			$page_translation->page_id = $page->id;
			$page_translation->locale = "en";
			$page_translation->title = $page->title;
			$page_translation->content = $page->content;
			$page_translation->user_id = Auth::user()->id;
			$page_translation->save();
		}

		return View::make('admin.pages.translation.set', compact('page_translation', 'page'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store($id)
	{
		$input = Input::all();
		$input['page_id'] = $id;
		$input['locale'] = 'en';

		$validation = Validator::make($input, PageTranslation::$rules);
		
		if ($validation->passes())
		{
			$page = Page::find($id);
			$page_translation = PageTranslation::where('page_id', '=', $page->id)->where('locale', '=', 'en')->first();

			$page_translation->title = $input['title'];
			$page_translation->content = $input['content'];

			$page_translation->save();

			return Redirect::route('admin..pages.edit', 'page');
		}

		return Redirect::route('admin..page_translations.set', $id)
			->withInput()
			->withErrors($validation)
			->with('message', 'There were validation errors.');
	}
}
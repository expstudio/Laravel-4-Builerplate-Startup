<?php
namespace admin;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Page;
use Image;
use User;
use Auth;

class PagesController extends \BaseController {

	/**
	 * Page Repository
	 *
	 * @var Page
	 */
	protected $page;

	public function __construct(Page $page)
	{
		$this->page = $page;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$pages = Page::with('subPages')->where('parent_id', '=', '0')->orWhere('parent_id', '=', '')->get();

		return View::make('admin.pages.index', compact('pages'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('admin.pages.create');
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
		$validation = Validator::make($input, Page::$rules);

		if ($validation->passes())
		{
			$input['user_id'] = Auth::user()->id;
			$page = $this->page->create($input);

			foreach ($images as $image) {
				
					$image = Image::create(array('caption' => '', 'image' => $image));
					$page->images()->attach($image);
			}

			return Redirect::route('admin..pages.index');
		}

		return Redirect::route('admin..pages.create')
			->withInput()
			->withErrors($validation)
			->with('message', 'There were validation errors.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$page = $this->page->findOrFail($id);

		return View::make('admin.pages.show', compact('page'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$page = $this->page->find($id);

		if (is_null($page))
		{
			return Redirect::route('admin..pages.index');
		}

		return View::make('admin.pages.edit', compact('page'));
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
		$validation = Validator::make($input, Page::$rules);

		if ($validation->passes())
		{
			$page = $this->page->find($id);
			$page->update($input);		

			foreach ($images as $image) {	
				$image = Image::create(array('caption' => '', 'image' => $image));
				$page->images()->attach($image);
			}

			foreach ($deleted_files as $file_id) {
				Image::find($file_id)->delete();
			}

			return Redirect::route('admin..pages.index', $id);
		}

		return Redirect::route('admin..pages.edit', $id)
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
		$this->page->find($id)->delete();

		return Redirect::route('admin..pages.index');
	}

}
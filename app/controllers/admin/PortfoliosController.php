<?php
namespace admin;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Portfolio;
use Image;
use DB;
use User;
use Auth;

class PortfoliosController extends \BaseController {

	/**
	 * Portfolio Repository
	 *
	 * @var Portfolio
	 */
	protected $portfolio;

	public function __construct(Portfolio $portfolio)
	{
		$this->portfolio = $portfolio;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$portfolios = Portfolio::orderBy('created_at', 'DESC')->paginate(10);

		return View::make('admin.portfolios.index', compact('portfolios'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('admin..portfolios.create');
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
		unset($input['null']);
		$validation = Validator::make($input, Portfolio::$rules);

		if ($validation->passes())
		{
			$input['user_id'] = Auth::user()->id;
			$portfolio = $this->portfolio->create($input);

			foreach ($images as $image) {
				$image = Image::create(array('caption' => '', 'image' => $image));
				$portfolio->images()->attach($image);
			}

			return Redirect::route('admin..portfolios.index');
		}

		return Redirect::route('admin..portfolios.create')
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
		$portfolio = $this->portfolio->find($id);

		if (is_null($portfolio))
		{
			return Redirect::route('admin.portfolios.index');
		}

		return View::make('admin.portfolios.edit', compact('portfolio'));
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

		$validation = Validator::make($input, Portfolio::$rules);

		if ($validation->passes())
		{
			$portfolio = $this->portfolio->find($id);
			$portfolio->update($input);

			foreach ($images as $image) {
				$image = Image::create(array('caption' => '', 'image' => $image));
				$portfolio->images()->attach($image);
			}

			foreach ($deleted_files as $file_id) {
				Image::find($file_id)->delete();
			}
			
			return Redirect::route('admin..portfolios.index', $id);
		}

		return Redirect::route('admin..portfolios.edit', $id)
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
		$this->portfolio->find($id)->delete();

		return Redirect::route('admin..portfolios.index');
	}

}

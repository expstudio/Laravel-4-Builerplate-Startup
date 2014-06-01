<?php
namespace admin;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use News;
use ImageNews;

class NewsController extends \BaseController {

	/**
	 * News Repository
	 *
	 * @var News
	 */
	protected $news;

	public function __construct(News $news)
	{
		$this->news = $news;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$news = News::orderBy('created_at', 'DESC')->paginate(10);

		return View::make('admin.news.index', compact('news'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('admin..news.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$images = [];
		if(isset($input['images']))
		{
			$images = $input['images'];
			unset($input['images']);
		}
		
		unset($input['files']);

		$validation = Validator::make($input, News::$rules);

		if ($validation->passes())
		{
			$new = $this->news->create($input);

			foreach ($images as $image) {
				ImageNews::create(array('news_id' => $new->id, 'image' => $image));
			}

			return Redirect::route('admin..news.index');
		}

		return Redirect::route('admin..news.create')
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
		$news = $this->news->find($id);

		if (is_null($news))
		{
			return Redirect::route('admin.news.index');
		}

		return View::make('admin.news.edit', compact('news'));
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
		$images = [];
		$deleted_files = [];

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
		$validation = Validator::make($input, News::$rules);

		if ($validation->passes())
		{
			$news = $this->news->find($id);
			$news->update($input);

			foreach ($images as $image) {
				ImageNews::create(array('news_id' => $news->id, 'image' => $image));
			}

			foreach ($deleted_files as $file_id) {
				ImageNews::find($file_id)->delete();
			}
			
			return Redirect::route('admin..news.index', $id);
		}

		return Redirect::route('admin..news.edit', $id)
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
		$this->news->find($id)->delete();

		return Redirect::route('admin..news.index');
	}

}

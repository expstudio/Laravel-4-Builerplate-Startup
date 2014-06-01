<?php
namespace admin;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Slider;

class SlidersController extends \BaseController {

	/**
	 * Slider Repository
	 *
	 * @var Slider
	 */
	protected $slider;

	public function __construct(Slider $slider)
	{
		$this->slider = $slider;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$sliders = $this->slider->all();

		return View::make('admin.sliders.index', compact('sliders'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('admin.sliders.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, Slider::$rules);

		if ($validation->passes())
		{
			$this->slider->create($input);

			return Redirect::route('admin..sliders.index');
		}

		return Redirect::route('admin..sliders.create')
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
		$slider = $this->slider->findOrFail($id);

		return View::make('admin.sliders.show', compact('slider'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$slider = $this->slider->find($id);

		if (is_null($slider))
		{
			return Redirect::route('admin..sliders.index');
		}

		return View::make('admin.sliders.edit', compact('slider'));
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
		$validation = Validator::make($input, Slider::$rules);

		if ($validation->passes())
		{
			$slider = $this->slider->find($id);
			$slider->update($input);

			return Redirect::route('admin..sliders.show', $id);
		}

		return Redirect::route('admin..sliders.edit', $id)
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
		$this->slider->find($id)->delete();

		return Redirect::route('admin..sliders.index');
	}

}

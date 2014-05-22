<?php
namespace admin;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Setting;

class SettingsController extends \BaseController {

	/**
	 * Setting Repository
	 *
	 * @var Setting
	 */
	protected $setting;

	public function __construct(Setting $setting)
	{
		$this->setting = $setting;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$setting = Setting::first();
		$setting = $setting ? $setting : new Setting;
		$setting->save();
		return View::make('admin.settings.edit', compact('setting'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$setting = $this->setting->first();

		return View::make('admin.settings.edit', compact('setting'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$setting = $this->setting->find($id);

		if (is_null($setting))
		{
			return Redirect::route('admin..settings.index');
		}

		return View::make('admin.settings.edit', compact('setting'));
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
		$validation = Validator::make($input, Setting::$rules);

		if ($validation->passes())
		{
			$setting = $this->setting->find($id);
			$setting->update($input);

			return Redirect::route('admin..settings.index');
		}

		return Redirect::route('admin..settings.edit', $id)
			->withInput()
			->withErrors($validation)
			->with('message', 'There were validation errors.');
	}

}

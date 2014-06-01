<?php
namespace admin;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Profile;
use DB;
use User;

class ProfilesController extends \BaseController {

	/**
	 * Profile Repository
	 *
	 * @var Profile
	 */
	protected $profile;

	public function __construct(Profile $profile)
	{
		$this->profile = $profile;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$profiles = Profile::with('subCategories')->where('profile_id', '0')->get();

		return View::make('admin.profiles.index', compact('profiles'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$profiles = Profile::with('subCategories')->where('profile_id', '0')->get();

		return View::make('admin.profiles.index', compact('profiles'));
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

		$validation = Validator::make($input, Profile::$rules);

		if ($validation->passes())
		{
			$profile = $this->profile->create($input);

			return Redirect::route('admin..profiles.index');
		}

		return Redirect::route('admin..profiles.index')
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
		$profile = $this->profile->find($id);
		$profiles = Profile::with('subCategories')->where('profile_id', '0')->get();

		if (is_null($profile))
		{
			return Redirect::route('admin.profiles.index');
		}

		return View::make('admin.profiles.index', compact('profile', 'profiles'));
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

		$validation = Validator::make($input, Profile::$rules);

		if ($validation->passes())
		{
			$profile = $this->profile->find($id);
			$profile->update($input);
			
			return Redirect::route('admin..profiles.index', $id);
		}

		return Redirect::route('admin..profiles.index', $id)
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
		$this->profile->find($id)->delete();

		return Redirect::route('admin..profiles.index');
	}

}

<?php
namespace admin;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Menu;
use DB;
use User;
use Auth;

class MenusController extends \BaseController {

	/**
	 * Menu Repository
	 *
	 * @var Menu
	 */
	protected $menu;

	public function __construct(Menu $menu)
	{
		$this->menu = $menu;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$menus = Menu::with('subMenus')->where('menu_id', '0')->orderBy('ordering', 'asc')->get();

		return View::make('admin.menus.index', compact('menus'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$menus = Menu::with('subMenus')->where('menu_id', '0')->get();

		return View::make('admin.menus.index', compact('menus'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		
		$validation = Validator::make($input, Menu::$rules);

		if ($validation->passes())
		{
			$input['user_id'] = Auth::user()->id;
			$menu = $this->menu->create($input);

			return Redirect::route('admin..menus.index');
		}

		return Redirect::route('admin..menus.index')
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
		$menu = $this->menu->find($id);
		$menus = Menu::with('subMenus')->where('menu_id', '0')->get();

		if (is_null($menu))
		{
			return Redirect::route('admin.menus.index');
		}

		return View::make('admin.menus.index', compact('menu', 'menus'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$input = Input::all();		

		$validation = Validator::make($input, Menu::$rules);

		if ($validation->passes())
		{
			$input['user_id'] = Auth::user()->id;
			$menu = $this->menu->find($id);
			$menu->update($input);
			
			return Redirect::route('admin..menus.index', $id);
		}

		return Redirect::route('admin..menus.index', $id)
			->withInput()
			->withErrors($validation)
			->with('message', 'There were validation errors.');
	}

	public function updateList()
	{
		$input = array_except(Input::all(), '_method');
		foreach ($input['menus'] as $item) {
			$menu = Menu::find($item['id']);
			if($menu)
			{
				$menu->ordering = $item['index']; 
				$menu->save();
			}
		}

		return url(action('admin\MenusController@index'));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->menu->find($id)->delete();

		return Redirect::route('admin..menus.index');
	}

}

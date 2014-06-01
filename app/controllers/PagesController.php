<?php

class PagesController extends BaseController {

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
		$pages = $this->page->orderBy('id', 'desc')->paginate(20);
        return View::make('pages.index', compact('pages'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$page = $this->page->where('slug', '=', $id)->first();

		$page = $page ? $page : $this->page->findOrFail($id);

		return View::make('pages.show', compact('page'));
	}

}

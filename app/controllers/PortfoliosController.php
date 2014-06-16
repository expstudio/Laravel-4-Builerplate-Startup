<?php

class PortfoliosController extends BaseController {

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
		$portfolios = $this->portfolio->orderBy('id', 'desc')->paginate(10);
    	return View::make('portfolios.index', compact('portfolios'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$portfolio = $this->portfolio->where('slug', '=', $id)->first();

		$portfolio = $portfolio ? $portfolio : $this->portfolio->findOrFail($id);

		return View::make('portfolios.show', compact('portfolio'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show_box($id)
	{
		$portfolio = $this->portfolio->where('slug', '=', $id)->first();

		$portfolio = $portfolio ? $portfolio : $this->portfolio->findOrFail($id);

		return View::make('portfolios.show_box', compact('portfolio'));
	}

}

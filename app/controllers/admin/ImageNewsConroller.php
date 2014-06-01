<?php
namespace admin;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use News;
use ImageNews;

class ImageNewsController extends \BaseController {

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($news_id, $name)
	{
		$this->news->where('news_id', $news_id)->where('image_fil_name', $name)->delete();

		return Redirect::route('admin..news.index');
	}

}

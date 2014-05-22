<?php namespace Expstudio\LaraClip\Services;

use Expstudio\LaraClip\File\UploadedFile;
use Expstudio\LaraClip\IOWrapper;
use Expstudio\LaraClip\Exceptions\InvalidClassException;
use App;

class ImageRefreshService
{
	/**
	 * Attempt to refresh the defined attachments on a particular model.
	 *
	 * @param  string $class
	 * @param  array $attachments
	 * @return void 
	 */
	public function refresh($class, $attachments)
	{
		if (!method_exists($class, 'hasAttachedFile')) {
			throw new InvalidClassException("Invalid class: the $class class is not currently using LaraClip.", 1);
		}

		$models = App::make($class)->all();

		if ($attachments) 
		{
			$attachments = explode(',', str_replace(', ', ',', $attachments));
			$this->processSomeAttachments($models, $attachments);

			return;
		}
		
		$this->processAllAttachments($models);
	}

	/**
	 * Process a only a specified subset of laraclip attachments.
	 * 
	 * @param  array $attachments 
	 * @return void              
	 */
	protected  function processSomeAttachments($models, $attachments)
	{
		foreach ($models as $model) 
		{
			foreach ($model->getAttachedFiles() as $attachedFile) 
			{
				if (in_array($attachedFile->name, $attachments)) {
					$attachedFile->reprocess();
				}
			}
		}
	}

	/**
	 * Process all laraclip attachments defined on a class.
	 * 
	 * @return void
	 */
	protected function processAllAttachments($models)
	{
		foreach ($models as $model) 
		{
			foreach ($model->getAttachedFiles() as $attachedFile) 
			{
				$attachedFile->reprocess();
			}
		}
	}
}
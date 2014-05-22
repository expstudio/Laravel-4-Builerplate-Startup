<?php namespace Expstudio\LaraClip;

use Illuminate\Database\Eloquent\Model;
use Event, Config, App;

/**
 * Attachment uploader package using Eloquent in Laravel 4 with PHP5.3.x support downgrade from codesleeve/stapler
 * 
 * Credits to the guys at CodeSleeve for creating the
 * Laravel version of paperclip plugin (rails)
 * https://github.com/CodeSleeve/stapler
 * 
 * 
 * @package waycs16/laraclip
 * @version v0.1.0-Beta4
 * @author Watee Wichiennit <waycs16@gmail.com>
 * @link 	
 */

class LaraClip extends Model
{
	/**
	 * All of the model's current file attachments.
	 *
	 * @var array
	 */
	protected $attachedFiles = array();

	/**
	 * Accessor method for the $attachedFiles property.
	 * 
	 * @return array
	 */
	public function getAttachedFiles()
	{
		return $this->attachedFiles;
	}

	/**
	 * Add a new file attachment type to the list of available attachments.
	 * This function acts as a quasi constructor for this trait.
	 *
	 * @param string $name
	 * @param array $options
	 * @return void
	*/
	public function hasAttachedFile($name, $options = array())
	{
		// Register the attachment with laraclip and setup event listeners.
		$this->registerAttachment($name, $options);
	}

	/**
	 * The "booting" method of the model.
	 *
	 * @return void
	 */
	public static function boot() 
	{
		parent::boot();

		static::bootLaraclip();
	}

	/**
	 * Register eloquent event handlers.
     * We'll spin through each of the attached files defined on this class
     * and register callbacks for the events we need to observe in order to 
     * handle file uploads.
     * 
	 * @return void
	 */
	public static function bootLaraclip()
	{
		static::saved(function($instance) {
			foreach($instance->attachedFiles as $attachedFile) {
				$attachedFile->afterSave($instance);
			}
		});

		static::deleting(function($instance) {
			foreach($instance->attachedFiles as $attachedFile) {
				$attachedFile->beforeDelete($instance);
			}
		});

		static::deleted(function($instance) {
			foreach($instance->attachedFiles as $attachedFile) {
				$attachedFile->afterDelete($instance);
			}
		});
	}

	/**
     * Handle the dynamic retrieval of attachment objects.
     *
     * @param  string $key
     * @return mixed
     */
	public function getAttribute($key)
	{
		if (array_key_exists($key, $this->attachedFiles))
		{
		    return $this->attachedFiles[$key];
		}

		return parent::getAttribute($key);
    }

	/**
     * Handle the dynamic setting of attachment objects.
     *
     * @param  string $key
     * @param  mixed $value
     * @return void
     */
	public function setAttribute($key, $value)
	{
		if (array_key_exists($key, $this->attachedFiles)) 
		{
			if ($value)
			{
				$attachedFile = $this->attachedFiles[$key];
				$attachedFile->setUploadedFile($value);
			}

			return;
		}
		
		parent::setAttribute($key, $value);
	}

	/**
	 * Register an attachment type.
	 * and add the attachment to the list of attachments to be processed during saving.
	 *
	 * @param  string $name
	 * @param  array $options
	 * @return mixed
	 */
	protected function registerAttachment($name, $options)
	{
		$options = $this->mergeOptions($options);
		App::make('AttachmentValidator')->validateOptions($options);
		
		$attachment = App::make('Attachment', array('name' => $name, 'options' => $options));
		$attachment->setInstance($this);
		$this->attachedFiles[$name] = $attachment;
	}

	/**
	 * Merge configuration options.
	 * Here we'll merge user defined options with the laraclip defaults in a cascading manner.
	 * We start with overall laraclip options.  Next we merge in storage driver specific options.
	 * Finally we'll merge in attachment specific options on top of that.
	 *
	 * @param  array $options
	 * @return array
	 */
	protected function mergeOptions($options)
	{
		$defaultOptions = Config::get('laraclip::laraclip');
		$options = array_merge($defaultOptions, (array) $options);
		$storage = $options['storage'];
		$options = array_merge(Config::get("laraclip::{$storage}"), $options);
		$options['styles'] = array_merge( (array) $options['styles'], array('original' => ''));

		return $options;
	}

}

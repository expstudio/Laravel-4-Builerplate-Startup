<?php

return array(
	
	/*
	|--------------------------------------------------------------------------
	| LaraClip Public Path Location
	|--------------------------------------------------------------------------
	|
	| The location of the web application's document root.  Defaults to Laravel's
	| public folder.
	|
	*/
	
	'public_path' => realPath(public_path()),

	/*
	|--------------------------------------------------------------------------
	| LaraClip Storage Driver
	|--------------------------------------------------------------------------
	|
	| The default mechanism for handling file storage.  Currently LaraClip supports
	| both file system and Amazon S3 as options.
	|
	*/
	
	'storage' => 'filesystem',

	/*
	|--------------------------------------------------------------------------
	| LaraClip Image Processing Library
	|--------------------------------------------------------------------------
	|
	| The default library used for image processing.  Can be one GD, Imagick, or
	| Gmagick.
	|
	*/
	
	'image_processing_library' => 'GD',


	/*
	|--------------------------------------------------------------------------
	| LaraClip Default Url
	|--------------------------------------------------------------------------
	|
	| The url (relative to your project document root) containing a default image
	| that will be used for attachments that don't currently have an uploaded image
	| attached to them.
	|
	*/

	'default_url' => '/:attachment/:style/missing.png',

	/*
	|--------------------------------------------------------------------------
	| LaraClip Default Style
	|--------------------------------------------------------------------------
	|
	| The default style returned from the LaraClip file location helper methods. 
	| An unaltered version of uploaded file is always stored within the 'original' 
	| style, however the default_style can be set to point to any of the defined 
	| syles within the styles array.
	|
	*/

	'default_style' => 'original',

	/*
	|--------------------------------------------------------------------------
	| LaraClip Styles
	|--------------------------------------------------------------------------
	|
	| An array of image sizes defined for the file attachment. 
	| LaraClip will attempt to format the file upload into the defined style.
	|
	*/

	'styles' => array(),

	/*
	|--------------------------------------------------------------------------
	| Keep Old Files Flag
	|--------------------------------------------------------------------------
	|
	| Set this to true in order to prevent older file uploads from being deleted
	| from storage when a record is updated with a new upload.
	|
	*/

	'keep_old_files' => false,

	/*
	|--------------------------------------------------------------------------
	| Preserve Files Flag
	|--------------------------------------------------------------------------
	|
	| Set this to true in order to prevent file uploads from being deleted
	| from the file system when an attachment is destroyed.  Essentially this 
	| ensures the preservation of uploads event after their corresponding database
	| records have been removed.
	|
	*/
	'preserve_files' => false

);
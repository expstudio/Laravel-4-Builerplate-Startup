<?php namespace Expstudio\LaraClip;

use Illuminate\Support\ServiceProvider;
use Expstudio\LaraClip\File\UploadedFile;
use Expstudio\LaraClip\File\Image\Resizer;

class LaraClipServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Holds the hash value for the current LARACLIP_NULL constant.
	 * 
	 * @var string
	 */
	protected $laraclipNull;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('expstudio/laraclip');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->laraclipNull = sha1(time());

		if (!defined('LARACLIP_NULL')) {
			define('LARACLIP_NULL', $this->laraclipNull);
		}
		
		$this->registerResizer();
		$this->registerIOWrapper();
		$this->registerConfig();
		$this->registerValidator();
		$this->registerInterpolator();
		$this->registerGD();
		$this->registerImagick();
		$this->registerGmagick();
		$this->registerFilesystemStorage();
		$this->registerS3Storage();
		$this->registerS3ClientManager();
		$this->registerAttachment();
		
		// commands
		$this->registerLaraClipFastenCommand();
		$this->registerLaraClipRefreshCommand();
		
		// services
		$this->registerImageRefreshService();

		$this->commands('laraclip.fasten');
		$this->commands('laraclip.refresh');
	}

	/**
	 * Register Expstudio\LaraClip\File\Image\Resizer with the container.
	 * 
	 * @return void
	 */
	protected function registerResizer()
	{
		$this->app->bind('Resizer', function($app, $params)
        {
        	return new Resizer($params['imageProcessor']);
        });
	}

	/**
	 * Register Expstudio\LaraClip\IOWrapper with the container.
	 * 
	 * @return void
	 */
	protected function registerIOWrapper()
	{
		$this->app->singleton('IOWrapper', function($app, $params)
        {
        	return new IOWrapper();
        });
	}

	/**
	 * Register Expstudio\LaraClip\Config with the container.
	 * 
	 * @return void
	 */
	protected function registerConfig()
	{
		$this->app->bind('Config', function($app, $params)
        {
        	return new Config($params['name'], $params['options']);
        });
	}

	/**
	 * Register Expstudio\LaraClip\Attachment with the container.
	 * 
	 * @return void
	 */
	protected function registerAttachment()
	{
		$this->app->bind('Attachment', function($app, $params)
        {
			$config = $app->make('Config', array('name' => $params['name'], 'options' => $params['options']));
			$interpolator = $app->make('Interpolator');
			$imageProcessor = $app->make($params['options']['image_processing_library']);
			$resizer = $app->make('Resizer', array('imageProcessor' => $imageProcessor));
			$IOWrapper = $app->make('IOWrapper');

            $attachment = new Attachment($config, $interpolator, $resizer, $IOWrapper);
            
            $storageDriver = $app->make($params['options']['storage'], array('attachment' => $attachment));
            $attachment->setStorageDriver($storageDriver);

            return $attachment;
        });
	}

	/**
	 * Register Expstudio\LaraClip\Validator with the container.
	 * 
	 * @return void
	 */
	protected function registerValidator()
	{
		$this->app->singleton('AttachmentValidator', function($app)
        {
            return new Validator();
        });
	}

	/**
	 * Register Expstudio\LaraClip\Interpolator with the container.
	 * 
	 * @return void
	 */
	protected function registerInterpolator()
	{
		$this->app->singleton('Interpolator', function($app)
        {
            return new Interpolator($app['Str']);
        });
	}

	/**
	 * Register Imagine\Gd\Imagine with the container.
	 * 
	 * @return void
	 */
	public function registerGD()
	{
		$this->app->singleton('GD', function($app)
        {
            return new \Imagine\Gd\Imagine();
        });
	}

	/**
	 * Register Imagine\Imagick\Imagine with the container.
	 * 
	 * @return void
	 */
	public function registerImagick()
	{
		$this->app->singleton('Imagick', function($app)
        {
            return new \Imagine\Imagick\Imagine();
        });
	}

	/**
	 * Register Imagine\Gmagick\Imagine with the container.
	 * 
	 * @return void
	 */	
	public function registerGmagick()
	{
		$this->app->singleton('Gmagick', function($app)
        {
            return new \Imagine\Gmagick\Imagine();
        });
	}

	/**
	 * Register Storage\Filesystem with the contaioner.
	 * 
	 * @return void
	 */
	protected function registerFilesystemStorage()
	{
		$this->app->bind('filesystem', function($app, $params)
        {
            return new Storage\Filesystem($params['attachment']);
        });
	}

	/**
	 * Register Storage\S3 with the contaioner.
	 * 
	 * @return void
	 */
	protected function registerS3Storage()
	{
		$this->app->bind('s3', function($app, $params)
        {
            $s3ClientManager = $app->make('S3ClientManager');

            return new Storage\S3($params['attachment'], $s3ClientManager);
        });
	}

	/**
	 * Register Expstudio\LaraClip\Storage\S3ClientManager with the container.
	 * 
	 * @return void
	 */
	protected function registerS3ClientManager()
	{
		$this->app->bind('S3ClientManager', function($app, $params)
        {
            return Storage\S3ClientManager::getInstance();
        });
	}

	/**
	 * Register the laraclip fasten command with the container.
	 * 
	 * @return void
	 */
	protected function registerLaraClipFastenCommand()
	{
		$this->app->bind('laraclip.fasten', function($app) 
		{
			return new Commands\FastenCommand;
		});
	}

	/**
	 * Register the laraclip refresh command with the container.
	 * 
	 * @return void
	 */
	protected function registerLaraClipRefreshCommand()
	{
		$this->app->bind('laraclip.refresh', function($app) 
		{
			$refreshService = $app['ImageRefreshService'];
			
			return new Commands\RefreshCommand($refreshService);
		});
	}

	/**
     * Register the image refresh service with the container.
     * 
     * @return void 
     */
    protected function registerImageRefreshService()
    {
        $this->app->singleton('ImageRefreshService', function($app, $params) {
            return new Services\ImageRefreshService();
        });
    }

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}

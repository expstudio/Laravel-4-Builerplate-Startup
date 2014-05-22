<?php

use Mockery as m;

class UploadedFileTest extends TestCase
{
	/**
	 * Setup method.
	 * 
	 * @return void 
	 */
	public function setUp()
	{
		# code...
	}

	/**
	 * Teardown method.
	 * 
	 * @return void 
	 */
	public function tearDown()
	{
		m::close();
	}

	/**
	 * Test that the validate method is working correctly when
	 * a valid file upload object is passed in.
	 * 
	 * @return void
	 */
	public function testValidate()
	{
		$laraclipUploadedFile = $this->buildValidLaraClipUploadedFile();
		
		$laraclipUploadedFile->validate();
	}

	/**
	 * Test that the validate method will throw an exception
	 * when passed an invalid file upload object.
	 * 
	 * @expectedException Expstudio\LaraClip\Exceptions\FileException
	 * @return void
	 */
	public function testValidateThrowsExceptions()
	{
		$laraclipUploadedFile = $this->buildInvalidLaraClipUploadedFile();
		
		$laraclipUploadedFile->validate();
	}

	/**
	 * Helper method to build an valid Expstudio\LaraClip\File\UploadedFile object.	
	 * 
	 * @return UploadedFile
	 */
	public function buildValidLaraClipUploadedFile()
	{
		$symfonyUploadedFile = $this->buildSymfonyUploadedFile();
		
		return new Expstudio\LaraClip\File\UploadedFile($symfonyUploadedFile);
	}

	/**
	 * Helper method to build an invalid Expstudio\LaraClip\File\UploadedFile object.	
	 * 
	 * @return UploadedFile
	 */
	public function buildInvalidLaraClipUploadedFile()
	{
		$symfonyUploadedFile = $this->buildSymfonyUploadedFile(false);
		
		return new Expstudio\LaraClip\File\UploadedFile($symfonyUploadedFile);
	}

	/**
	* Helper method to build a mock Symfony UploadedFile object.
	*
	* @param  boolean $test
	* @return UploadedFile 
	*/
	protected function buildSymfonyUploadedFile($test = true) 
	{
		$path = __DIR__.'/../../fixtures/empty.gif';
		$originalName = 'Test.gif';
		
		return new Symfony\Component\HttpFoundation\File\UploadedFile($path, $originalName, null, null, null, $test);
	}
}
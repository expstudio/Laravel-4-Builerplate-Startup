<?php namespace Expstudio\LaraClip;

use Expstudio\LaraClip\File\UploadedFile;
use Expstudio\LaraClip\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile as SymfonyUploadedFile;

class IOWrapper
{
	/**
	 * Build an UploadedFile object using various file input types.
	 *  
	 * @param  mixed $file 
	 * @return Expstudio\LaraClip\File\UploadedFile
	 */
	public function make($file)
	{
		if ($file instanceof SymfonyUploadedFile) {
			return $this->createFromObject($file);
		}

		if (is_array($file)) {
			return $this->createFromArray($file);
		}

		if (substr($file, 0, 7) == "http://" || substr($file, 0, 8) == "https://") {
			return $this->createFromUrl($file);
		}

		return $this->createFromString($file);
	}

	/**
	 * Compose a Expstudio\LaraClip\File\UploadedFile object from
	 * a symfony\Component\HttpFoundation\File\UploadedFile object.
	 * 
	 * @param  symfony\Component\HttpFoundation\File\UploadedFile $file 
	 * @return Expstudio\LaraClip\File\UploadedFile
	 */
	protected function createFromObject(SymfonyUploadedFile $file)
	{
		$laraclipFile = new UploadedFile($file);
		$laraclipFile->validate();
        
        return $laraclipFile;
	}

	/**
	 * Build a Expstudio\LaraClip\File\File object from the
	 * raw php $_FILES array date.	We assume here that the $_FILES array
	 * has been formated using the LaraClip::arrangeFiles utility method.
	 * 
	 * @param  array $file 
	 * @return Expstudio\LaraClip\File\File      
	 */
	protected function createFromArray($file)
	{
		$file = new SymfonyUploadedFile($file['tmp_name'], $file['name'], $file['type'], $file['size'], $file['error']);

		return $this->createFromObject($file);
	}

	/**
	 * Fetch a remote file using a string URL and convert it into
	 * an instance of Expstudio\LaraClip\File\File.
	 * 
	 * @param  string $file 
	 * @return Expstudio\LaraClip\File\File   
	 */
	protected function createFromUrl($file)
	{
		$ch = curl_init ($file);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$rawFile = curl_exec($ch);
		curl_close ($ch);

		// Get the original name of the file
		$ori_name = pathinfo($file);
		$name = $ori_name['basename'];
		
		// Create a filepath for the file by storing it on disk.
		$filePath = sys_get_temp_dir() . "/$name";
		file_put_contents($filePath, $rawFile);

		return new File($filePath);
	}

	/**
	 * Fetch a local file using a string location and convert it into
	 * an instance of Expstudio\LaraClip\File\File.
	 * 
	 * @param  string $file 
	 * @return Expstudio\LaraClip\File\File   
	 */
	protected function createFromString($file)
	{
		$base_name = pathinfo($file);
		return new File($file, $base_name['basename']);
	}
}

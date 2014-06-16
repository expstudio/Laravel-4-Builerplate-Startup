<?php

class UploadController extends BaseController {

	public function upload()
	{
		// Allowed extentions.
		$allowedExts = array("gif", "jpeg", "jpg", "png", 'JPG', 'JPEG', 'PNG', 'GIF');

		// Get filename.
		$temp = explode(".", $_FILES["file"]["name"]);

		// Get extension.
		$extension = end($temp);

		// An image check is being done in the editor but it is best to
		// check that again on the server side.
		if ((($_FILES["file"]["type"] == "image/gif")
		|| ($_FILES["file"]["type"] == "image/jpeg")
		|| ($_FILES["file"]["type"] == "image/jpg")
		|| ($_FILES["file"]["type"] == "image/pjpeg")
		|| ($_FILES["file"]["type"] == "image/x-png")
		|| ($_FILES["file"]["type"] == "image/png"))
		&& in_array($extension, $allowedExts)) { 
		    // Generate new random name.
		    $name = sha1(microtime()) . $_FILES["file"]["name"];
		    
		    // Save file in the uploads folder.
		    move_uploaded_file($_FILES["file"]["tmp_name"], "./uploads/" . $name);
		    
		    // Generate response.
		    $response = new StdClass;
		    $response->link = url("/uploads/" . $name);
		    echo stripslashes(json_encode($response));
		}
	}

}
<?php
	$newname = $_REQUEST['link'];
	$folder = '../img_data/images/';

  	$uploadimage=$folder.$newname;
  	$actual = $folder.$newname;

  	$temp = explode('.', $newname);
	$ext = end($temp);
	if($ext == 'jpg' || $ext == 'jpeg' || $ext == 'JPG'){
		$source = imagecreatefromjpeg($uploadimage);
	}
	else if($ext == 'png' || $ext == 'PNG'){
		$source = imagecreatefrompng($uploadimage);
	}
	else{
		$source = imagecreatefromgif($uploadimage);
	}

  	// load the image you want to you want to be watermarked
  	$watermark = imagecreatefrompng('../templates/watermark.png');
  	$size = getimagesize($uploadimage);  

  	// get the width and height of the watermark image
  	$water_width = imagesx($watermark);
  	$water_height = imagesy($watermark);

  	// get the width and height of the main image image
  	$main_width = imagesx($source);
  	$main_height = imagesy($source);

  	// Set the dimension of the area you want to place your watermark we use 0
  	// from x-axis and 0 from y-axis 
  	$dime_x = ($size[0] - $water_width)/1.3;  
  	$dime_y = ($size[1] - $water_height)/1.3;

  	// copy both the images
  	imagecopy($source, $watermark, $dime_x, $dime_y, 0, 0, $water_width, $water_height);

  	
  	// Final processing Creating The Image
  	header('Content-type: image/png');
	   imagepng($source);
	   imagedestroy($source);
?>
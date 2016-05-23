<?php
	$inFile = "Imagen2.png";
	$outFile = "/tmp/test-thumbnail.png";
	$image = new Imagick($inFile);
	$image->scaleImage(400, 300, true);
	if($image->getImageWidth() < 400){
		$ancho = (400 - $image->getImageWidth())/2;
		$image->borderImage('transparent',$ancho, 0);
	}
	else if($image->getImageHeight() < 300){
		$alto = (300 - $image->getImageHeight())/2;
		$image->borderImage('transparent',0, $alto);
	}
	$image->writeImage($outFile);

	/*$rsr_org = imagecreatefrompng("Imagen10.png");
	$rsr_scl = imagescale($rsr_org, 400, 300,  IMG_BICUBIC_FIXED);
	imagepng($rsr_scl, "/tmp/test-thumbnail8.png");
	imagedestroy($rsr_org);
	imagedestroy($rsr_scl);*/
?>

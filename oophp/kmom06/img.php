<?php
/**
 * This is a M! pagecontroller.
 */
include(__DIR__.'/config.php');

$image = new CImage();

// Define some constant values, append slash
define('IMG_PATH', __DIR__ . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR);
define('CACHE_PATH', __DIR__ . '/cache/');

// Get the incoming arguments
$image->src 	 	 = isset($_GET['src']) ? $_GET['src'] : null;
$image->verbose 	 = isset($_GET['verbose']) ? true : false;
$image->saveAs	 	 = isset($_GET['save-as']) ? $_GET['save-as'] : null;
$image->quality 	 = isset($_GET['quality']) ? $_GET['quality'] : 75;
$image->ignoreCache  = isset($_GET['no-cache']) ? true : false;
$image->newWidth	 = isset($_GET['width']) ? $_GET['width'] : null;
$image->newHeight	 = isset($_GET['height']) ? $_GET['height'] : null;
$image->cropToFit	 = isset($_GET['crop-to-fit']) ? true : null;
$image->sharpen 	 = isset($_GET['sharpen']) ? true : null;
$image->grayscale    = isset($_GET['grayscale']) ? true : null;
$image->sepia   	 = isset($_GET['sepia']) ? true : null;

$image->pathToImage = realpath(IMG_PATH . $image->src);

// Validate incoming arguments
is_dir(IMG_PATH) or $image->errorMessage('The image dir is not a valid directory.');
is_writable(CACHE_PATH) or $image->errorMessage('The cache dir is not a writable directory.');
$image->validateArg();

// Start displaying log if verbose mode & create url to current image
if($image->verbose)
	$image->startLog();


// Get information on the image
!empty(getimagesize($image->pathToImage)) or $image->errorMessage("The file doesn't seem to be an image.");
if($image->verbose)
	$image->printImageInfo();

// Calculate new width and height for the image
$image->calculateWidthAndHeight();

// Creating a filename for the cache
$image->imageCacheName();

// Is there already a valid image in the cache directory, If cached image is valid, output it and exit.
$image->validCacheImage();

// Open up the image from file
$image->loadImage();

// Resize the image if needed
$image->resizeImage();

// Apply filters and postprocessing of image
$image->postProcess();

// Save the image
$image->saveImage();

// Output the resulting image
$image->outputImage();
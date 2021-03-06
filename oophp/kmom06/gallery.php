<?php
/**
 * This is a M! pagecontroller.
 */
include(__DIR__.'/config.php');

$gallery = new CGallery($db);

// Define the basedir for the gallery
define('GALLERY_PATH', __DIR__ . DIRECTORY_SEPARATOR . 'img');
define('GALLERY_BASEURL', '');

// Get incoming parameters
$path = isset($_GET['path']) ? $_GET['path'] : null;

$pathToGallery = realpath(GALLERY_PATH . DIRECTORY_SEPARATOR . $path);

// Validate incoming arguments
is_dir(GALLERY_PATH) or errorMessage('The gallery dir is not a valid directory.');
substr_compare(GALLERY_PATH, $pathToGallery, 0, strlen(GALLERY_PATH)) == 0 or errorMessage('Security constraint: Source gallery is not directly below the directory GALLERY_PATH.');

// Read and present images in the current directory
if(is_dir($pathToGallery)) {
  $gal = $gallery->readAllItemsInDir($pathToGallery);
}
else if(is_file($pathToGallery)) {
  $gal = $gallery->readItem($pathToGallery);
}

// Prepare content and store it all in variables in the mfact container.
$breadcrumb = $gallery->createBreadcrumb($pathToGallery);

$mfact['title'] = "Ett galleri";
$mfact['main'] = "<h1>{$mfact['title']}</h1><br>$breadcrumb<br>$gal";

// Finally, leave it all to the rendering phase of mfact.
include(MFACT_THEME_PATH);

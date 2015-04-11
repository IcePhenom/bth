<?php
/**
 * Image API.
 */
class CImage {
	// private $db;
	public $src;
	public $verbose;
	public $saveAs;
	public $quality;
	public $ignoreCache;
	public $newWidth;
	public $newHeight;
	public $cropToFit;
	public $sharpen;
	public $grayscale;
	public $sepia;
	public $pathToImage;
	public $cacheFileName;
	private $maxWidth = 2000;
	private $maxHeight = 2000;
	private $cropWidth;
	private $cropHeight;
	private $fileExtension;
	private $img;

	public function __construct(){
	}

	public function errorMessage($message) {
		header("Status: 404 Not Found");
		die('img.php says 404 - ' . htmlentities($message));
	}

	public function verbose($message) {
		echo "<p>" . htmlentities($message) . "</p>";
	}

	/**
	 * Validate incoming arguments
	 * @param $pathToImage Path to the image
	 */
	public function validateArg() {
		isset($this->src) or errorMessage('Must set src-attribute.');
		preg_match('#^[a-z0-9A-Z-_\.\/]+$#', $this->src) or self::errorMessage('Filename contains invalid characters.');
		substr_compare(IMG_PATH, $this->pathToImage, 0, strlen(IMG_PATH)) == 0 or self::errorMessage('Security constraint: Source image is not directly below the directory IMG_PATH.');
		is_null($this->saveAs) or in_array($this->saveAs, array('png', 'jpg', 'jpeg', 'gif')) or self::errorMessage('Not a valid extension to save image as');
		is_null($this->quality) or (is_numeric($this->quality) and $this->quality > 0 and $this->quality <= 100) or self::errorMessage('Quality out of range');
		is_null($this->newWidth) or (is_numeric($this->newWidth) and $this->newWidth > 0 and $this->newWidth <= $this->maxWidth) or self::errorMessage('Width out of range');
		is_null($this->newHeight) or (is_numeric($this->newHeight) and $this->newHeight > 0 and $this->newHeight <= $this->maxHeight) or self::errorMessage('Width out of range');
		is_null($this->cropToFit) or ($this->cropToFit and $this->newWidth and $this->newHeight) or self::errorMessage('Crop to fit needs both width and height to work');
	}

	/**
	 * Start displaying log & create url to current image
	 */
	public function startLog() {
		$query = array();
		parse_str($_SERVER['QUERY_STRING'], $query);
		unset($query['verbose']);
		$url = '?' . http_build_query($query);

		echo "
		<html lang='en'>
		<meta charset='UTF-8'/>
		<title>img.php verbose mode</title>
		<h1>Verbose mode</h1>
		<p><a href=$url><code>$url</code></a><br>
		<img src='{$url}' /></p>";
	}

	/**
	 * Print information of the image
	 * @param  list($width, $height, $type, $attr) = getimagesize(Image);
	 * @param  $pathToImage Path to the image
	 */
	public function printImageInfo() {
		$imgInfo = list($width, $height, $type, $attr) = getimagesize($this->pathToImage);
		$mime = $imgInfo['mime'];
		$filesize = filesize($this->pathToImage);
		self::verbose("Image file: {$this->pathToImage}");
		self::verbose("Image information: " . print_r($imgInfo, true));
		self::verbose("Image width x height (type): {$width} x {$height} ({$type}).");
		self::verbose("Image file size: {$filesize} bytes.");
		self::verbose("Image mime type: {$mime}.");
	}

	/**
	 * Calculate if needed new width and height for the image
	 */
	public function calculateWidthAndHeight() {
		list($width, $height, $type, $attr) = getimagesize($this->pathToImage);
		$aspect = $width/$height;
		if($this->cropToFit && $this->newWidth && $this->newHeight) {
			$targetRatio = $this->newWidth / $this->newHeight;
			$this->cropWidth   = $targetRatio > $aspect ? $width : round($height * $targetRatio);
			$this->cropHeight  = $targetRatio > $aspect ? round($width  / $targetRatio) : $height;
			if($this->verbose)
				self::verbose("Crop to fit box {$this->newWidth}x{$this->newHeight}. Cropping dimensions: {$this->cropWidth}x{$this->cropHeight}.");
		}
		else if($this->newWidth && !$this->newHeight) {
			$this->newHeight = round($this->newWidth / $aspect);
			if($this->verbose)
				self::verbose("New width is set to {$this->newWidth}, height is calculated to {$this->newHeight}.");
		}
		else if(!$this->newWidth && $this->newHeight) {
			$this->newWidth = round($this->newHeight * $aspect);
		 	if($this->verbose)
		 		self::verbose("New height is set to {$this->newHeight}, width is calculated to {$this->newWidth}.");
		}
		else if($this->newWidth && $this->newHeight) {
			$ratioWidth  = $width  / $this->newWidth;
			$ratioHeight = $height / $this->newHeight;
			$ratio = ($ratioWidth > $ratioHeight) ? $ratioWidth : $ratioHeight;
			$this->newWidth  = round($width  / $ratio);
			$this->newHeight = round($height / $ratio);
			if($this->verbose)
				self::verbose("New width & height is requested, keeping aspect ratio results in {$this->newWidth}x{$this->newHeight}.");
		}
		else {
			$this->newWidth = $width;
			$this->newHeight = $height;
			if($this->verbose)
				self::verbose("Keeping original width & height.");
		}
	}

	/**
	 * Creating a filename for the cache
	 */
	public function imageCacheName() {
		$parts 				  = pathinfo($this->pathToImage);
		$this->fileExtension  = $parts['extension'];
		$this->saveAs 		  = is_null($this->saveAs) ? $this->fileExtension : $this->saveAs;
		$quality_		= is_null($this->quality) ? null : "_q{$this->quality}";
		$cropToFit_     = is_null($this->cropToFit) ? null : "_cf";
		$sharpen_       = is_null($this->sharpen) ? null : "_s";
		$grayscale_		= is_null($this->grayscale) ? null : "_gs";
		$sepia_			= is_null($this->sepia) ? null : "_sepia";
		$dirName 		= preg_replace('/\//', '-', dirname($this->src));
		$this->cacheFileName 	= CACHE_PATH . "-{$dirName}-{$parts['filename']}_{$this->newWidth}_{$this->newHeight}{$quality_}{$cropToFit_}{$sharpen_}{$grayscale_}{$sepia_}.{$this->saveAs}";
		$this->cacheFileName 	= preg_replace('/^a-zA-Z0-9\.-_/', '', $this->cacheFileName);

		if($this->verbose)
			self::verbose("Cache file is: {$this->cacheFileName}");
	}

	/**
	 * Is there already a valid image in the cache directory.
	 * @return true if image exists else false.
	 */
	public function validCacheImage() {
		$imageModifiedTime = filemtime($this->pathToImage);
		$cacheModifiedTime = is_file($this->cacheFileName) ? filemtime($this->cacheFileName) : null;
		if(!$this->ignoreCache && is_file($this->cacheFileName) && $imageModifiedTime < $cacheModifiedTime)
			self::outputCacheImage();
		else
			if($this->verbose)
				self::verbose("Cache not valid, process image and create cached version of it");
	}

	/**
	 * Output cached image.
	 */
	public function outputCacheImage() {
		if($this->verbose)
			self::verbose("Cache file is valid, output it.");
		self::outputImage();
	}

	/**
	 * Output an image together with last modified header.
	 *
	 * @param string $file as path to the image.
	 * @param boolean $verbose if verbose mode is on or off.
	 */
	public function outputImage() {
		$info = getimagesize($this->cacheFileName);
		!empty($info) or self::errorMessage("The file doesn't seem to be an image.");
		$mime   = $info['mime'];

		$lastModified = filemtime($this->cacheFileName);
		$gmdate = gmdate("D, d M Y H:i:s", $lastModified);

		if($this->verbose) {
			self::verbose("Memory peak: " . round(memory_get_peak_usage() /1024/1024) . "M");
			self::verbose("Memory limit: " . ini_get('memory_limit'));
			self::verbose("Time is {$gmdate} GMT.");
		}

		if(!$this->verbose)
			header('Last-Modified: ' . $gmdate . ' GMT');

		if(isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) && strtotime($_SERVER['HTTP_IF_MODIFIED_SINCE']) == $lastModified){
			if($this->verbose) {
				self::verbose("Would send header 304 Not Modified, but its verbose mode.");
				exit;
			}
			header('HTTP/1.0 304 Not Modified');
		} else {
			if($this->verbose) {
				self::verbose("Send header to deliver image with modified time: {$gmdate} GMT, but verbose mode.");
				exit;
			}
			header('Content-type: ' . $mime);
			readfile($this->cacheFileName);
		}
		exit;
	}

	/**
	 * Open up the image from file
	 */
	public function loadImage() {
		if($this->verbose)
			self::verbose("File extension is: {$this->fileExtension}");

		switch($this->fileExtension) {
			case 'jpg':
			case 'jpeg': $this->img = imagecreatefromjpeg($this->pathToImage); break;
			case 'png':  $this->img = imagecreatefrompng($this->pathToImage);  break;
		    case 'gif':  $this->img = imagecreatefromgif($this->pathToImage);  break;
		   	default:
				self::errorMessage('No support for this file extension.');
			break;
		}
	}

	/**
	 * Resize the image if needed
	 */
	public function resizeImage() {
		list($width, $height, $type, $attr) = getimagesize($this->pathToImage);
		if($this->cropToFit) {
			if($this->verbose)
				self::verbose("Resizing, crop to fit.");
			$cropX = round(($width - $this->cropWidth) / 2);
			$cropY = round(($height - $this->cropHeight) / 2);
			$imageResized = self::createImageKeepTransparency($this->newWidth, $this->newHeight);
			imagecopyresampled($imageResized, $this->img, 0, 0, $cropX, $cropY, $this->newWidth, $this->newHeight, $this->cropWidth, $this->cropHeight);
			$this->img = $imageResized;
		}
		else if(!($this->newWidth == $width && $this->newHeight == $height)) {
			$imageResized = self::createImageKeepTransparency($this->newWidth, $this->newHeight);
			imagecopyresampled($imageResized, $this->img, 0, 0, 0, 0, $this->newWidth, $this->newHeight, $width, $height);
			$this->img  = $imageResized;
		}
	}

	/**
	 * Apply filters and postprocessing of image
	 */
	public function postProcess() {
		if($this->sharpen)
			$this->img = self::sharpenImage($this->img);
		if($this->grayscale)
			$this->img = self::grayscaleImage($this->img);
		if($this->sepia)
			$this->img = self::sepiaImage($this->img);
	}

	/**
	 * Save the image
	 */
	public function saveImage() {
		switch($this->saveAs) {
			case 'jpeg':
			case 'jpg':
				if($this->verbose)
					self::verbose("Saving image as JPEG to cache using quality = {$this->quality}.");
				imagejpeg($this->img, $this->cacheFileName, $this->quality);
			break;
			case 'png':
				if($this->verbose)
					self::verbose("Saving image as PNG to cache.");
				imagealphablending($this->img, false);
				imagesavealpha($this->img, true);
				imagepng($this->img, $this->cacheFileName);
			break;
			case 'gif':
				if($this->verbose)
					self::verbose("Saving image as GIF to cache.");
				imagegif($this->img, $this->cacheFileName);
			break;
			default:
				self::errorMessage('No support to save as this file extension.');
			break;
		}

		if($this->verbose) {
			clearstatcache();
			$filesize = filesize($this->pathToImage);
			$cacheFilesize = filesize($this->cacheFileName);
			self::verbose("File size of cached file: {$cacheFilesize} bytes.");
			self::verbose("Cache file has a file size of " . round($cacheFilesize/$filesize*100) . "% of original size.");
		}
	}

	/**
	 * Sharpen image as http://php.net/manual/en/ref.image.php#56144
	 * http://loriweb.pair.com/8udf-sharpen.html
	 *
	 * @param resource $image the image to apply this filter on.
	 * @return resource $image as the processed image.
	 */
	public function sharpenImage($image) {
		$matrix = array(
			array(-1,-1,-1,),
			array(-1,16,-1,),
			array(-1,-1,-1,)
		);
		$divisor = 8;
		$offset = 0;
		imageconvolution($image, $matrix, $divisor, $offset);
		return $image;
	}

	/**
	 * Apply grayscale to image
	 *
	 * @param resource $image the image to apply this filter on.
	 * @return resource $image as the processed image.
	 */
	public function grayscaleImage($image) {
		imagefilter($image, IMG_FILTER_GRAYSCALE);
		return $image;
	}

	/**
	 * Apply sepia to image
	 *
	 * @param resource $image the image to apply this filter on.
	 * @return resource $image as the processed image.
	 */
	public function sepiaImage($image) {
		imagefilter($image, IMG_FILTER_GRAYSCALE);
		imagefilter($image, IMG_FILTER_BRIGHTNESS, -10);
		imagefilter($image, IMG_FILTER_CONTRAST, -20);
		imagefilter($image, IMG_FILTER_COLORIZE, 120, 60, 0, 0);
		$image = self::sharpenImage($image);
		return $image;
	}

	/**
	 * Create new image and keep transparency
	 *
	 * @param resource $image the image to apply this filter on.
	 * @return resource $image as the processed image.
	 */
	function createImageKeepTransparency($width, $height) {
	    $img = imagecreatetruecolor($width, $height);
	    imagealphablending($img, false);
	    imagesavealpha($img, true);
	    return $img;
	}
}
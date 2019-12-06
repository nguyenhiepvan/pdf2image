<?php 
namespace Nguyenhiep\Pdf2image;

use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use DateTime;
class Pdf2image
{
	public function cropImage($pdf,$page,$width, $height, $startX, $startY)
	{
		$date = new DateTime();
		$now = $date->getTimestamp();
		$folder_images = "public/images";

		$make_folder = "mkdir -p ".$folder_images;
		$process = Process::fromShellCommandline($make_folder);
		$process->run();

		if(!file_exists($pdf)){
			return false;
		}

		$file_parts = pathinfo($pdf);
		if ($file_parts['extension'] != 'pdf' && $file_parts['extension'] != 'PDF') {
			return false;
		}

		$im = new \Imagick();
		$im->pingImage($pdf);


		if($page > $im->getNumberImages()){
			return false;
		}
		$im->readimage(''.$pdf.'['.($page-1).']'); 

		$d = $im->getImageGeometry();
		$w = $d['width'];
		$h = $d['height'];
		if ($width > $w) {
			return false;
		}
		if ($height > $h) {
			return false;
		}
		if ($startX > $w) {
			return false;
		}
		if ($startY > $w) {
			return false;
		}

		$im->setImageFormat('jpeg');    
		$im->cropImage($width, $height, $startX, $startY);   
		if($im->writeImage($folder_images.'/'.$now.'.png')){
			$im->clear(); 
			$im->destroy();
			return true;
		}
	}
}
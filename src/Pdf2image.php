<?php 
namespace Nguyenhiep\Pdf2image;

use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use DateTime;
use Nguyenhiep\Pdf2image\Exception\Pdf2ImageException;

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
			throw new Pdf2ImageException("File does not exits",0);
			return false;
		}

		$file_parts = pathinfo($pdf);
		if ($file_parts['extension'] != 'pdf' && $file_parts['extension'] != 'PDF') {
			throw new Pdf2ImageException("File isn't .pdf file",1);
			return false;
		}

		$im = new \Imagick();
		$im->pingImage($pdf);


		if($page > $im->getNumberImages()){
			throw new Pdf2ImageException("page invalid",2);
			return false;
		}
		$im->readimage(''.$pdf.'['.($page-1).']'); 

		$d = $im->getImageGeometry();
		$w = $d['width'];
		$h = $d['height'];
		if ($width > $w) {
			throw new Pdf2ImageException("width invalid",3);
			return false;
		}
		if ($height > $h) {
			throw new Pdf2ImageException("height invalid",4);
			return false;
		}
		if ($startX > $w) {
			throw new Pdf2ImageException("start X invalid",5);
			return false;
		}
		if ($startY > $w) {
			throw new Pdf2ImageException("start Y invalid",6);
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
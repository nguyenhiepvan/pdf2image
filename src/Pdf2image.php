<?php 
namespace Nguyenhiep\Pdf2image;

use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use DateTime;
class Pdf2image
{
	public function say($toSay = "Nothing given")
	{
		$process = new Process(['ls', '-lsa']);
		$process->run();
		if (!$process->isSuccessful()) {
			throw new ProcessFailedException($process);
		}

		echo $process->getOutput();
	}

	public function cropImage($pdf,$page,$width, $height, $startX, $startY)
	{
		$date = new DateTime();
		$now = $date->getTimestamp();
		$folder_images = "public/images";

		$make_folder = "mkdir -p ".$folder_images;
		$process = Process::fromShellCommandline($make_folder);
		$process->run();

		$im = new \Imagick();
		$im->readimage(''.$pdf.'['.($page-1).']'); 
		$im->setImageFormat('jpeg');    
		$im->cropImage($width, $height, $startX, $startY);   
		$im->writeImage($folder_images.'/'.$now.'.png'); 
		$im->clear(); 
		$im->destroy();
	}
}
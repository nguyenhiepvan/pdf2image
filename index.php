<?php 
require_once __DIR__ .'/vendor/autoload.php';
use Nguyenhiep\Pdf2image\Pdf2image;

$instance = new Pdf2image();

var_dump($instance->cropImage(__DIR__.'/demo.pdf',10,100, 100, 100, 100));
die();
?>
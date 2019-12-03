<?php
// die(__DIR__);
require_once(__DIR__.'/vendor/autoload.php');

// $fileone = realpath('demo.pdf');
$pdf = new Spatie\PdfToImage\Pdf(__DIR__.'/demo.pdf');
$pdf->saveImage(__DIR__.'/upload/');
?>
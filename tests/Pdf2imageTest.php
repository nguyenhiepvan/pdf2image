<?php 
namespace Tests;

use PHPUnit\Framework\TestCase;
use Nguyenhiep\Pdf2image\Pdf2image;

/**
 * 
 */
class Pdf2imageTest extends TestCase
{
	//Kiểm tra cắt ảnh thành công
	public function testCropImageReturnTrue()
	{
		$pdf2image = new Pdf2image;
		$result = $pdf2image->cropImage(__DIR__.'/demo.pdf',1,100,100,100,100);

		$this->assertTrue($result);
	}
	//Kiểm tra lỗi file không hợp lệ
	public function testCropImageReturnFalseForInvalidFilePath()
	{
		$pdf2image = new Pdf2image;
		$result = $pdf2image->cropImage(__DIR__.'/demo000.pdf',1,100,100,100,100);

		$this->assertFalse($result);
	}
	public function testCropImageReturnFalseForInvalidTypeFile()
	{
		$pdf2image = new Pdf2image;
		$result = $pdf2image->cropImage(__DIR__.'/demo.jpg',1,100,100,100,100);

		$this->assertFalse($result);
	}
	public function testCropImageReturnFalseForInvalidPage()
	{
		$pdf2image = new Pdf2image;
		$result = $pdf2image->cropImage(__DIR__.'/demo.pdf',10,100,100,100,100);

		$this->assertFalse($result);
	}
	public function testCropImageReturnFalseForInvalidWidth()
	{
		$pdf2image = new Pdf2image;
		$result = $pdf2image->cropImage(__DIR__.'/demo.pdf',1,1000,100,100,100);

		$this->assertFalse($result);
	}
	public function testCropImageReturnFalseForInvalidHeigh()
	{
		$pdf2image = new Pdf2image;
		$result = $pdf2image->cropImage(__DIR__.'/demo.pdf',1,100,1000,100,100);

		$this->assertFalse($result);
	}
	public function testCropImageReturnFalseForInvalidStartX()
	{
		$pdf2image = new Pdf2image;
		$result = $pdf2image->cropImage(__DIR__.'/demo.pdf',1,100,100,1000,100);

		$this->assertFalse($result);
	}
	public function testCropImageReturnFalseForInvalidStartY()
	{
		$pdf2image = new Pdf2image;
		$result = $pdf2image->cropImage(__DIR__.'/demo.pdf',1,100,100,100,1000);

		$this->assertFalse($result);
	}
}
?>
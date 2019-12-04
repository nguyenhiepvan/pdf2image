# Convert a pdf to an image

This package provides an easy to work with class to cropping an image from pdf file

## Requirements
You should have [Imagick](http://php.net/manual/en/imagick.setresolution.php) and [Ghostscript](http://www.ghostscript.com/) installed. See [issues regarding Ghostscript](https://github.com/nguyenhiepvan/pdf2image#issues-regarding-ghostscript).
## Installation

The package can be installed via composer:

```bash
composer require nguyenhiep/pdf2image
```

## Usage

```php
use Nguyenhiep\Pdf2image\Pdf2image;

$instance = new Pdf2image();

$instance->cropImage($pdf,$page,$width, $height, $startX, $startY);
```
the output will be saved in public/images.

## Issues regarding Ghostscript
This package uses Ghostscript through Imagick. For this to work Ghostscripts ```gs``` command should be accessible from the PHP process. For the PHP CLI process (e.g. Laravel's asynchronous jobs, commands, etc...) this is usually already the case.

However for PHP on FPM (e.g. when running this package "in the browser") you might run into the following problem:

```Uncaught ImagickException: FailedToExecuteCommand 'gs'```
This can be fixed by adding the following line at the end of your ```php-fpm.conf``` file and restarting PHP FPM. If you're unsure where the ```php-fpm.conf``` file is located you can check ```phpinfo()```. If you are using Laravel Valet the ```php-fpm.conf``` file will be located in the ```/usr/local/etc/php/YOUR-PHP-VERSION``` directory.

```env[PATH] = /usr/local/bin:/usr/bin:/bin```
This will instruct PHP FPM to look for the ```gs``` binary in the right places.
## Security
If you discover any security related issues, please email [Mr. Hiep](mailto:nguyenhiepvan.bka@gmail.com?subject=[GitHub] issue with pdf2image) instead of using the issue tracker.
## License
[MIT](https://choosealicense.com/licenses/mit/)

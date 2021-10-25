# upload image and Fit size the image with PHP

# How to Use
### first of all to use this script you need to add AutoLoader and Intervention Library to your project 
Add autoLoader :\
```
   composer dump-autoload
```

Add Intervention Library:
```
 composer require intervention/image
```


#### Then whenever you wanna use this feacher just Add the class I wrote and upload and resize your image as simple as possible
```php 
require "../vendor/autoload.php";
use UploadImage\UploadImage;

UploadImage::uploadAndFitImage(file, path , name ,width , height );
```


#### Forexample :
``` php 
namespace Server;
ob_start();
require "../vendor/autoload.php";
use UploadImage\UploadImage;



$path = "files/".date('Y/M/d');
$name = date("Y_M_d_H_i_s"). "_" .rand(10,99);
UploadImage::uploadAndFitImage($_FILES['image'], $path , $name ,900 , 500 );
header("Location: ". $_SERVER['HTTP_REFERER']);

```


#### The content of UploadImage\UploadImage is right here bellow:
```php 

namespace UploadImage;

use Intervention\Image\ImageManager;

class UploadImage
{
    private function makeImageName($file, $name)
    {
        $name = trim($name, "\/") . "." . pathinfo($file["name"], PATHINFO_EXTENSION);
        return $name;
    }

    private function findPath($path)
    {
        $path = trim($path, "\/") . "/";
        if (!is_dir($path)) {
            if (!mkdir("$path", 0777, true)) {
                die("Error : can't creat or find directory in $path");
            }
            is_writable($path);
        }
        return $path;
    }

    public static function uploadAndFitImage($file, $path, $name, $width, $height)
    {
        $name = self::makeImageName($file, $name);
        $path = self::findPath($path);

        $manager = $manager = new ImageManager(array('driver' => 'GD'));
        $image = $manager->make($file['tmp_name'])->fit($width, $height);
        $image->save($path . $name);

        return $path;
    }
}

```


## please coaperate and make this class more and more usefull

Thank You a lot :)




















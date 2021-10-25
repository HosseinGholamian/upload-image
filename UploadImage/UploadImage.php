<?php

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

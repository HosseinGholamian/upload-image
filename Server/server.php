<?php
namespace Server;
ob_start();
require "../vendor/autoload.php";
use UploadImage\UploadImage;



$path = "files/".date('Y/M/d');
$name = date("Y_M_d_H_i_s"). "_" .rand(10,99);
UploadImage::uploadAndFitImage($_FILES['image'], $path , $name ,900 , 500 );
header("Location: ". $_SERVER['HTTP_REFERER']);
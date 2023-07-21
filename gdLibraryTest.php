<?php
if(extension_loaded("gd")){
}
$image = imagecreate(500,400);
imagecolorallocate($image,0,0,0);
$textColor = imagecolorallocate($image,255,255,255);
$code = null;
for($i = 0 ;$i < 5 ;$i++)
{
    $num = rand(1,9);
    imagettftext($image,rand(20,50) ,0,180 + ($i*40),rand(200,230),$textColor,realpath(__DIR__."/arial.ttf"),$num);
    $code.=(string)$num;
}
ob_start();
imagejpeg($image);
$final_image = ob_get_clean();
imagedestroy($image);
header("Content-Type: image/jpeg");
echo $final_image;
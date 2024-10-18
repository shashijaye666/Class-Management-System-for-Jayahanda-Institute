<?php
// Load the polygon image
//$sourceImage = 'dist/img/photo1.png';

// (A) OPEN IMAGE
$img = imagecreatefromjpeg("dist/img/B1Smallest.jpg");

$red = imagecolorallocate($img,  255, 0, 0); //red
$green = imagecolorallocate($img,  0, 150, 2); //green


$point1 = array(372,583,451,530,465,548,386,602);
$point2 = array(784,842,804,850,761,935,739,922);

imagefilledpolygon($img, $point1, 4, $red);
imagefilledpolygon($img, $point2, 4, $green);

// (B) WRITE TEXT
$txt = "400";
$fontFile = "C:\Windows\Fonts\arial.ttf"; // CHANGE TO YOUR OWN!
$fontSize = 15;
$fontColor = imagecolorallocate($img, 255, 255, 255);
$posX = $point1[6];
$posY = $point1[7];
$angle = 35;
imagettftext($img, $fontSize, $angle, $posX, $posY, $fontColor, $fontFile, $txt);


$txt = "400";
$fontFile = "C:\Windows\Fonts\arial.ttf"; // CHANGE TO YOUR OWN!
$fontSize = 15;
$fontColor = imagecolorallocate($img, 255, 255, 255);
$posX = $point2[6];
$posY = $point2[7];
$angle = 35;
imagettftext($img, $fontSize, $angle, $posX, $posY, $fontColor, $fontFile, $txt);
                


//imagejpeg($img, "dist/img/B1Smallest1.jpg");



header("Content-type: image/png");
imagepng($img);
imagedestroy($img);


?>
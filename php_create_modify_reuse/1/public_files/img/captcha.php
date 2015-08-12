<?php
include '../../lib/functions.php';

if (!isset($_SESSION)) {
	session_start();
	header('Cache-control:private');
}

$width = 65;
$height = 20;
$image = imagecreate(65,20);

$bg_color = imagecolorallocate($image, 0x33, 0x66, 0xFF);
imagefilledrectangle($image,0,0,$width,$height,$bg_color);

$text = random_text(5);

$font = 5;
$x = imagesx($image)/2 - strlen($text)*imagefontwidth($font)/2;
$y = imagesy($image)/2 - imagefontheight($font)/2;

$fg_color = imagecolorallocate($image, 0xFF, 0xFF, 0xFF);
imagestring($image, $font, $x, $y, $text, $fg_color);

$_SESSION['captcha'] = $text;



header('Content-type:image/png');

imagepng($image);
imagedestroy($image);


?>
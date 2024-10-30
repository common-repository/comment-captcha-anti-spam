<?php

session_start(); // Staring Session
$captchanumber = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890abcdefghijklmnopqrstuvwxyz'; // Initializing PHP variable with string
$captchanumber = substr(str_shuffle($captchanumber), 0, 6); // Getting first 6 word after shuffle.
$_SESSION["code"] = $captchanumber; // Initializing session variable with above generated sub-string
header('Content-Type: image/png');
$im = imagecreatetruecolor(120, 20) or die('Cannot Initialize new GD image stream');
$text_color = imagecolorallocate($im, 0, 14, 91); // Font Color
$image = imagecreatefromjpeg('images/bj.jpeg'); // Generating CAPTCHA
imagestring($image, 15, 80, 23, $captchanumber, $text_color);
imagejpeg($image);
imagedestroy($image);
?>


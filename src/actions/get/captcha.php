<?php
$rand1 = rand(1,100);
$rand2 = rand(1,100);
$_SESSION["captcha_text"] = $rand1+$rand2;
$textSize = 8;
$text="$rand1 + $rand2 ";

$image = imagecreatefromjpeg("src\actions\get\captcha.jpg");

$color= imagecolorallocate($image, 255,255,255);
$font_color = imagecolorallocate($image, 0, 0, 0);
imagestring($image, 5, 20, 5, $text, $font_color);

header("Content-type: image/jpeg");
imagejpeg($image);

imagedestroy($image);
?>
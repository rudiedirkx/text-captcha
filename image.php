<?php

use rdx\textcaptcha\CaptchaMaker;

$fontFiles = [
	'/usr/share/fonts/truetype/dejavu/DejaVuSerif.ttf',
	'/usr/share/fonts/truetype/lato/Lato-ThinItalic.ttf',
];
$fontFiles = glob('/usr/share/fonts/truetype/*/*.ttf');
$fontFiles = array_filter($fontFiles, function($file) {
	return stripos($file, 'dings') === false;
});
$fontFile = $fontFiles[array_rand($fontFiles)];

if (!isset($_GET['image'])) {
	?>
	<style>
	body { background: #eee; }
	img {height: 44px; margin-bottom: .5em; outline: solid 1px red; }
	</style>
	<img src="image.php?image=0"><br>
	<img src="image.php?image=1"><br>
	<img src="image.php?image=2"><br>
	<img src="image.php?image=3"><br>
	<img src="image.php?image=4"><br>
	<img src="image.php?image=5"><br>
	<img src="image.php?image=6"><br>
	<img src="image.php?image=7"><br>
	<img src="image.php?image=8"><br>
	<img src="image.php?image=9"><br>
	<?php
	exit;
}

require 'vendor/autoload.php';

$maker = CaptchaMaker::createLocal('nl');

$captcha = $maker->make();
$text = $captcha->getQuestion();
preg_match('#^(.{' . ceil(strlen($text)/2) . ',}?) (.+)$#', $text, $lines);
array_shift($lines);

$img = imagecreatetruecolor(strlen($text) * 11, 44);
$textColor = imagecolorallocate($img, rand(0, 190), rand(0, 190), rand(0, 190));
$white = imagecolorallocate($img, 255, 255, 255);
$transp = imagecolortransparent($img, $white);

imagefill($img, 0, 0, $white);

// $font = imageloadfont($fontFile);
// imagestring($img, $font, 5, 5, $text, $color);

imagettftext($img, 16, 0, 2, 18, $textColor, $fontFile, $lines[0]);
imagettftext($img, 16, 0, 2, 38, $textColor, $fontFile, $lines[1]);

header('Content-Type: image/png');
imagepng($img);

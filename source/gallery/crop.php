<?php

$targ_w = $targ_h = 200;
$jpeg_quality = 90;

$pic=$_POST['picsrc'];
$src = "uploads/photos/".$_POST['picsrc'];
$img_r = imagecreatefromjpeg($src);
$dst_r = ImageCreateTrueColor( $targ_w, $targ_h );

imagecopyresampled($dst_r,$img_r,0,0,$_POST['x'],$_POST['y'],$targ_w,$targ_h,$_POST['w'],$_POST['h']);

imagejpeg($dst_r,"uploads/photos/thumbs/".$_POST['picsrc'],$jpeg_quality);

echo "Thumbnail Saved !";
?>
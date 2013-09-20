<?php
if(!empty($_POST["picsrc"]) || !empty($_POST["cid"]))
{
$targ_w = $targ_h = 200;
$jpeg_quality = 90;

$pic=$_POST['picsrc'];
$cid=$_POST['cid'];
$src = "uploads/photos/".$pic;
$img_r = imagecreatefromjpeg($src);
$dst_r = ImageCreateTrueColor( $targ_w, $targ_h );

imagecopyresampled($dst_r,$img_r,0,0,$_POST['x'],$_POST['y'],$targ_w,$targ_h,$_POST['w'],$_POST['h']);

imagejpeg($dst_r,"uploads/photos/thumbs/".$pic,$jpeg_quality);

echo "
	<form role='form'>
		  <div class='form-group'>
			<label for='photoName'>Name</label>
			<input type='text' class='form-control' id='photoName' placeholder='Photo Name'>
		  </div>
		  <div class='form-group'>
			<label for='photoDesc'>Description</label>
			<textarea class='form-control' id='photoDesc' rows='5' placeholder='Photo Description'></textarea>
		  </div>
		  <div class='form-group'>
			<button type='button' class='btn btn-primary addPhotoBtn' data-cid='".$cid."' data-pcode='".$pic."'>Add Photo</button>
		  </div>	  
	  </form>
	  <br>
	  <div class='alert alert-dismissable systemAlert'>
		  <button type='button' class='close hideBtn'>&times;</button>
		  <h3 class='alertHead'></h3><p class='alertBody'></p>.
	  </div>
";
}
else
echo "<script>window.location.assign('../?p=error6');</script>";

?>
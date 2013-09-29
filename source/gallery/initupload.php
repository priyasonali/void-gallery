<?php
if(!defined('socket')) {
echo "<script>window.location.assign('../?p=error6');</script>";
}

require 'gallery/dbconnect.php';
$chk=0;

if(!empty($_REQUEST['cid']))
{
	$cid = $_REQUEST['cid'];
}
else
{
	echo '<script>window.location.assign("?p=error1");</script>';
}

$result1 = mysqli_query($con,"SELECT * FROM collection WHERE cid=".$cid." ");
while($ro = mysqli_fetch_array($result1))
	{			
		$cname = $ro['cname'];
		$chk=1;
	}
if($cid<1 || !is_numeric($cid) || $chk == 0)	echo '<script>window.location.assign("?p=error1");</script>';

echo '
	<section class="container">
		<div class="page-header">
			<h1>Add photo to <a href="?p=viewcollection&cid='.$cid.'">'.$cname.'</a></h1>
		</div>
	</section>

	<section class="container photoUpload">
	<div class="row lead">
		<div class="col-md-12">
			<p>First, choose a photo* to upload.</p>
			<input class="lateHide" id="itemUpload" data-cid="'.$cid.'" type="file" name="item" data-url="gallery/uploadhandler.php">
			<div class="uploadProgress">
			  <div class="progress-bar" style="width: 0%;"></div>
			</div>
		</div>
	</div>
	<small class="lateHide text-info">*Only JPEG (.jpg) images of max. 1MB allowed.</small>
	</section>
';
?>
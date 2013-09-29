<?php
if(!defined('socket')) {
echo "<script>window.location.assign('../?p=error6');</script>";
}
$session = 0;
if(isset($_SESSION['gallerySession']))
{
if($_SESSION['gallerySession'] == "admin")
$session = 1;
}
echo '<section class="container"><div class="page-header">';

require 'gallery/dbconnect.php';
if(!empty($_REQUEST['cid']))
{
	$cid = $_REQUEST['cid'];
}
else
{
	echo '<script>window.location.assign("?p=error1");</script>';
}
$check=0;
$passign=0;
$vassign=0;
$result = mysqli_query($con,"SELECT * FROM collection WHERE cid=$cid ");
		while($row = mysqli_fetch_array($result))
			{
				$cid = $row['cid'];
				$cname = $row['cname']; 
				$cdesc = $row['cdesc']; 
				$cdate = $row['cdate']; 
				$cstatus = $row['cstatus'];
				$result1 = mysqli_query($con,"SELECT * FROM assign WHERE cid=$cid ");
				while($ro = mysqli_fetch_array($result1))
					{
					$pid = $ro['pid'];
					$vid = $ro['vid'];
					
					if ($session == 1)
					{
						if($pid!=0)
						$passign=1;
						if($vid!=0)
						$vassign=1;
					}
					else
					{
						$result2 = mysqli_query($con,"SELECT * FROM photo WHERE pid=$pid AND pstatus=1");
						while($ro1 = mysqli_fetch_array($result2))
						{
							$passign=1;
						}
						$result3 = mysqli_query($con,"SELECT * FROM video WHERE vid=$vid AND vstatus=1");
						while($ro2 = mysqli_fetch_array($result3))
						{
							$vassign=1;
						}
					}
					}
				$check=1;
			}
if($check==0 || !is_numeric($cid))	echo '<script>window.location.assign("?p=error1");</script>';
echo '<h1>'.$cname.' in <a href="?p=initcollection">Collections</a>'; 
if ($session == 1) echo' <a class="editCollection" title="Edit Collection" data-cid="'.$cid.'" data-cstatus="'.$cstatus.'" data-cname="'.$cname.'" data-cdesc="'.$cdesc.'" href="#">
<span class="glyphicon glyphicon-edit"></span></a>';
echo '</h1>
	</div>
</section>

<section class="container standaloneView">
	<div class="row hideFlow">
		<blockquote>
		'.$cdesc.'
		</blockquote>
	</div>
	<div class="row">
		<div class="col-md-4 col-md-offset-1 text-center">';
		if($passign==1)
		echo '<a href="?p=initphoto&cid='.$cid.'" title="View Photos"><img src="gallery/img/photo.png" width="200px" height="200px" alt="photos"/></a><br>';
		else
		echo '<a href="#" title="Empty"><img src="gallery/img/photo-disabled.png" width="200px" height="200px" alt="photos"/></a><br>';
		echo '<h2>Photos ';
		if ($session == 1)
		echo '<a class="addPhoto" title="Add Photo"  href="?p=initupload&cid='.$cid.'"><span class="glyphicon glyphicon-plus-sign"></span></a>';
		echo '</h2></div><div class="col-md-4 col-md-offset-2 text-center">';
		if($vassign==1)
		echo '<a href="?p=initvideo&cid='.$cid.'" title="View Video"><img src="gallery/img/video.png" width="200px" height="200px" alt="videos"/></a><br>';
		else
		echo '<a href="#" title="Empty"><img src="gallery/img/video-disabled.png" width="200px" height="200px" alt="videos"/></a><br>';
		echo '<h2>Videos ';
		if ($session == 1)
		echo '<a class="addVideo" title="Add Video"  href="?p=addvideo&cid='.$cid.'"><span class="glyphicon glyphicon-plus-sign"></span></a>';
		echo '</h2>
		</div>
	</div>
</section>
';
?>


<aside class="modal fade" id="systemModal" tabindex="-1" role="dialog" aria-labelledby="systemLabel" aria-hidden="true">
	<div class="modal-dialog">
	  <div class="modal-content">
		<div class="modal-header">
		  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		  <h4 class="modal-title">Modal title</h4>
		</div>
		<div class="modal-body">
		  ...
		</div>
		<div class="modal-footer">
		  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		  <button type="button" class="btn btn-primary">Save changes</button>
		</div>
	  </div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</aside><!-- /.modal -->
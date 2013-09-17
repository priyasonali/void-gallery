<?php
require 'dbconnect.php';
if(!empty($_REQUEST['cid']))
{
	$cid = $_REQUEST['cid'];
}
else
{
	echo '<script>window.location.assign("?p=error1");</script>';
}
$check=0;
$result = mysqli_query($con,"SELECT * FROM collection WHERE cid=$cid ");
		while($row = mysqli_fetch_array($result))
			{
				$cid = $row['cid'];
				$cname = $row['cname']; 
				$cdesc = $row['cdesc']; 
				$cdate = $row['cdate']; 
				$cstatus = $row['cstatus'];
				$check=1;
			}
if($check==0 || !is_numeric($cid))	echo '<script>window.location.assign("?p=error1");</script>';

?>
<section class="container">
	<div class="page-header">
		<h1>Picnic to Chandipur <a class="addCollection" title="Edit Collection"  href="#"><span class="glyphicon glyphicon-edit"></span></a></h1>
	</div>
</section>

<section class="container standaloneView">
	<div class="row">
		<blockquote>
		<?php echo $cdesc; ?>
		</blockquote>
	</div>
	<div class="row">
		<div class="col-md-4 col-md-offset-1 text-center">
			<a href="?p=initphoto&cid=<?php echo $cid; ?>" title="View Photos"><img src="gallery/img/photo.png" width="200px" height="200px" alt="photos"/></a><br>
			<h2>Photos <a class="addPhoto" title="Add Photo"  href="#"><span class="glyphicon glyphicon-plus-sign"></span></a></h2>
		</div>
		<div class="col-md-4 col-md-offset-2 text-center">
			<a href="?p=initvideo&cid=<?php echo $cid; ?>" title="Empty"><img src="gallery/img/video-disabled.png" width="200px" height="200px" alt="videos"/></a><br>
			<h2>Videos <a class="addVideo" title="Add Video"  href="#"><span class="glyphicon glyphicon-plus-sign"></span></a></h2>
		</div>
	</div>
</section>


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
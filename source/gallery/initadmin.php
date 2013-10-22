<?php
if(!defined('secureplug'))
echo "<script>window.location.assign('../?p=error6');</script>";
$session = 0;
if(isset($_SESSION['gallerySession']))
{
if($_SESSION['gallerySession'] == "admin")
$session = 1;
}
?>

<section class="container">
	<div class="page-header text-center">
		<h1>Void Gallery - Administrator</h1>
	</div>
</section>

<section class="container">
<?php
if($session != 1)
{
	echo '
		<div class="row  text-center">
			<div class="col-md-4 col-md-offset-4">
				<form role="form">
					<div class="form-group">
						<input type="password" class="form-control input-lg" id="inputPassword" placeholder="Enter Password"><br>
						<button type="button" class="btn btn-primary btn-lg adminLoginBtn">Sign In</button>
						<a href="?p=initcollection"><button type="button" class="btn btn-info btn-lg">Go to Gallery</button></a>
					</div>
				</form>
			</div>
		</div>
	';
}
else
{
	echo '
		<div class="row  text-center">
			<div class="col-md-12">
				<form role="form">
					<div class="form-group">
						<button type="button" class="btn btn-danger btn-lg adminLogoutBtn">Sign Out</button>
						<a href="?p=initcollection"><button type="button" class="btn btn-info btn-lg">Go to Gallery</button></a>
					</div>
				</form>
			</div>
		</div>
	
	';
	/*echo '
		<hr>
			<div class="row  text-center">
			<div class="col-md-12">
				<h3>Settings</h3>
			</div>
		</div>
	';*/
}
?>
</section>
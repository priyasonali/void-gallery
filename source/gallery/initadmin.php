<?php
if(!defined('socket'))
echo "<script>window.location.assign('../?p=error6');</script>";
$session = 0;
if(isset($_SESSION['gallerySession']))
{
if($_SESSION['gallerySession'] == "admin")
$session = 1;
}
if($session != 1)
{
if(!empty($_POST['pass']))
$passcode = $_POST['pass'];
else $passcode = "";
if($passcode == "abcd")
$_SESSION['gallerySession'] == "admin";
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
		<div class="row">
			<div class="col-md-6">
				<form role="form" action="?p=initadmin" method="post">
					<div class="form-group">
						<input type="password" class="form-control input-lg" id="password" name="password" placeholder="Enter Password">
					</div>
				</form>
			</div>
			<div class="col-md-6">

			</div>
		</div>	
	';
}
?>


</div>
<hr>
</section>
<?php
require 'dbconnect.php';

if(!empty($_POST["vid"]))
{
$vid=mysqli_real_escape_string($con,$_POST['vid']);

mysqli_query($con,"DELETE FROM video WHERE vid=".$vid."" );
mysqli_query($con,"DELETE FROM assign WHERE vid=".$vid."" );

echo "done";
}
else
echo "<script>window.location.assign('../?p=error6');</script>";

?>
<?php
require 'dbconnect.php';

$vid=mysqli_real_escape_string($con,$_POST['vid']);

mysqli_query($con,"DELETE FROM video WHERE vid=".$vid."" );
mysqli_query($con,"DELETE FROM assign WHERE vid=".$vid."" );

echo "done";
?>
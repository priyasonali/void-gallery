<?php
require 'dbconnect.php';

$vid=mysqli_real_escape_string($con,$_POST['vid']);
$chk=0;

$query1=mysqli_query($con,"SELECT * FROM assign WHERE vid='".$vid."'");
while($row1 = mysqli_fetch_array($query1))
{
$cid=$row1['cid'];
}

mysqli_query($con,"DELETE FROM video WHERE vid=".$vid."" );
mysqli_query($con,"DELETE FROM assign WHERE vid=".$vid."" );

$query2=mysqli_query($con,"SELECT * FROM assign WHERE cid='".$cid."' AND vid != 0");
while($row2 = mysqli_fetch_array($query2))
{
$chk = 1;
}

if($chk == 0)
echo "end";
else
echo "done";
?>
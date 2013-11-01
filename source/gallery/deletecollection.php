<?php
require 'dbconnect.php';

if(!empty($_POST["cid"]))
{
$cid=mysqli_real_escape_string($con,$_POST['cid']);

mysqli_query($con,"DELETE FROM collection WHERE cid=".$cid."" );

$query1=mysqli_query($con,"SELECT * FROM assign WHERE cid=$cid AND pid != 0");
while($row1 = mysqli_fetch_array($query1))
{
$pid=$row1['pid'];
$query=mysqli_query($con,"SELECT * FROM photo WHERE pid=$pid");
while($row = mysqli_fetch_array($query))
{
$pic=$row['pcode'];
}
unlink("uploads/photos/".$pic);
unlink("uploads/photos/thumbs/".$pic);
mysqli_query($con,"DELETE FROM photo WHERE pid=".$pid."" );
}

$query2=mysqli_query($con,"SELECT * FROM assign WHERE cid=$cid AND vid != 0");
while($row2 = mysqli_fetch_array($query2))
{
$vid=$row2['vid'];
mysqli_query($con,"DELETE FROM video WHERE vid=$vid");
}

mysqli_query($con,"DELETE FROM assign WHERE cid=".$cid."" );

echo "done";
}
else
echo "<script>window.location.assign('../?p=error6');</script>";

mysqli_close($con);
?>
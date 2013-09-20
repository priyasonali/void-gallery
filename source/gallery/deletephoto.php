<?php
require 'dbconnect.php';

if(!empty($_POST["pid"]))
{
$chk = 0;
$pid=mysqli_real_escape_string($con,$_POST['pid']);

$query=mysqli_query($con,"SELECT * FROM photo WHERE pid='".$pid."'");
while($row = mysqli_fetch_array($query))
{
$pic=$row['pcode'];
}
$query1=mysqli_query($con,"SELECT * FROM assign WHERE pid='".$pid."'");
while($row1 = mysqli_fetch_array($query1))
{
$cid=$row1['cid'];
}
unlink("uploads/photos/".$pic);
unlink("uploads/photos/thumbs/".$pic);
mysqli_query($con,"DELETE FROM photo WHERE pid=".$pid."" );
mysqli_query($con,"DELETE FROM assign WHERE pid=".$pid."" );

$query2=mysqli_query($con,"SELECT * FROM assign WHERE cid='".$cid."' AND pid != 0");
while($row2 = mysqli_fetch_array($query2))
{
$chk = 1;
}

if($chk == 0)
echo "end";
else
echo "done";
}
else
echo "<script>window.location.assign('../?p=error6');</script>";

mysqli_close($con);
?>
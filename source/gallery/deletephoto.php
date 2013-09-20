<?php
require 'dbconnect.php';

$pid=mysqli_real_escape_string($con,$_POST['pid']);

$query=mysqli_query($con,"SELECT * FROM photo WHERE pid='".$pid."'");
while($row = mysqli_fetch_array($result))
{
$pic=$row['pcode'];
}
unlink("gallery/uploads/photos".$pic);
unlink("gallery/uploads/photos/thumbs".$pic);
mysqli_query($con,"DELETE FROM photo WHERE pid=".$pid."" );
mysqli_query($con,"DELETE FROM assign WHERE pid=".$pid."" );

echo "done";
?>
<?php

require 'dbconnect.php';

if(!empty($_POST["pid"]) || !empty($_POST["pname"]) || !empty($_POST["pdesc"]) || !empty($_POST["pstatus"]))
{
$pid = mysqli_real_escape_string($con,$_POST["pid"]);
$pname = mysqli_real_escape_string($con,$_POST["pname"]);
$pdesc = mysqli_real_escape_string($con,$_POST["pdesc"]); 
$pstatus = mysqli_real_escape_string($con,$_POST["pstatus"]); 
$date = date("d/m/y"); 
$deny=0;


$result1=mysqli_query($con,"SELECT * FROM photo WHERE pid=".$pid."");
while($row1=mysqli_fetch_array($result1))
{
$name=$row1['pname'];
}
/*
======================================
Check for video name availability
======================================
*/
if($pname!=$name)
{
$result=mysqli_query($con,"SELECT * FROM photo");
while($row=mysqli_fetch_array($result))
{
if($pname==$row['pname'])
{
$deny+=1;
}
}
}

if($deny>=1)
{
echo "exists";
}
else
{
$result1=mysqli_query($con,"SELECT * FROM assign WHERE pid=".$pid."");
while($row1=mysqli_fetch_array($result1))
	{
	$cid=$row1['cid'];
	}
$check= mysqli_query($con,"UPDATE photo SET pname='".$pname."', pdesc='".$pdesc."', pdate='".$date."', pstatus=".$pstatus." WHERE pid=".$pid."");
$check1= mysqli_query($con,"UPDATE collection SET cdate='".$date."' WHERE cid=".$cid."");

echo "done";


}
}
else
echo "<script>window.location.assign('../?p=error6');</script>";

mysqli_close($con);


?>
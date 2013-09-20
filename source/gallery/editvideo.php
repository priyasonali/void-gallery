<?php

require 'dbconnect.php';

if(!empty($_POST["vid"]) || !empty($_POST["vname"]) || !empty($_POST["vdesc"]) || !empty($_POST["vstatus"]))
{
$vid = mysqli_real_escape_string($con,$_POST["vid"]);
$vname = mysqli_real_escape_string($con,$_POST["vname"]);
$vdesc = mysqli_real_escape_string($con,$_POST["vdesc"]); 
$vstatus = mysqli_real_escape_string($con,$_POST["vstatus"]); 
$date = date("d/m/y"); 
$deny=0;


$result1=mysqli_query($con,"SELECT * FROM video WHERE vid=".$vid."");
while($row1=mysqli_fetch_array($result1))
{
$name=$row1['vname'];
}
$result2=mysqli_query($con,"SELECT * FROM assign WHERE vid=".$vid."");
while($row2=mysqli_fetch_array($result2))
	{
	$cid=$row2['cid'];
	}
/*
======================================
Check for video name availability
======================================
*/
if($vname!=$name)
{
$result=mysqli_query($con,"SELECT * FROM video");
while($row=mysqli_fetch_array($result))
{
if($vname==$row['vname'])
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

$check= mysqli_query($con,"UPDATE video SET vname='".$vname."', vdesc='".$vdesc."', vdate='".$date."', vstatus=".$vstatus." WHERE vid=".$vid."");

$check1= mysqli_query($con,"UPDATE collection SET cdate='".$date."' WHERE cid=".$cid."");

echo "done";

}
}
else
echo "<script>window.location.assign('../?p=error6');</script>";
mysqli_close($con);


?>
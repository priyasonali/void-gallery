<?php

require 'dbconnect.php';


$cid = mysqli_real_escape_string($con,$_POST["cid"]);
$vname = mysqli_real_escape_string($con,$_POST["vname"]);
$vdesc =  mysqli_real_escape_string($con,$_POST["vdesc"]); 
$vcode =  mysqli_real_escape_string($con,$_POST["vcode"]); 

$vdate = date("d/m/y"); 
$deny=0;

/*
======================================
Check for video name availability
======================================
*/

$result=mysqli_query($con,"SELECT * FROM video");
while($row=mysqli_fetch_array($result))
	{
		if($vcode==$row['vcode'] || $vname==$row['vname'])
		{
			$deny+=1;
		}
	}


if($deny>=1)
	{
		echo "exists";
	}
else
	{
		$check= mysqli_query($con,"INSERT INTO video (vcode, vname, vdesc, vdate) VALUES ('".$vcode."','".$vname."','".$vdesc."', '".$vdate."')");
		$check1= mysqli_query($con,"UPDATE collection SET cdate='".$vdate."' WHERE cid=".$cid."");
		$result1 = mysqli_query($con,"SELECT * FROM video WHERE vcode='".$vcode."' ");
		while($ro = mysqli_fetch_array($result1))
			{
			
			$vid = $ro['vid'];
			}
		mysqli_query($con,"INSERT INTO assign(cid,vid) VALUES (".$cid.",".$vid.")");
		echo "done";
	}
mysqli_close($con);
?>

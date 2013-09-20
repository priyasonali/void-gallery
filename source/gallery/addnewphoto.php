<?php
require 'dbconnect.php';


$cid = mysqli_real_escape_string($con,$_POST["cid"]);
$pname = mysqli_real_escape_string($con,$_POST["pname"]);
$pdesc =  mysqli_real_escape_string($con,$_POST["pdesc"]); 
$pcode =  mysqli_real_escape_string($con,$_POST["pcode"]); 

$vdate = date("d/m/y"); 
$deny=0;

/*
======================================
Check for photo name availability
======================================
*/

$result=mysqli_query($con,"SELECT * FROM photo");
while($row=mysqli_fetch_array($result))
	{
		if($pname==$row['pname'])
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
		$check= mysqli_query($con,"INSERT INTO photo (pcode, pname, pdesc, pdate) VALUES ('".$pcode."','".$pname."','".$pdesc."', '".$pdate."')");
		$check1= mysqli_query($con,"UPDATE collection SET cdate='".$pdate."' WHERE cid=".$cid."");
		$result1 = mysqli_query($con,"SELECT * FROM photo WHERE pcode='".$pcode."' ");
		while($ro = mysqli_fetch_array($result1))
			{
			
			$pid = $ro['pid'];
			}
		mysqli_query($con,"INSERT INTO assign(cid,pid) VALUES (".$cid.",".$pid.")");
		echo "done";
	}
mysqli_close($con);
?>

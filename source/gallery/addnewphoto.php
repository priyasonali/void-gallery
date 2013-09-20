<?php
require 'dbconnect.php';


$cid = mysqli_real_escape_string($con,$_POST["cid"]);
$pname = mysqli_real_escape_string($con,$_POST["pname"]);
$pdesc =  mysqli_real_escape_string($con,$_POST["pdesc"]); 
$pcode =  mysqli_real_escape_string($con,$_POST["pcode"]); 

$pdate = date("d/m/y"); 
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
		$check1= mysqli_query($con,"INSERT INTO photo (pcode, pname, pdesc, pdate) VALUES ('".$pcode."','".$pname."','".$pdesc."', '".$pdate."')");
		$check2= mysqli_query($con,"UPDATE collection SET cdate='".$pdate."' WHERE cid=".$cid."");
		$check3 = mysqli_query($con,"SELECT * FROM photo WHERE pcode='".$pcode."' ");
		while($ro = mysqli_fetch_array($check3))
			{
			
			$pid = $ro['pid'];
			}
		$check4 = mysqli_query($con,"INSERT INTO assign(cid,pid) VALUES (".$cid.",".$pid.")");
		
		
		$chk = 0;
		$check5 = mysqli_query($con,"SELECT * FROM assign WHERE pid='".$pid."' ");
		while($chk == 0){
			while($ro1 = mysqli_fetch_array($check5))
				{
					$chk = 1;
				}
		}
		
		echo "done";
	}
mysqli_close($con);
?>

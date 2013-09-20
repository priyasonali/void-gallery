<?php
	require 'dbconnect.php';
	$pid = mysqli_real_escape_string($con,$_POST["pid"]);
	$vid = mysqli_real_escape_string($con,$_POST["vid"]);
	if($pid!=0)
	{
	$result1=mysqli_query($con,"SELECT * FROM photo WHERE pid=".$pid."");
		while($row1=mysqli_fetch_array($result1))
		{
			$view=$row1['pview'];
		}
		$view++;
	mysqli_query($con,"UPDATE photo SET pview=".$view." WHERE pid=".$pid."");
	}
	if($vid!=0)
	{
	$result1=mysqli_query($con,"SELECT * FROM video WHERE vid=".$vid."");
		while($row1=mysqli_fetch_array($result1))
		{
			$vview=$row1['vview'];
		}
		$vview++;
	mysqli_query($con,"UPDATE video SET vview=".$vview." WHERE vid=".$vid."");
	}
?>
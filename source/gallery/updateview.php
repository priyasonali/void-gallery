<?php
	require 'dbconnect.php';
		$pid = mysqli_real_escape_string($con,$_POST["pid"]);
		$result1=mysqli_query($con,"SELECT * FROM photo WHERE pid=".$pid."");
			while($row1=mysqli_fetch_array($result1))
			{
				$view=$row1['pview'];
			}
			$view++;
		mysqli_query($con,"UPDATE photo SET pview=2 WHERE pid=".$pid."");
		echo $view;
?>
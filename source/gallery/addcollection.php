<?php

/* Including Database Connection File */
require 'dbconnect.php';

/* Getting all values */
$cname = mysqli_real_escape_string($con,$_POST["cname"]);
$cdesc =  mysqli_real_escape_string($con,$_POST["cdesc"]); 
$date = date("d/m/y"); 
$deny=0;

/*
======================================
Check for collection name availability
======================================
*/

$result=mysqli_query($con,"SELECT * FROM collection");
while($row=mysqli_fetch_array($result))
{
if($cname==$row['cname'])
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

/* Inserting data in table*/
$check= mysqli_query($con,"INSERT INTO collection (cname, cdesc, cdate) VALUES ('".$cname."','".$cdesc."', '".$date."')");
echo "done";


}


mysqli_close($con);


?>

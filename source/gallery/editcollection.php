<?php

require 'dbconnect.php';


$cid = mysqli_real_escape_string($con,$_POST["cid"]);
$cname = mysqli_real_escape_string($con,$_POST["cname"]);
$cdesc = mysqli_real_escape_string($con,$_POST["cdesc"]); 
$date = date("dd/mm/yy"); 
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
$check= mysqli_query($con,"UPDATE collection SET cname='".$cname."', cdesc='".$cdesc."', cdate='".$date."' WHERE cid=".$cid."");
echo "done";


}


mysqli_close($con);


?>

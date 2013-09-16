<?php
require 'dbconnect.php';


$cid = mysqli_real_escape_string($con,$_POST["cid"]);
$cname = mysqli_real_escape_string($con,$_POST["cname"]);
$cdesc = mysqli_real_escape_string($con,$_POST["cdesc"]); 
$date = date("d/m/y"); 
$deny=0;


$result1=mysqli_query($con,"SELECT * FROM collection WHERE cid=".$cid."");
while($row1=mysqli_fetch_array($result1))
{
$name=$row1['cname'];
}
/*
======================================
Check for collection name availability
======================================
*/
if($cname!=$name)
{
$result=mysqli_query($con,"SELECT * FROM collection");
while($row=mysqli_fetch_array($result))
{
if($cname==$row['cname'])
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
$check= mysqli_query($con,"UPDATE collection SET cname='".$cname."', cdesc='".$cdesc."', cdate='".$date."' WHERE cid=".$cid."");
echo "done";


}


mysqli_close($con);


?>
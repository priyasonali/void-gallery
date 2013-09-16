<?php

//====================
//Database Information
//====================

$dbhost = "localhost";
$dbusr = "root";
$dbpass = "";
$dbname = "gallery";


//======================
//Connecting to database
//======================

$con = mysqli_connect($dbhost,$dbusr,$dbpass,$dbname);
if (!$con)
{
die('Could not connect: ' . mysqli_error());
}

?>
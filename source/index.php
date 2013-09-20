<?php
session_start();
/*
Default theme can be set here.
If not set, the default theme will fallback to "light".
$theme="dark";
*/
?>

<!DOCTYPE html>
<html lang="en">

<head>

<!--meta data-->
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="charset" value="utf-8">
<meta name="author" value="Void Informatics">
<meta name="copyright" value="Void Informatics">

<!--title-->
<title>Void Gallery</title>

<!--initializing void gallery-->
<?php require "gallery/initgallery.php"; ?>

</head>

<body>

<header>
	<nav class="navbar navbar-inverse navbar-static-top">
		<div class="container">
		<a class="navbar-brand pull-left" href="#">Void Gallery</a>
		<p class="navbar-text pull-right hidden-xs">By <a href="http://voidinformatics.com" target="_blank">Void Informatics</a></p> 
		</div>
	</nav>
</header>

<!--initializing void gallery - collection view-->
<?php require "gallery/gallerycontroller.php"; ?>

<!--finalizing void gallery-->
<?php require "gallery/fingallery.php"; ?>

</body>
</html>
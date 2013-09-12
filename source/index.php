<!doctype html>
<html lang="en">
<head>
<!--meta data-->
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="charset" value="utf-8">
<meta name="author" value="Void Informatics">
<meta name="copyright" value="Void Informatics">
<!--title-->
<title>Simple Photo Gallery</title>
<!--dependencies-->
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
<link rel="stylesheet" href="css/style.css">
<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script src="js/main.js"></script>
</head>
<body>

<header>
	<nav class="navbar navbar-inverse navbar-static-top">
		<div class="container">
		<a class="navbar-brand pull-left" href="#">Simple Photo Gallery</a>
		<p class="navbar-text pull-right">By <a href="http://voidinformatics.com" target="_blank">Void Informatics</a></p> 
		</div>
	</nav>
</header>

<section class="container">
	<div class="page-header">
		<h1>Collections <a class="addCollection" href="#"><span class="glyphicon glyphicon-plus-sign"></span></a></h1>
	</div>
			<p class="lead"></p>
			<p></p>

</section>


<section class="modal fade" id="systemModal" tabindex="-1" role="dialog" aria-labelledby="systemLabel" aria-hidden="true">
	<div class="modal-dialog">
	  <div class="modal-content">
		<div class="modal-header">
		  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		  <h4 class="modal-title">Modal title</h4>
		</div>
		<div class="modal-body">
		  ...
		</div>
		<div class="modal-footer">
		  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		  <button type="button" class="btn btn-primary">Save changes</button>
		</div>
	  </div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</section><!-- /.modal -->


</body>
</html>
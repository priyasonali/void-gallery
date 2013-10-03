Void Gallery
============

A Bootstrap based simple yet elegant PHP gallery application with collection based photo and video management.

Features
--------

- AJAX powered photos upload.
- Thumbnail generation by image cropping and not auto so that the desired part of the photo can be set as thumbnail.
- Youtube based video management.
- Both photos and videos can be grouped into a single collection.
- Unlimited collections, photos, videos can be added.
- Bold thumbnails (200x200) layed out in 3 rows of 4 items each. Powerful auto pagination.
- Lightbox viewing of individual photos and videos.
- Mouse as well as keyboard navigation for photos/videos in a collection.
- Collections or individual photos and videos can be hidden from the visitors.
- Integrated Admin interface. No separate Admin module. Manage the gallery as you browse.
- 20 chars. names. 420 chars. descriptions for collections. 140 chars. descriptions for photos and videos.
- Bootstrap based fully responsive layout.
- Very easy installation. Can be integrated into any website or web application by adding only a few lines of PHP.
- Fast and sturdy system with support for themes. Currently two themes available : light and dark


Installation
------------

1. Add the directory named "gallery" to the root of your website or web application.
2. Import "sqldump/gallery.sql" from your phpMyAdmin home.
3. In the page where you want to add the gallery, add the following code :-
	- At the very top of the page : `<?php session_start(); ?>`.
	- Anywhere inside the `<head></head>` tags : `<?php require initgallery.php; ?>`.
	- Anywhere inside the `<body></body>` tags : `<?php require gallerycontroller.php; ?>`.  
	__Note:__ _Place the above code as a direct child of the `<body></body>` tags and not inside any other DOM element, wrapper or container inside the body._
	- Just before the closing `</body>` tag : `<?php require fingallery.php; ?>`.
4. Edit "gallery/dbconnect.php" to add your specific database information.
5. Edit "gallery/authenticate.php" to set your own password. _Default: "void"_

__Note__: _The page where you decide to add the gallery must have a_ __.php__ _extension and must be present at the same directory level as that of the "gallery" folder (preferably your webroot)_

Now you can login to your gallery by following the url: `http://yourdomain.com/your-gallery-page.php?p=initadmin`
Your gallery will be available to visitors for viewing at `http://yourdomain.com/your-gallery-page.php`

Theme
-----

The system currently supports 2 themes : __light__ and __dark__  
By default the __light__ theme is activated. If you want to view the _Collections, Photos, Videos_ listing pages in the
__dark__ theme, just add `$theme = "dark"` to the first php tags at the top of your gallery page, i.e, instead of
`<?php session_start(); ?>` in the top line, add `<?php session_start(); $theme="dark"; ?>`


About _initgallery.php_ & _fingallery.php_
-------------------------------------------

For your information, __initgallery.php__ & __fingallery.php__ initialize the following stylesheet and script dependencies respectively. 
If you are using any of them in your website or web app, then you need not declare them again:-

	<!--stylesheets-->

	<!--[1] bootstrap-->
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" type="text/css" media="screen">

	<!--[2] fancybox-->
	<link rel="stylesheet" href="gallery/js/fancybox/jquery.fancybox.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="gallery/js/fancybox/helpers/jquery.fancybox-buttons.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="gallery/js/fancybox/helpers/jquery.fancybox-thumbs.css" type="text/css" media="screen" />

	<!--[3] jcrop-->
	<link rel="stylesheet" href="gallery/js/jcrop/css/jquery.Jcrop.min.css" type="text/css" media="screen" />
	
	<!--scripts (placed at the end for faster page loading)-->

	<!--[1] jquery-->
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.10.1.min.js"></script>

	<!--[2] bootstrap-->
	<script type="text/javascript" src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>

	<!--[3] fancybox and helpers-->
	<script type="text/javascript" src="gallery/js/fancybox/helpers/jquery.mousewheel-3.0.6.pack.js"></script>
	<script type="text/javascript" src="gallery/js/fancybox/jquery.fancybox.pack.js"></script>
	<script type="text/javascript" src="gallery/js/fancybox/helpers/jquery.fancybox-buttons.js"></script>
	<script type="text/javascript" src="gallery/js/fancybox/helpers/jquery.fancybox-media.js"></script>
	<script type="text/javascript" src="gallery/js/fancybox/helpers/jquery.fancybox-thumbs.js"></script>

	<!--[4] blueimp jquery-ajax file upload-->
	<script src="gallery/js/ajaxupload/jquery.ui.widget.js"></script>
	<script src="gallery/js/ajaxupload/jquery.iframe-transport.js"></script>
	<script src="gallery/js/ajaxupload/jquery.fileupload.js"></script>


	<!--[5] jcrop-->
	<script src="gallery/js/jcrop/js/jquery.color.js"></script>
	<script src="gallery/js/jcrop/js/jquery.Jcrop.min.js"></script>


Authors
-------

[Santak Kumar Mishra](mailto:admin@voidinformatics.com)  
[Sonali Priya](mailto:sonali@voidinformatics.com)

Developed at: [Void Informatics](http://voidinformatics.com)

Copyright and license
---------------------

Copyright 2013 [Void Informatics](http://voidinformatics.com), Inc under [The MIT License (MIT)](LICENSE).

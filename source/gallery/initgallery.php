<?phpif(!empty($_REQUEST['theme'])){$theme=$_REQUEST['theme'];}else{if(!isset($theme))$theme="light";}$stylesheet = "gallery/css/void.gallery.".$theme.".css";if(!file_exists($stylesheet)){$theme="light";}?><!--stylesheets--><!--[1] bootstrap--><link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" type="text/css" media="screen"><!--[2] fancybox--><link rel="stylesheet" href="gallery/js/fancybox/jquery.fancybox.css" type="text/css" media="screen" /><link rel="stylesheet" href="gallery/js/fancybox/helpers/jquery.fancybox-buttons.css" type="text/css" media="screen" /><link rel="stylesheet" href="gallery/js/fancybox/helpers/jquery.fancybox-thumbs.css" type="text/css" media="screen" /><!--[3]  voidgallery--><?phpecho '<link rel="stylesheet" href="gallery/css/void.gallery.'.$theme.'.css" type="text/css" media="screen">';?>
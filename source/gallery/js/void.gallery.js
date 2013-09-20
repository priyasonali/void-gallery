//============
//Begin Script
$(function(){
//============


//===================
//declaring variables
//===================
$alphaNumericPattern = /^[0-9A-Za-z\s]+$/;

//===============================
//declaring functions and plugins
//===============================
$(".hideBtn").on("click",
function()
{
	$(".systemAlert").hide();
});
		
		
//dependency function for jcrop
function updateCoords(c)
	{
	$('#x').val(c.x);
	$('#y').val(c.y);
	$('#w').val(c.w);
	$('#h').val(c.h);
	};

//adding callback to $().html() function
$.fn.htmlOriginal = $.fn.html;
$.fn.html = function(html,callback){
  this.htmlOriginal(html);
  if(typeof callback == "function"){
    callback();
  }
}

//preparing DOM elements
$(".uploadProgress .progress-bar").hide();

//initializing fancybox for photos
$(".fancybox").fancybox({
		openEffect	: 'elastic',
    	closeEffect	: 'elastic',

    	helpers : {
    		title : {
    			type : 'float'
    		}
    	}
});

//initializing fancybox for videos
$('.fancybox-media').fancybox({
		openEffect  : 'none',
		closeEffect : 'none',
		helpers : {
			media : {}
		}
	});


//initializing blueimp jquery-ajax-upload for file uploads
$('#itemUpload').fileupload({
		//var cid = $(this).attr('data-cid');
		//formData: {cid: cid},
        dataType: 'html',
		add: function (e, data) {
            $(this).hide();
            data.submit();
        },
		progressall: function (e, data) {
        var progress = parseInt(data.loaded / data.total * 100, 10);
			$('.uploadProgress .progress-bar').show().css(
				'width',
				progress + '%'
			);
		},
        done: function (e, data) {
			$('.photoUpload .row:first-child').html(data.result);
			//initializing jcrop
			$('#cropbox').Jcrop({
				aspectRatio: 1,
				onSelect: updateCoords
			});

			$('.uploadSubmit').on("click",function(){
				imgsrc=$("#picsrc").val();
				x = $("#x").val();
				y = $("#y").val();
				w = $("#w").val();
				h = $("#h").val();
				if(x=="")
				{
				alert("Please make a selection to crop.");
				}
				else{
				$(this).attr("disabled","disabled").text("Cropping Photo..");
				$.post("gallery/crop.php",
				{
				x:x,
				y:y,
				w:w,
				h:h,
				picsrc:imgsrc
				},function(data,status){
				$('.photoUpload .row:first-child').html(data);
				/*
				setTimeout(function(){
				window.location.assign("#");
				},3000);
				*/

				});
				}
			});
		},
    });
	

//handling DOM events

//add new collection
$(".addCollection").on("click",function(e) {
	e.preventDefault();
	$("#systemModal .modal-title").text("New Collection");
	$("#systemModal .modal-body").html("\
	<form role='form'>\
		  <div class='form-group'>\
			<label for='collectionName'>Name</label>\
			<input type='text' class='form-control' id='collectionName' placeholder='Collection Name'>\
		  </div>\
		  <div class='form-group'>\
			<label for='collectionDesc'>Description</label>\
			<textarea class='form-control' id='collectionDesc' rows='5' placeholder='Collection Description'></textarea>\
		  </div>\
	  </form>\
	  <div class='alert alert-dismissable systemModalAlert'>\
		  <button type='button' class='close hideBtn'>&times;</button>\
		  <h3 class='alertHead'></h3><p class='alertBody'></p>.\
	  </div>\
	", 
	function()
	{
		$(".systemModalAlert").hide();
		$(".hideBtn").on("click",
		function()
		{
			$(".systemModalAlert").hide();
		});
	});
	
	$("#systemModal .modal-footer").html("\
		<button type='button' class='btn btn-primary addCollectionBtn'>Add Collection</button>\
	",
	function()
	{
		$(".addCollectionBtn").on("click",function() {
			var cname = $("#collectionName").val();
			var cdesc = $("#collectionDesc").val();
			//validation
			if(cname == 0 || cdesc == 0)
			{
				$(".systemModalAlert .alertHead").text("Empty Field");
				$(".systemModalAlert .alertBody").html("Both <em>Name</em> and <em>Description</em> of your new collection are required.");
				$(".systemModalAlert").removeClass("alert-success").addClass("alert-danger").show();
			}
			else if(cname.length > 20)
			{
				$(".systemModalAlert .alertHead").text("Invalid Name Length");
				$(".systemModalAlert .alertBody").html("<em>Name</em> can be max. 20 characters in length.");
				$(".systemModalAlert").removeClass("alert-success").addClass("alert-danger").show();
			}
			else if(cdesc.length > 420)
			{
				$(".systemModalAlert .alertHead").text("Invalid Description Length");
				$(".systemModalAlert .alertBody").html("<em>Description</em> can be max. 420 characters in length.");
				$(".systemModalAlert").removeClass("alert-success").addClass("alert-danger").show();
			}
			else if(!cname.match($alphaNumericPattern))
			{
				$(".systemModalAlert .alertHead").text("Invalid Input");
				$(".systemModalAlert .alertBody").html("<em>Name</em> must be alphanumeric. No special characters or symbols allowed.");
				$(".systemModalAlert").removeClass("alert-success").addClass("alert-danger").show();
			}
			else
			{
				$(".addCollectionBtn").attr('disabled','disabled');
				$(".systemModalAlert .alertHead").html("Processing");
				$(".systemModalAlert .alertBody").html("Please wait...");
				$(".systemModalAlert").removeClass("alert-danger").addClass("alert-success").show();
				$.post('gallery/addcollection.php',
				{
					cname:cname,
					cdesc:cdesc
				},
				function(data,status){
					if(data == "exists")
					{
						$(".systemModalAlert .alertHead").text("Invalid Name");
						$(".systemModalAlert .alertBody").html("A collection with <em>Name</em>: <em>"+cname+"</em> already exists ! Try again with a different <em>Name</em>.");
						$(".systemModalAlert").removeClass("alert-success").addClass("alert-danger").show();
						$(".addCollectionBtn").removeAttr('disabled');
					}
					else if(data == "done")
					{
						$(".systemModalAlert .alertHead").html("Collection Added !");
						$(".systemModalAlert .alertBody").html("A collection with <em>Name</em>: <em>"+cname+"</em> has been successfully created for you. Now reloading...");
						$(".systemModalAlert").removeClass("alert-danger").addClass("alert-success").show();
						setTimeout(function(){window.location.reload("")},1000);
					}
					else
					{
						$(".systemModalAlert .alertHead").html("Unexpected Error");
						$(".systemModalAlert .alertBody").html("An unexpected error has occurred which the Gallery Controller could not handle.\
						Please retry or contact the administrator.");
						$(".systemModalAlert").removeClass("alert-success").addClass("alert-danger").show();
						$(".addCollectionBtn").removeAttr('disabled');
					}
				});
			}
		});
	});
	$("#systemModal").modal();
});

//edit collection
$(".editCollection").on("click",function(e) {
	e.preventDefault();
	var cname = $(this).attr("data-cname");
	var cdesc = $(this).attr("data-cdesc");
	var cstatus = $(this).attr("data-cstatus");
	var cid = $(this).attr("data-cid");
	if(cstatus == 1)
	{
		var appendCode = "\
			<div class='form-group'>\
				<label for='collectionStatus'>Status </label>\
				<input type='radio' class='statusIndicator' name='statusIndicator' value='1' checked> Visible\
				<input type='radio' class='statusIndicator' name='statusIndicator' value='0'> Hidden\
			 </div>";
	}
	else
	{
		var appendCode = "\
			<div class='form-group'>\
				<label>Status</label>\
				<input type='radio' class='statusIndicator' name='statusIndicator' value='1'> Visible\
				<input type='radio' class='statusIndicator' name='statusIndicator' value='0' checked> Hidden\
			 </div>";
	}
	$("#systemModal .modal-title").text("Edit Collection");
	$("#systemModal .modal-body").html("\
	<form role='form'>\
		  <div class='form-group'>\
			<label for='collectionName'>Name</label>\
			<input type='text' class='form-control' id='collectionName' value='"+cname+"' placeholder='Collection Name'>\
		  </div>\
		  <div class='form-group'>\
			<label for='collectionDesc'>Description</label>\
			<textarea class='form-control' id='collectionDesc' rows='5' placeholder='Collection Description'>"+cdesc+"</textarea>\
		  </div>"+appendCode+"\
	  </form>\
	  <div class='alert alert-dismissable systemModalAlert'>\
		  <button type='button' class='close hideBtn'>&times;</button>\
		  <h3 class='alertHead'></h3><p class='alertBody'></p>.\
	  </div>\
	", 
	function()
	{
		$(".systemModalAlert").hide();
		$(".statusIndicator").on("click",
		function()
		{	
			cstatus = $(this).val();
		});
		$(".hideBtn").on("click",
		function()
		{
			$(".systemModalAlert").hide();
		});
	});
	
	$("#systemModal .modal-footer").html("\
		<button type='button' class='btn btn-primary editCollectionBtn'>Update</button>\
	",
	function()
	{
		$(".editCollectionBtn").on("click",function() {
			cname = $("#collectionName").val();
			cdesc = $("#collectionDesc").val();
			//validation
			if(cname == 0 || cdesc == 0)
			{
				$(".systemModalAlert .alertHead").text("Empty Field");
				$(".systemModalAlert .alertBody").html("Both <em>Name</em> and <em>Description</em> of your collection are required.");
				$(".systemModalAlert").removeClass("alert-success").addClass("alert-danger").show();
			}
			else if(cname.length > 20)
			{
				$(".systemModalAlert .alertHead").text("Invalid Name Length");
				$(".systemModalAlert .alertBody").html("<em>Name</em> can be max. 20 characters in length.");
				$(".systemModalAlert").removeClass("alert-success").addClass("alert-danger").show();
			}
			else if(cdesc.length > 420)
			{
				$(".systemModalAlert .alertHead").text("Invalid Description Length");
				$(".systemModalAlert .alertBody").html("<em>Description</em> can be max. 420 characters in length.");
				$(".systemModalAlert").removeClass("alert-success").addClass("alert-danger").show();
			}
			else if(!cname.match($alphaNumericPattern))
			{
				$(".systemModalAlert .alertHead").text("Invalid Input");
				$(".systemModalAlert .alertBody").html("<em>Name</em> must be alphanumeric. No special characters or symbols allowed.");
				$(".systemModalAlert").removeClass("alert-success").addClass("alert-danger").show();
			}
			else
			{
				$(".editCollectionBtn").attr('disabled','disabled');
				$(".systemModalAlert .alertHead").html("Processing");
				$(".systemModalAlert .alertBody").html("Please wait...");
				$(".systemModalAlert").removeClass("alert-danger").addClass("alert-success").show();
				$.post('gallery/editcollection.php',
				{
					cid:cid,
					cname:cname,
					cdesc:cdesc,
					cstatus:cstatus					
				},
				function(data,status){
					if(data == "exists")
					{
						$(".systemModalAlert .alertHead").text("Invalid Name");
						$(".systemModalAlert .alertBody").html("A collection with <em>Name</em>: <em>"+cname+"</em> already exists ! Try again with a different <em>Name</em>.");
						$(".systemModalAlert").removeClass("alert-success").addClass("alert-danger").show();
						$(".editCollectionBtn").removeAttr('disabled');
					}
					else if(data == "done")
					{
						$(".systemModalAlert .alertHead").html("Collection Updated !");
						$(".systemModalAlert .alertBody").html("Your collection has been successfully updated. Now reloading...");
						$(".systemModalAlert").removeClass("alert-danger").addClass("alert-success").show();
						setTimeout(function(){window.location.reload("")},1000);
					}
					else
					{
						$(".systemModalAlert .alertHead").html("Unexpected Error");
						$(".systemModalAlert .alertBody").html("An unexpected error has occurred which the Gallery Controller could not handle.\
						Please retry or contact the administrator.");
						$(".systemModalAlert").removeClass("alert-success").addClass("alert-danger").show();
						$(".editCollectionBtn").removeAttr('disabled');
					}
				});
			}
		});
	});
	$("#systemModal").modal();
});

//add items to collection
$(".addToCollection").on("click",function(e) {
	e.preventDefault();
	var cid = $(this).attr("data-cid");
	$("#systemModal .modal-title").text("Add Item");
	$("#systemModal .modal-body").html("\
		<div class='row'>\
		<div class='col-md-6 text-center'>\
			<a class='addPhotoLink' href='?p=initupload&cid="+cid+"'><img src='gallery/img/photo.png' width='150px' height='150px' alt='add photo'/></a>\
			<p class = 'lead'>Add Photo</p>\
		</div>\
		<div class='col-md-6 text-center'>\
			<a class='addVideoLink' href='?p=addvideo&cid="+cid+"'><img src='gallery/img/video.png' width='150px' height='150px' alt='add video'/></a>\
			<p class = 'lead'>Add Video</p>\
		</div>\
		</div>\
	");
	
	$("#systemModal .modal-footer").html("\
		<button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>\
	");
	
	$("#systemModal").modal();
});

//delete collection
$(".deleteCollection").on("click",function(e) {
	e.preventDefault();
	var cid = $(this).attr("data-cid");
	$("#systemModal .modal-title").text("Delete Collection");
	$("#systemModal .modal-body").html("<p class='text-danger lead'>Are you sure ?</p><p class='text-danger'>Deleting \
	this collection will delete all its contents including added photos and videos !</p>");
	
	$("#systemModal .modal-footer").html("\
		<button type='button' class='btn btn-default deleteDialogCloseBtn' data-dismiss='modal'>No</button>\
		<button type='button' class='btn btn-danger deleteCollectionBtn'>Yes</button>\
	",
	function()
	{
		$(".deleteCollectionBtn").on("click",function(){
			$(".deleteDialogCloseBtn").attr('disabled','disabled');
			$(".deleteCollectionBtn").attr('disabled','disabled');
			$.post('gallery/deletecollection.php',
				{
					cid:cid,					
				},
				function(data,status)
				{
					if(data == "done")
					{
						$("#systemModal .modal-body").html("<p class='text-success'>Your collection has been deleted successfully. Standby for reload...</p>");
						setTimeout(function(){window.location.reload()},1000);
					}
					else
					{
						$("#systemModal .modal-title").html("<h3 class='text-danger'>Unexpected Error</h3>");
						$("#systemModal .modal-body").html("<p class='text-danger'>An unexpected error has occurred which the Gallery Controller could not handle.\
						Please retry or contact the administrator.</p>");
						$("#systemModal .modal-footer").html("<button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>");
					}
				});
		});	
	});
	
	$("#systemModal").modal();
});

//add video
$(".videoUrl").on("blur",function() {
	if($("#videoUrl1").val() != 0)
	var videoCode = $("#videoUrl1").val();
	else
	var videoCode = "YE7VzlLtp-4";
	$(".showVideo").attr("src","//www.youtube.com/embed/"+videoCode);
});

$(".addVideoBtn").on("click",
	function()
	{
	if($("#videoUrl2").val() != 0)
	var vcode = $("#videoUrl2").val();
	else
	var vcode = $("#videoUrl1").val();
	var vname = $("#videoName").val();
	var vdesc = $("#videoDesc").val();
	var cid = $(this).attr("data-cid");
			//validation
			if(vname == 0 || vdesc == 0 || vcode == 0)
			{
				$(".systemAlert .alertHead").text("Empty Field");
				$(".systemAlert .alertBody").html("<em>Video Code</em>, <em>Name</em> and <em>Description</em> are all required fields. They cannot be left blank.");
				$(".systemAlert").removeClass("alert-success").addClass("alert-danger").show();
			}
			else if(vname.length > 20)
			{
				$(".systemAlert .alertHead").text("Invalid Name Length");
				$(".systemAlert .alertBody").html("<em>Name</em> can be max. 20 characters in length.");
				$(".systemAlert").removeClass("alert-success").addClass("alert-danger").show();
			}
			else if(vdesc.length > 140)
			{
				$(".systemAlert .alertHead").text("Invalid Description Length");
				$(".systemAlert .alertBody").html("<em>Description</em> can be max. 140 characters in length.");
				$(".systemAlert").removeClass("alert-success").addClass("alert-danger").show();
			}
			else if(!vname.match($alphaNumericPattern))
			{
				$(".systemAlert .alertHead").text("Invalid Input");
				$(".systemAlert .alertBody").html("<em>Name</em> must be alphanumeric. No special characters or symbols allowed.");
				$(".systemAlert").removeClass("alert-success").addClass("alert-danger").show();
			}
			else
			{
				$(".addVideoBtn").attr('disabled','disabled');
				$(".systemAlert .alertHead").html("Processing");
				$(".systemAlert .alertBody").html("Please wait...");
				$(".systemAlert").removeClass("alert-danger").addClass("alert-success").show();
				$.post('gallery/addnewvideo.php',
				{
					cid:cid,
					vname:vname,
					vdesc:vdesc,
					vcode:vcode					
				},
				function(data,status){
					if(data == "exists")
					{
						$(".systemAlert .alertHead").text("Invalid Name");
						$(".systemAlert .alertBody").html("A video with the given name or code already exists !");
						$(".systemAlert").removeClass("alert-success").addClass("alert-danger").show();
						$(".addVideoBtn").removeAttr('disabled');
					}
					else if(data == "done")
					{
						$(".systemAlert .alertHead").html("Video Added !");
						$(".systemAlert .alertBody").html("Your video has been successfully added. Now redirecting...");
						$(".systemAlert").removeClass("alert-danger").addClass("alert-success").show();
						setTimeout(function(){window.location.assign("?p=initvideo&cid="+cid)},1000);
					}
					else
					{
						$(".systemAlert .alertHead").html("Unexpected Error");
						$(".systemAlert .alertBody").html("An unexpected error has occurred which the Gallery Controller could not handle.\
						Please retry or contact the administrator.");
						$(".systemAlert").removeClass("alert-success").addClass("alert-danger").show();
						$(".addVideoBtn").removeAttr('disabled');
					}
				});
			}
	
});

//edit video
$(".editVideo").on("click",function(e) {
	e.preventDefault();
	var vname = $(this).attr("data-vname");
	var vdesc = $(this).attr("data-vdesc");
	var vstatus = $(this).attr("data-vstatus");
	var vid = $(this).attr("data-vid");
	if(vstatus == 1)
	{
		var appendCode = "\
			<div class='form-group'>\
				<label for='statusIndicator'>Status </label>\
				<input type='radio' class='statusIndicator' name='statusIndicator' value='1' checked> Visible\
				<input type='radio' class='statusIndicator' name='statusIndicator' value='0'> Hidden\
			 </div>";
	}
	else
	{
		var appendCode = "\
			<div class='form-group'>\
				<label for='statusIndicator'>Status</label>\
				<input type='radio' class='statusIndicator' name='statusIndicator' value='1'> Visible\
				<input type='radio' class='statusIndicator' name='statusIndicator' value='0' checked> Hidden\
			 </div>";
	}
	$("#systemModal .modal-title").text("Edit Video");
	$("#systemModal .modal-body").html("\
	<form role='form'>\
		  <div class='form-group'>\
			<label for='videoName'>Name</label>\
			<input type='text' class='form-control' id='videoName' value='"+vname+"' placeholder='Video Name'>\
		  </div>\
		  <div class='form-group'>\
			<label for='collectionDesc'>Description</label>\
			<textarea class='form-control' id='videoDesc' rows='5' placeholder='Video Description'>"+vdesc+"</textarea>\
		  </div>"+appendCode+"\
	  </form>\
	  <div class='alert alert-dismissable systemModalAlert'>\
		  <button type='button' class='close hideBtn'>&times;</button>\
		  <h3 class='alertHead'></h3><p class='alertBody'></p>.\
	  </div>\
	", 
	function()
	{
		$(".systemModalAlert").hide();
		$(".statusIndicator").on("click",
		function()
		{	
			vstatus = $(this).val();
		});
		$(".hideBtn").on("click",
		function()
		{
			$(".systemModalAlert").hide();
		});
	});
	
	$("#systemModal .modal-footer").html("\
		<button type='button' class='btn btn-primary editVideoBtn'>Update</button>\
	",
	function()
	{
		$(".editVideoBtn").on("click",function() {
			vname = $("#videoName").val();
			vdesc = $("#videoDesc").val();
			//validation
			if(vname == 0 || vdesc == 0)
			{
				$(".systemModalAlert .alertHead").text("Empty Field");
				$(".systemModalAlert .alertBody").html("Both <em>Name</em> and <em>Description</em> of your video are required.");
				$(".systemModalAlert").removeClass("alert-success").addClass("alert-danger").show();
			}
			else if(vname.length > 20)
			{
				$(".systemModalAlert .alertHead").text("Invalid Name Length");
				$(".systemModalAlert .alertBody").html("<em>Name</em> can be max. 20 characters in length.");
				$(".systemModalAlert").removeClass("alert-success").addClass("alert-danger").show();
			}
			else if(vdesc.length > 140)
			{
				$(".systemModalAlert .alertHead").text("Invalid Description Length");
				$(".systemModalAlert .alertBody").html("<em>Description</em> can be max. 140 characters in length.");
				$(".systemModalAlert").removeClass("alert-success").addClass("alert-danger").show();
			}
			else if(!vname.match($alphaNumericPattern))
			{
				$(".systemModalAlert .alertHead").text("Invalid Input");
				$(".systemModalAlert .alertBody").html("<em>Name</em> must be alphanumeric. No special characters or symbols allowed.");
				$(".systemModalAlert").removeClass("alert-success").addClass("alert-danger").show();
			}
			else
			{
				$(".editVideoBtn").attr('disabled','disabled');
				$(".systemModalAlert .alertHead").html("Processing");
				$(".systemModalAlert .alertBody").html("Please wait...");
				$(".systemModalAlert").removeClass("alert-danger").addClass("alert-success").show();
				$.post('gallery/editvideo.php',
				{
					vid:vid,
					vname:vname,
					vdesc:vdesc,
					vstatus:vstatus					
				},
				function(data,status){
					if(data == "exists")
					{
						$(".systemModalAlert .alertHead").text("Invalid Name");
						$(".systemModalAlert .alertBody").html("A video with <em>Name</em>: <em>"+vname+"</em> already exists ! Try again with a different <em>Name</em>.");
						$(".systemModalAlert").removeClass("alert-success").addClass("alert-danger").show();
						$(".editVideoBtn").removeAttr('disabled');
					}
					else if(data == "done")
					{
						$(".systemModalAlert .alertHead").html("Video Updated !");
						$(".systemModalAlert .alertBody").html("Your video has been successfully updated. Now reloading...");
						$(".systemModalAlert").removeClass("alert-danger").addClass("alert-success").show();
						setTimeout(function(){window.location.reload("")},1000);
					}
					else
					{
						$(".systemModalAlert .alertHead").html("Unexpected Error");
						$(".systemModalAlert .alertBody").html("An unexpected error has occurred which the Gallery Controller could not handle.\
						Please retry or contact the administrator.");
						$(".systemModalAlert").removeClass("alert-success").addClass("alert-danger").show();
						$(".editCollectionBtn").removeAttr('disabled');
					}
				});
			}
		});
	});
	$("#systemModal").modal();
});

//delete collection
$(".deleteVideo").on("click",function(e) {
	e.preventDefault();
	var vid = $(this).attr("data-vid");
	$("#systemModal .modal-title").text("Delete Video");
	$("#systemModal .modal-body").html("<p class='text-danger lead'>Are you sure ?</p><p class='text-danger'>Deleting \
	this video will not only remove it from this collection but also permanently discard it !</p>");
	
	$("#systemModal .modal-footer").html("\
		<button type='button' class='btn btn-default deleteDialogCloseBtn' data-dismiss='modal'>No</button>\
		<button type='button' class='btn btn-danger deleteVideoBtn'>Yes</button>\
	",
	function()
	{
		$(".deleteVideoBtn").on("click",function(){
			$(".deleteDialogCloseBtn").attr('disabled','disabled');
			$(".deleteCollectionBtn").attr('disabled','disabled');
			$.post('gallery/deletevideo.php',
				{
					vid:vid,					
				},
				function(data,status)
				{
					if(data == "done")
					{
						$("#systemModal .modal-body").html("<p class='text-success'>Your video has been deleted successfully. Standby for reload...</p>");
						setTimeout(function(){window.location.reload()},1000);
					}
					else
					{
						$("#systemModal .modal-title").html("<h3 class='text-danger'>Unexpected Error</h3>");
						$("#systemModal .modal-body").html("<p class='text-danger'>An unexpected error has occurred which the Gallery Controller could not handle.\
						Please retry or contact the administrator.</p>");
						$("#systemModal .modal-footer").html("<button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>");
					}
				});
		});	
	});
	
	$("#systemModal").modal();
});


//styling helper
$(".collectionView .panel, .photoView .panel, .videoView .panel").on("mouseover",function() {
	$(this).removeClass("panel-default").addClass("panel-primary");
}).on("mouseout",function() {
	$(this).removeClass("panel-primary").addClass("panel-default");
});

//=============
});//End Script
//=============
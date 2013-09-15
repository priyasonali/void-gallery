//============
//Begin Script
$(function(){
//============

//declaring functions
function updateCoords(c)
	{
	$('#x').val(c.x);
	$('#y').val(c.y);
	$('#w').val(c.w);
	$('#h').val(c.h);
	};

//preparing DOM elements
$('.uploadProgress .progress-bar').hide();

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
$(".addCollection").on("click",function(event) {
	event.preventDefault();
	$("#systemModal .modal-body").text("Hello World!");
	$("#systemModal").modal();
});

$(".collectionView .panel, .photoView .panel, .videoView .panel").on("mouseover",function() {
	$(this).removeClass("panel-default").addClass("panel-primary");
}).on("mouseout",function() {
	$(this).removeClass("panel-primary").addClass("panel-default");
});

//=============
});//End Script
//=============
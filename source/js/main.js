//============
//Begin Script
$(function(){
//============

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
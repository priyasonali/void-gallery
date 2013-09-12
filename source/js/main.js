$(function(){

$(".addCollection").on("click",function(event) {
	event.preventDefault();
	$("#systemModal .modal-body").text("Hello World!");
	$("#systemModal").modal();
});

$(".collectionView .panel").on("mouseover",function() {
	$(this).removeClass("panel-default").addClass("panel-primary");
}).on("mouseout",function() {
	$(this).removeClass("panel-primary").addClass("panel-default");
});

});
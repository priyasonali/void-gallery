$(function(){

$(".addCollection").on("click",function(event) {
	event.preventDefault();
	$("#systemModal .modal-body").text("Hello World!");
	$("#systemModal").modal();
});

});
$(document).ready(function(){
	var content = $("#to_bottom").html();
	$("#to_bottom").remove();
	$("#content_bottom").append(content);
	
	console.log(321);
});
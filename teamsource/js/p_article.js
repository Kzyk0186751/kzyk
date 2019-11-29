$(document).ready(function() {
    console.log( "ready!" );
	
	$("#sendMessageButton").click(function(){
			var title = $("#title").val();
			var content = $("#content").val()
			$.ajax({
				type: "POST",
				url:"teamsource/php/post_article.php",
				data:{title:title,content:content},
				success:function(response){
					console.log(response);
				}
			});
	});
});



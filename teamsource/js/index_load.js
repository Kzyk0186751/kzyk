$.ajax({
  type: "POST",
  url:"teamsource/php/getposts.php",
  data:{code:"loadarticles"},
  dataType: "json",
  success: function(response){
	var html = "";
	var arr = response;
	  
	for(var i = 0;i<arr.length;i++){
		
		html += '<div class="post-preview">';
		html += '<form action="article.html" method = "GET">';
        html += '<a href = "article.html?articlebacknumber='+arr[i]['postId']+'" class = "jump_article">';
        html +=     '<h2 class="post-title">'+arr[i]['post_title']+'</h2>';
        //html +=     '<h3 class="post-subtitle"></h3>';
        html +=   '</a></form>';
        html +=   '<p class="post-meta">Posted by <a herf = "#">'+arr[i]['username']+'</a> ';
        html +=   arr[i]['post_date']+'</p>';
        html += '</div>';
        html += '<hr>';
		
		/*$(".jump_article").click(function(){
			var artid = $(this).attr("aid");
			console.log(artid);
			$.ajax({
				type: "POST",
				url:"../boostraped/article.html",
				data:{artid:artid},
				dataType: "json",
				success: function(response){
					  
				}
			});
		});*/
	}
	
	html += '<div class="clearfix">';
    html += '<a class="btn btn-primary float-right" href="#">Older Posts &rarr;</a>';
    html += '</div>';	
	 
	$("#postitems").html(html);  
		
	}
});

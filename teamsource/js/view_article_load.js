$.ajax({
  type: "POST",
  url:"teamsource/php/getarticles.php",
  data:{code:"loadarticles"},
  dataType: "json",
  success: function(response){
	var html = "";
	var arr = response;
	  
	  
	//search functions  
	html += '<div class="active-cyan-3 active-cyan-4 mb-4 row input-group">';
	html += '<input class="form-control w-50" type="text" id = "searchval" placeholder="Search from articles by " aria-label="Search">';

	
	html +='<select name="category" id = "category" class="custom-select w-25">';
    html +='<option id = "category"></option>';
    html +='<option selected value="title">Title</option>';
    html +='<option value="category">Category</option>';
    html +='<option value="username">Poster</option>';
	html +='</select>';
	
	html += '<div class="input-group-append">';
	html += '<button type="button" class="btn btn-secondary h-75" id = "btnsearch">';
	html += '<i class="fas fa-search text-grey" aria-hidden="true"></i></button>';
    html += '</div>';
	  
	html += '</div>';//end tags for search functions 
	
	for(var i = 0;i<arr.length;i++){
		
		html += '<div class="post-preview">';
		html += '<form action="article.html" method = "GET">';
        html += '<a href = "article.html?articlebacknumber='+arr[i]['id']+'" class = "jump_article">';
        html +=     '<h2 class="post-title">'+arr[i]['title']+'</h2>';
        //html +=     '<h3 class="post-subtitle"></h3>';
        html +=   '</a></form>';
        html +=   '<p class="post-meta">Posted by <a herf = "#">'+arr[i]['username']+'</a> ';
        html +=   arr[i]['post_date']+'</p>';
        html += '</div>';
        html += '<hr>';
		
	}
	
	html += '<div class="clearfix">';
    html += '<a class="btn btn-primary float-right" href="#">Older Posts &rarr;</a>';
    html += '</div>';	
	 
	$("#postitems").html(html); 
	
		$(document).on('click','#btnsearch',function(){
			var searchcateg = $("#category").val();
			var searchval = $("#searchval").val();

			$.ajax({
			  type: "POST",
			  url:"teamsource/php/getarticles.php",
			  data:{code:"searcharticles",searchcateg:searchcateg,searchval:searchval},
			  dataType: "json",
			  success: function(response){
				    var shtml = "";
					var sarr = response;
				  	shtml += '<div class="active-cyan-3 active-cyan-4 mb-4 row input-group">';
					shtml += '<input class="form-control w-50" type="text" id = "searchval" placeholder="Search from articles by " aria-label="Search">';

					shtml +='<select name="category" id = "category" class="custom-select w-25">';
					shtml +='<option id = "category"></option>';
					shtml +='<option selected value="title">Title</option>';
					shtml +='<option value="category">Category</option>';
					shtml +='<option value="username">Poster</option>';
					shtml +='</select>';
					
					shtml += '<div class="input-group-append">';
					shtml += '<button type="button" class="btn btn-secondary h-75" id = "btnsearch">';
					shtml += '<i class="fas fa-search text-grey" aria-hidden="true"></i></button>';
					shtml += '</div>';
					  
					shtml += '</div>';//end tags for search functions 
					
					for(var i = 0;i<sarr.length;i++){
						
						shtml += '<div class="post-preview">';
						shtml += '<form action="article.html" method = "GET">';
						shtml += '<a href = "article.html?articlebacknumber='+sarr[i]['id']+'" class = "jump_article">';
						shtml +=     '<h2 class="post-title">'+sarr[i]['title']+'</h2>';
						//html +=     '<h3 class="post-subtitle"></h3>';
						shtml +=   '</a></form>';
						shtml +=   '<p class="post-meta">Posted by <a herf = "#">'+sarr[i]['username']+'</a> ';
						shtml +=   sarr[i]['post_date']+'</p>';
						shtml += '</div>';
						shtml += '<hr>';
						
					}
					
					shtml += '<div class="clearfix">';
					shtml += '<a class="btn btn-primary float-right" href="#">Older Posts &rarr;</a>';
					shtml += '</div>';	

					$("#postitems").html(shtml); 
								  
				  
				  
			  }//end success onclick button
			});//end ajax
	
		});//end button onclick  function 
	
	
		
	}//end success response
});//end ajax

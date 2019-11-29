$.ajax({
  type: "POST",
  url:"teamsource/php/getposts.php",
  data:{code:"loadarticles"},
  dataType: "json",
  success: function(response){
	var html = "";
	var arr = response;
	
	for(var i = 0;i<arr.length;i++){
		
		html += '<div class="card">';
		html += '<div class = "card-header bg-primary" style = "padding:15px;"><div class="post-preview">';
        html += '<h2>'+arr[i]['post_title']+'</h2>';
        html += '<p class="post-meta">Posted by <a herf = "#">'+arr[i]['username']+'</a> ';
        html +=  arr[i]['post_date']+'</p>';
		html += '</div></div><div class = "card-body bg-light">';
		html += arr[i]['post_content'];
		html += '</div>';
        html += '<div class = "card-footer bg-light">';
		html += '<a href="" onclick="return false" id ="open'+arr[i]['postId']+'" pnumber = "'+arr[i]['postId']+'">Open Comment</a>';
		html += '<div id = "comment'+arr[i]['postId']+'">';
		html += '</div><hr>';
		html += '<label for="post'+arr[i]['postId']+'">Post Comment</label>';
		html += '<textarea class="form-control" id="post'+arr[i]['postId']+'" placeholder="Comments here"></textarea>';
		html += '<button id = "pcomment'+arr[i]['postId']+'" pnumber = "'+arr[i]['postId']+'">Send Comment</button>';
		html += '</div></div><br>';
		
		$(document).on('click','#open'+arr[i]['postId'],function(){
			$(this).hide();
			console.log('working function for opencomment');
			var rootid = $(this).attr("pnumber");
			$.ajax({
			  type: "POST",
			  url:"teamsource/php/comments.php",
			  data:{code:"loadcomments",index:rootid},
			  dataType: "json",
			  success: function(response){
				  var html2 = "<h4>Comments</h4><hr>";
				  var arr2 = response;
				  
				  if($.trim(arr2)){
					  for(var i = 0;i<arr2.length;i++){
						html2+='<p>'+arr2[i]['content']+'</p>';
						html2+='<p class = "text-right" style = "font-size:12px;">posted by '+arr2[i]['username']+' ON '+arr2[i]['postedDate']+'</p><hr>';
						
					  }
				  }else{
					  html2 += '<p>No comments</p>';
					  
				  }
				  $('#comment'+rootid).html(html2);
				  console.log(rootid);
			  }
			});
		});
		
		$(document).on('click','#pcomment'+arr[i]['postId'],function(){
			var rootid = $(this).attr("pnumber");
			var comment = $('#post'+rootid).val();
			console.log(comment);
			if(comment != ""){
				$.ajax({
				  type: "POST",
				  url:"teamsource/php/comments.php",
				  data:{code:"postcomments",comment:comment,postid:rootid},
				  dataType: "json",
				  success: function(response){
					  if(response == "needlogin"){
						  var r = confirm("You need to login! Redirect to login page?");
							if (r == true) {
							  window.location.href = "login.php";
							} else {
							  
							}
					  }else{
						  alert("posted comment!");
						  location.reload();
					  }
					  
				  }
				});
			}else{
				alert('please click after fill in to form');
			}
		});
	}
	
	html += '<div class="clearfix">';
    html += '<a class="btn btn-primary float-right" href="#">Older Posts &rarr;</a>';
    html += '</div>';	
	 
	$("#postitems").html(html);  
		
	}
});

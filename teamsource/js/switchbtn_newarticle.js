$(document).ready(function(){  
		$.ajax({
		  type: "POST",
		  url: "teamsource/php/checkprivilage.php",
		  data: {"code":"getprofile"},
		  dataType: "json",
		  success:function(response){
			if(response == "3"){  
					var html = '<a href = "new_article.html"><button type="button" class="btn btn-primary">POST NEW ARTICLE</button></a><br><br>';			
					$('#articlebutton').html(html);
				}
			}
		});
		
});
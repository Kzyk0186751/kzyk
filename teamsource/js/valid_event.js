$(document).ready(function(){

	$.ajax({
	  type: "POST",
	  url:"teamsource/php/valid_event.php",
	  data:{code:"getevents"},
	  dataType: "json",
	  success: function(response){
		var html = "";
		var arr = response;
		
		for(var i = 0;i<arr.length;i++){
			if(i==0)
			{
				html += '<H3 class="text-center">Non-Valided upcoming Event</h3>';
				html += '<div class="row">';
			}
			html += '<div class="card w-25" >';
			html += '<img class="card-img-top" src="teamsource/img/'+arr[i]['eventImage']+'" alt="Card image cap" style="height:128px;">';
			html += '<div class = "card-body bg-primary" style = "padding:15px;">';
			html += '<div class="post-preview">';
			html += '<h2><a href = "event.html?evtid='+arr[i]['eventId']+'">'+arr[i]['eventName']+'</a></h2>';
			html += '<p>'+arr[i]['postedDate']+'</p>';
			html += '<button type="button" evtid = "'+arr[i]['eventId']+'" class="btn btn-danger w-100 valid_event">Validate this</button>';
			html += '</div>';
			html += '</div>';
			html += '</div>';
			
		}
		html += '</div>';
		 
		$("#upcoming").html(html);  
		
				$(document).on('click','.valid_event',function(){
					var evtid = $(this).attr("evtid");
						$.ajax({
						  type: "POST",
						  url:"teamsource/php/valid_event.php",
						  data:{code:"valid_event",evtid:evtid},
						  dataType: "json",
						  success: function(response){
							  if(response == "fail"){
								  var r = confirm("You need to login! Redirect to login page?");
									if (r == true) {
									  window.location.href = "login.php";
									} else {
									  
									}
							  }else if(response == "success"){
								  alert("event valided!");
								  location.reload();
							  }
							  
						  }
						});
				
					});
			
		}
		

		
	});

});

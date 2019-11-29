$.ajax({
  type: "POST",
  url:"teamsource/php/getownevent.php",
  data:{code:"getevents"},
  dataType: "json",
  success: function(response){
	var html = "";
	var arr = response;
	
	html += '<a href = "new_event.html"><button type="button" class="btn btn-primary">Create New Events</button></a>';
	html += '<br><br><H3>Your Own Events</h3>';
	html += '<div class="row">';
	for(var i = 0;i<arr.length;i++){
		

		html += '<div class="card w-25">';
		html += '<img class="card-img-top" src="teamsource/img/'+arr[i]['eventImage']+'" alt="Card image cap" style="height:128px;">';
		html += '<div class = "card-body bg-primary" style = "padding:15px;">';
		html += '<div class="post-preview">';
        html += '<h2><a href = "update_event.html?evtid='+arr[i]['eventId']+'">'+arr[i]['eventName']+'</a></h2>';
        html += '<p>'+arr[i]['postedDate']+'</p>';
		html += '</div>';
		html += '</div>';
		html += '</div>';
		
	}
	html += '</div>';
	 
	$("#postitems").html(html);  
		
	}
});

$.ajax({
  type: "POST",
  url:"teamsource/php/getupcomingevent.php",
  data:{code:"getevents"},
  dataType: "json",
  success: function(response){
	var html = "";
	var arr = response;
	
	

	for(var i = 0;i<arr.length;i++){
		if(i==0){
			html += '<H3 class="text-center">Upcoming Event</h3>';
			html += '<div class="row">';
		}

		html += '<div class="card w-25" >';
		html += '<img class="card-img-top" src="teamsource/img/'+arr[i]['eventImage']+'" alt="Card image cap" style="height:128px;">';
		html += '<div class = "card-body bg-primary" style = "padding:15px;">';
		html += '<div class="post-preview">';
        html += '<h2><a href = "event.html?evtid='+arr[i]['eventId']+'">'+arr[i]['eventName']+'</a></h2>';
        html += '<p>'+arr[i]['postedDate']+'</p>';
		html += '</div>';
		html += '</div>';
		html += '</div>';
		
	}
	html += '</div>';
	 
	$("#upcoming").html(html);  
		
	}
});

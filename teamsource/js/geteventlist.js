$.ajax({
  type: "POST",
  url:"teamsource/php/getevents.php",
  data:{code:"getevents"},
  dataType: "json",
  success: function(response){
	var html = "";
	var arr = response;
	
	html += '<div class="card-deck">';
	for(var i = 0;i<arr.length;i++){
		

		html += '<div class="card" style="width: 18rem; height: 21rem;">';
		html += '<img class="card-img-top" src="teamsource/img/'+arr[i]['eventImage']+'" alt="Card image cap">';
		html += '<div class = "card-body bg-primary" style = "padding:15px;">';
		html += '<div class="post-preview">';
        html += '<h2><a href = "event.html?evtid='+arr[i]['eventId']+'">'+arr[i]['eventName']+'</a></h2>';
        html += '<p>'+arr[i]['postedDate']+'</p>';
		html += '</div>';
		html += '</div>';
		html += '</div>';
		
	}
	html += '</div>';
	 
	$("#postitems").html(html);  
		
	}
});

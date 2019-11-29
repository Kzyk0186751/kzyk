$(document).ready(function(){

var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = window.location.search.substring(1),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
        }
    }
	
}


var eventindex = getUrlParameter('evtid');
	

	$.ajax({
	  type: "POST",
	  url:"teamsource/php/getsingleevent.php",
	  data:{code:"loadevent",index:eventindex},
	  dataType: "json",
	  success: function(response){
		  var title = "";
		  var content = "";
		  var info = "";
		  var arr = response;
		  
		  title = arr[0]['eventName'];
		  content = arr[0]['eventDescription'];
		  info = "ARTICLE POSTER:"+arr[0]['username']+"<br> POSTED DATE AND TIME:"+arr[0]['postedDate'];
		  
		  $('#event_title').html(title);
		  //$('#event_info').html(info);
		  $('#event_content').html(content);
		  
		  //console.log(arr);
		  
	  }
	});
	
});
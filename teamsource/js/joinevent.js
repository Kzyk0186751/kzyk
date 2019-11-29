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

var evtid = getUrlParameter('evtid');

		$.ajax({
		  type: "POST",
		  url: "teamsource/php/checkprivilage.php",
		  data: {"code":"getprofile"},
		  dataType: "json",
		  success:function(response){
			if(response == "3" || response == "0"){  
					var html = '<button type="button" class="btn btn-primary reg_event">Register this event</button><br><br>';			
					$('#registerbtn').html(html);
						$(document).on('click','.reg_event',function(){
								$.ajax({
								  type: "POST",
								  url:"teamsource/php/register_into_event.php",
								  data:{code:"reg_event",evtid:evtid},
								  dataType: "json",
								  success: function(response){
									  if(response == "fail"){
										  var r = confirm("You need to login! Redirect to login page?");
											if (r == true) {
											  window.location.href = "login.php";
											} else {
											  
											}
									  }else if(response == "success"){
										  alert("newly enrolled in event!");
										  location.reload();
									  }else if(response == "enrolled"){
										  var w = confirm("You already enrolled! Redirect to event page?");
											if (w == true) {
											  window.location.href = "events.html";
											} else {
											  
											}
									  }
									  
								  }
								});
						
							});

				}
			}
		});
		
});
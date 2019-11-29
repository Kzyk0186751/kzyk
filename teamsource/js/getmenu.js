$(document).ready(function() {
    console.log("menu has loaded" );
	var html = "";
	
	$.ajax({
      type: "POST",
      url:"teamsource/php/getmenu.php",
      data:{operation:"getmenu"},
      dataType: "json",
      success: function(response){
    	var html = "";
    	var arr = response;
    		
            	    html += '<ul class="navbar-nav ml-auto">';
                    html += '<li class="nav-item">';
                    html += '<a class="nav-link" href="index.html">Home</a>';
					html += '</li>';
					if(arr['privillage'] != 4){
						
						html += '<li class="nav-item">';
						html += '<a class="nav-link" href="view_article.html">Articles</a>';
						html += '</li>';
						html += '<li class="nav-item">';
						html += '<a class="nav-link" href="events.html">Events</a>';
						html += '</li>';
					}
					if(arr['privillage'] == 4){
						html += '<li class="nav-item">';
						html += '<a class="nav-link" href="showarticle.php">delete article</a>';
						html += '</li>';
						html += '<li class="nav-item">';
						html += '<a class="nav-link" href="valid_events.html">Validate events</a>';
						html += '</li>';
						html += '<li class="nav-item">';
						html += '<a class="nav-link" href="del_events.html">delete events</a>';
						html += '</li>';
						html += '<li class="nav-item">';
						html += '<a class="nav-link" href="showuser.php">User Control</a>';
						html += '</li>';
						html += '<li class="nav-item">';
						html += '<a class="nav-link" href="admin.php">Admin console</a>';
						html += '</li>';
					}
					if(arr['privillage'] == 3){
						html += '<li class="nav-item">';
						html += '<a class="nav-link" href="edit_event.html">Manage Events</a>';
						html += '</li>';
					}
					if(arr['privillage'] != 4 && arr['privillage'] != "empty"){
						    html += '<li class="nav-item">';
                            html += '<a class="nav-link" href="new_profile.html">Profile</a>';
                            html += '</li>';
					}
                    if(arr['username'] == "empty"){
                        html += '<li class="nav-item">';
                        html += '<a class="nav-link" href="login.php">Login</a>';
                        html += '</li>';
                    }else{  
                        html += '<li class="nav-item">';
                        html += '<a class="nav-link" href="logout.php">Logout</a>';
                        html += '</li>';  
                    }
                    html += '</ul>';
            		
            	$("#navbarResponsive").html(html);
        }
    });
	
});



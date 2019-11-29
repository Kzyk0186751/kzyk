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


var articleindex = getUrlParameter('articlebacknumber');
	

	$.ajax({
	  type: "POST",
	  url:"teamsource/php/getsinglearticle.php",
	  data:{code:"loadarticle",index:articleindex},
	  dataType: "json",
	  success: function(response){
		  var title = "";
		  var content = "";
		  var info = "";
		  var arr = response;
		  
		  title = arr[0]['title'];
		  content = arr[0]['content'];
		  info = "ARTICLE POSTER:"+arr[0]['username']+"<br> POSTED DATE AND TIME:"+arr[0]['post_date'];
		  
		  $('#article_title').html(title);
		  $('#article_info').html(info);
		  $('#article_content').html(content);
		  
		  //console.log(arr);
		  
	  }
	});
	
});
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
	  url:"teamsource/php/getsingle_event_forupdate.php",
	  data:{code:"loadevent",index:eventindex},
	  dataType: "json",
	  success: function(response){
		  var title = "";
		  var content = "";
		  var info = "";
		  var date = "";
		  var src = "teamsource/img/";
		  var arr = response;
		  
		  title = arr[0]['eventName'];
		  content = arr[0]['eventDescription'];
		  date = arr[0]['eventDate'];
		  src += arr[0]['eventImage'];
		  info = "ARTICLE POSTER:"+arr[0]['username']+"<br> POSTED DATE AND TIME:"+arr[0]['postedDate'];
		  
		  $('#update_title').val(title);
		  $('#update_content').val(content);
		  $('#update_date').val(date);
		  $('#upimage').attr("src",src);
		  
		  //console.log(arr);
		  
	  }
	});
	
		$(document).on('click','#update_evt',function(){
			var up_title = $('#update_title').val();
			var up_content = $('#update_content').val();
			var up_date = $('#update_date').val();
			var form_data = new FormData();
			
			if(up_title == ""||up_content == ""||up_date == ""){
				alert("please fill in all form!");
			}else{
				
			var property = document.getElementById("update_image").files[0];
			if(property != null){
				var image_name = property.name;
				var image_extension = image_name.split('.').pop().toLowerCase();
				if(jQuery.inArray(image_extension,['gif','png','jpg','jpeg']) == -1)
				{
					alert("Ivalid Image file");
				}
				var image_size = property.size;
				if(image_size > 200000000)
				{
					alert("image file size is very big");
				}			
			}

			form_data.append("file",property);
			form_data.append("reqest","update");
			form_data.append("index",eventindex);
			form_data.append("title",up_title);
			form_data.append("content",up_content);
			form_data.append("date",up_date);
			$.ajax({
				url:"teamsource/php/update_event.php",
				method:"post",
				data:form_data,
				contentType:false,
				cache:false,
				processData:false,
				success:function(data)
				{
					if(data == 'nosuccess'){
						alert('You dont have privilage to use this functionality!');
					}else if(data == 'success'){
						alert('data has been updated correctly!');
						window.location.href = "edit_event.html";
					}
				}
				
			})
			}//END OF ELSE
		
	});
	
	function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#upimage').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#update_image").change(function(){
        readURL(this);
    });
	
});
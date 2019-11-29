$(document).ready(function(){
	$(document).on('click','#registerevt',function(){
			var title = $('#etitle').val();
			var content = $('#econtent').val();
			var date = $('#edate').val();
			var form_data = new FormData();
			
			if(title == ""||content == ""||date == ""){
				alert("please fill in all form!");
			}else{
				
			var property = document.getElementById("eimage").files[0];
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
				

			form_data.append("file",property);
			form_data.append("reqest","register");
			form_data.append("title",title);
			form_data.append("content",content);
			form_data.append("date",date);
			$.ajax({
				url:"teamsource/php/register_event.php",
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
						alert('Event has been succesfully created!');
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
                $('#uploaded_image').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#eimage").change(function(){
        readURL(this);
    });
	
	
});
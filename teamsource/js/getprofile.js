$(document).ready(function(){  
		$.ajax({
		  type: "POST",
		  url: "teamsource/php/getprofile.php",
		  data: {"code":"getprofile"},
		  dataType: "json",
		  success:function(response){
				var html = '<div class="card" style="width: 18rem;">';
				var array = response;				
				$('#department').val(array[0]['department']);
				$('#age').val(array[0]['age']);
				$('#yp').val(array[0]['profile_text']);
				 
			  }
		});
		
				
		$("#editbtn").click(function() {
		var dept = $('#department').val();
		var age = $('#age').val();
		var profile = $('#yp').val();
		
		console.log(dept);
			$.ajax({
			  type: "POST",
			  url: "teamsource/php/getprofile.php",
			  data: {"code":"updateprofile","department":dept,"age":age,"profile":profile},
			  success:function(response){
					if(response == 'success'){
						alert('successfully updated for new profile');
					}else if(response == 'fail'){
						alert('failed to update your profile');
					}else{
						alert('unhandled operation');
					}
				}
			});
		});


});  


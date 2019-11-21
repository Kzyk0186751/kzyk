// this script is to check the pattern of the password and give appropriate error message
function checkPassword()
{
	if(document.getElementById("password").validity.patternMismatch)
	{
		document.getElementById("password").setCustomValidity("Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters");
	}
	else
	{
		document.getElementById("password").setCustomValidity("");
	}
	
}

// this script is to check whether both password and confirm password are matching and give appropriate error message 
function checkConfirmPassword()
{
	if(document.getElementById("password").value != document.getElementById("confirm").value)
	{
		document.getElementById("confirm").setCustomValidity("password does not match"); 
		document.getElementById("wrongPassword").style.visibility = "visible";
	}
	else
	{
		document.getElementById("confirm").setCustomValidity("");
		document.getElementById("wrongPassword").style.visibility = "hidden";
	}
	
}

// this script is to check the pattern of the username and give appropriate error message
function checkUsername()
{
	if(document.getElementById("username").validity.patternMismatch)
	{
		document.getElementById("username").setCustomValidity("Must contain at least one alphabet or number, and at least 6 or more characters");
	}
	else
	{
		document.getElementById("username").setCustomValidity("");
	}
	
}
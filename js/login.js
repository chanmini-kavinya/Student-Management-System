function showTab(n) {
  if (n == 0) {
	document.getElementById("log").style.display = "block"; 
	document.getElementById("forgot").style.display = "none";
	document.getElementById("verify").style.display = "none"; 
	document.getElementById("reset").style.display = "none";
  } else if (n == 2) {
	document.getElementById("log").style.display = "none"; 
	document.getElementById("forgot").style.display = "block";
  } else if (n == 3) {
    document.getElementById("forgot").style.display = "none"; 
	document.getElementById("verify").style.display = "block";
  } else if (n == 4) {
    document.getElementById("verify").style.display = "none"; 
	document.getElementById("reset").style.display = "block";
  } else if (n == 1) {
    document.getElementById("reset").style.display = "none"; 
	document.getElementById("log").style.display = "block";
  }
}// JavaScript Document
function validateform1(form)
	{
		if(document.resetForm.password.value.length<8) 
		{
			alert("Password must contain atleast 8 characters");
			return false;
		}
		else if(!/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/.test(document.resetForm.password.value))
		{
			alert("Password must contain atleast one number, one letter and one special character");
			return false;
		}
		
		else if(document.resetForm.password.value!=document.resetForm.cpassword.value)
		{
		alert("Password and confirm password do not match");
		return false; 
		}
		else
		{
			return true;
		}
		
	}		
function validateform2(form)
	{		
		if(document.resetForm2.fl_password.value.length<8) 
		{
			alert("Password must contain atleast 8 characters");
			return false;
		}
	    else if(!/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/.test(document.resetForm2.fl_password.value))
		{
			alert("Password must contain atleast one number, one letter and one special character");
			return false;
		}
		else if(document.resetForm2.fl_password.value!=document.resetForm2.fl_cpassword.value)
		{
		alert("Password and confirm password do not match");
		return false; 
		}
		else
		{
			return true;
		}
		

	}
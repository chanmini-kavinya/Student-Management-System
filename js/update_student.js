function validateform(form)

	{    dateFormat = /^\d{1,2}\/\d{1,2}\/\d{4}$/;
         timeFormat = /^\d{1,2}:\d{2}([ap]m)?$/;

		
		if(!(/^([0-9]{9}[x|X|v|V])$/.test(document.form1.nic.value) || /^([0-9]{12})$/.test(document.form1.nic.value)))
		{
			alert("Please enter a valid NIC number");
			return false;
		}
		 else if(!/^[a-zA-Z ]*$/.test(document.form1.fname.value))
		  {
			alert("First Name must contain only alphabets!");
	
			return false;
		  }
		 else if(!/^[a-zA-Z ]*$/.test(document.form1.lname.value))
		  {
			alert("Last Name must contain only alphabets!");
	
			return false;
		  }
		else if(document.form1.dob.value == '' && document.form1.dob.value.match(dateFormat)) {
      		 alert("Invalid Date of Birth format!");
      		 return false;
    	  }
    	  else if(document.form1.dob.value<new Date().toISOString().slice(0, 10))
		  {
			alert("Date of Birth cannot be erlier today's date!");
			return false;
		  }
					  //^0[0-9]{9,10}$   ^(?:7|0|(?:\+94))[0-9]{8,9}$
		else if(!/^07[0,1,2,5,6,7,8][0-9]{7}$/.test(document.form1.mobile.value)) 
		{
		alert("Please enter a valid mobile number");
		return false; 
		}
		 else if (/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(document.form1.email.value))
        {
            alert("You have entered an invalid email address!")
            return false;
         }
		 
		else
		{
			return true;
		}
		

	}
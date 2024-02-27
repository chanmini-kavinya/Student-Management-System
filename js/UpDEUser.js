// JavaScript Document

function validateform(form)
	{  
	  
		if(document.form1.id.value.length!=10 && document.form1.id.value.length!=12 )
		{
			alert("Please enter a valid NIC number");
			form1.id.focus();
			return false;
		}
		else if (!/^\w+$/.test(form1.id.value)) {
              alert("Error: NIC must contain only letters, numbers!");
              form1.id.focus();
              return false;
        }
        
		else if(!/^[a-zA-Z]+$/.test(document.form1.fName.value))
		{
			alert(" Please enter First name......( It must contain only alphabets)");
			form1.fName.focus();
			return false;
		}
		else if(!/^[a-zA-Z]+$/.test(document.form1.lName.value))
		{
			alert("Please enter Last name......( It must contain only alphabets)");
			form1.lName.focus();
			return false;
		}
		else if (document.form1.email.value.length==0) {
			alert("Missing Email");
			form1.email.focus();
			return false;
		}
		
		else
		{
			return true;
		}
		

	}
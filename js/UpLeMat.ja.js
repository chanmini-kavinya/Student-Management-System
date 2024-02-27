
function validationform(form)
	{  
	    

        if(document.form1.batchCode.selectedIndex==0)
	      {  alert("Please select a Batch");
	         form1.batchCode.focus();
	         return false;
	      }
	   else if(document.form1.material.value.length==0)
	      {
		     alert("Please Select material");
		     form1.material.focus();
		     return false;
	      }
	   
		
	   else
		{
			return true;
		}
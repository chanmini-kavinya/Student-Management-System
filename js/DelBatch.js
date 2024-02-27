// JavaScript Document

function validateform(form)
	{  
	    if(document.form1.courseNo.selectedIndex==0)
	      {  alert("Please select a Course");
	         form1.courseNo.focus();
	         return false;
	      }

        else if(document.form1.batchCode.selectedIndex==0)
	      {  alert("Please select a Batch");
	         form1.batchCode.focus();
	         return false;
	      }
	   
		
		else
		{
			return true;
		}
		

	}
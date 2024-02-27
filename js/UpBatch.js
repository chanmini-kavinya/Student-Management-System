// JavaScript Document

function validateform(form)
	{  
	   /* if(document.form1.courseNo.selectedIndex==0)
	      {  alert("Please select a Course");
	         form1.courseNo.focus();
	         return false;
	      }

        else if(document.form1.batchCode.selectedIndex==0)
	      {  alert("Please select a Batch");
	         form1.batchCode.focus();
	         return false;
	      }
	    else if(document.form1.teacherID.selectedIndex==0)
	      {  alert("Please select a Teacher");
	         form1.teacherID.focus();
	         return false;
	      }
  else */if(document.form1.startDate.value.length==0)
	      {
		     alert("Please enter Date");
		     form1.startDate.focus();
		     return false;
	      }
          else if(document.form1.day.selectedIndex==0)
	      {  alert("Please select a Day");
	         form1.day.focus();
	         return false;
	      }
	      else if(document.form1.fromTime.value.length==0)
	      {
		     alert("Please enter Time");
		     form1.fromTime.focus();
		     return false;
	      }
	      else if(document.form1.toTime.value.length==0)
	      {
		     alert("Please enter Time");
		     form1.toTime.focus();
		     return false;
	      }
	      else if(document.form1.maxStd.value.length==0)
	      {
		     alert("Please enter Student Number");
		     form1.maxStd.focus();
		     return false;
	      }
	       else if(document.form1.appOpen.value.length==0)
	      {
		     alert("Please enter Student Number");
		     form1.appOpen.focus();
		     return false;
	      }

	       else if(document.form1.appClose.value.length==0)
	      {
		     alert("Please enter Student Number");
		     form1.appClose.focus();
		     return false;
	      }
          

           else if(document.form1.dateAward.value.length==0)
	      {
		     alert("Please enter Student Number");
		     form1.dateAward.focus();
		     return false;
	      }


		
		else
		{
			return true;
		}
		

	}
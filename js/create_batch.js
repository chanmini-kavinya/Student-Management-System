
// JavaScript Document

function validateform(form)
	{
         dateFormat = /^\d{1,2}\/\d{1,2}\/\d{4}$/;
         timeFormat = /^\d{1,2}:\d{2}([ap]m)?$/;

		   if(document.createBatchForm.startDate.value == '' && document.createBatchForm.startDate.value.match(dateFormat)) {
      				alert("Invalid start date format");
      				return false;
    	  }
    	  else if(document.createBatchForm.startDate.value>document.createBatchForm.endDate.value)
		  {
			alert("Start date cannot be erlier today's date!");
			return false;
		  }
		   else if(document.createBatchForm.day.selectedIndex==0)
	      {  alert("Please select a Day");
	    
	         return false;
	      }
	      
    	  else if(document.createBatchForm.fromTime.value == '' && document.createBatchForm.fromTime.value.match(timeFormat)) {
     				 alert("Invalid from time format!");      			
      				return false;
   			 }

   			 else if(document.createBatchForm.toTime.value == '' && document.createBatchForm.toTime.value.match(timeFormat)) {
     				 alert("Invalid to time format!");      			
      				return false;
   			 }
	       else if(isNaN(document.createBatchForm.maxStd.value))
	      {
		    alert("Maximum Students should be numeric!");
		 
		    return false; 
		  }
	      else
		  {
			return true;
		  }
		
		
		

	}
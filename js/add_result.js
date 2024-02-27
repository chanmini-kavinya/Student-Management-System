function validateform(form)
	{ 
		
		if(document.addResultForm.txtMark.value>0 && document.addResultForm.cbAbsent.checked)
		{
			alert("Please check! Marks entered and absent also marked!");
			return false;
		}
		else
		{
			return true;
		}
		

	}
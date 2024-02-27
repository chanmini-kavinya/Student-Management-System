<?php 
ob_start();
session_start(); ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Smart Start English Club</title>
<link rel="shortcut icon" href="images/logo2.jpg" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="../dashboard.scss">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
function call(url){
    document.getElementById('iframe').src = url;
}
</script>
<style>
    body {
  --screen-width: 100%;
  --screen-height: 100%;
  
  --nav-text-color: #ffffff;
  --nav-height: 50px;
  --nav-width: 280px;
  --nav-count: 30;
  --active-color: #095484;
  font-family: "Open Sans", sans-serif;
  font-size: 16px;
}

a{
	text-decoration: none;
}

.container {
  background-image: linear-gradient(to bottom right, #ff9eaa 0% 65%, #e860ff 95% 100%);
  width: var(--screen-width);
  height: var(--screen-height);
  display: grid;
  place-items: center;
  overflow: hidden;
}

.nav-opener {
  display: none;
}

.nav-opener:checked + .nav {
  width: var(--screen-width);
  height: var(--screen-height);
  opacity: 1;
  transition: opacity 300ms ease-out;
}

.nav {
  width: var(--screen-width);
  height: var(--screen-height);
  opacity: 1;
  transition: opacity 300ms ease-out;
  
  display: grid;
  grid-template-rows: var(--nav-height) 30% auto;
  grid-template-columns: 100%;
  overflow: hidden;
  position: absolute;
  top: 0;
  left: 0;
 
}

.nav-header {
  background-color: #323232;
  display: flex;
  justify-content: space-between;
}

.nav-links {
  background-image: url("../images/sidebar1.jpg");
  //background-color: #323232;
  padding: 0;
  margin: 0;
  display: block;
  grid-template-rows: repeat(var(--nav-count), var(--nav-height));
  grid-template-columns: 100%;
  overflow: auto;
  list-style-type: none;
}

.nav-link, .sub-link {
  
  height: var(--nav-height);
  color: var(--nav-text-color);
  display: flex;
  padding-left: 20px;
  align-items: center;
  user-select: none;
  //transition: all 0.3s ease-in;
}

.nav-link label , .sub-link label{
  width: 100%;
  height: 100%;
  padding-left: 20px;
  display: flex;
  align-items: center;
  cursor: pointer;
}

.dropdown-container i {
  margin-left: 20px;

}

.nav-images {
  display: flex;
  flex-flow: row wrap;
  flex-shrink: 0;
  flex-grow: 0;
  overflow: hidden;
  position: relative;
}
.fa-caret-right {
  float: right;
  padding-right: 8px;
}
.dropdown-btn ,.abc{
  font-size: 16px;
  display: flex;  
  justify-content: flex-start;
  border: none;
  background: none;
  width:100%;
  outline: none;
transition: all 0.2s ease-out; 
	
}
	
.dropdown-container {
  display: none;
  background-color: rgba(15,15,15,0.70);
  padding-left: 0px;
  font-size: 14.5px;
  border-left: 5px solid rgba(255,255,255,0.80);
  animation: growDown 300ms ease-in-out forwards;
  transform-origin: top center;

}
@keyframes growDown {
    0% {
        transform: scaleY(0)
    }
    80% {
        transform: scaleY(1.1)
    }
    100% {
        transform: scaleY(1)
    }
}
.dropdown-container.is-open {
  display: block;
}
.nav-click	{
  background-color: var(--active-color);
  //border-left: 5px solid rgba(255,255,255,0.80);
}
.subnav-click {
	color: #33BBFF;
}
.nav-link:hover {
  background-color: rgba(153,153,153,0.50);
	cursor: pointer;
}
 .sub-link:hover{
 // background-color: rgba(153,153,153,0.50);
	// background-color: rgba(153,153,153,0.50);
	 color: #33BBFF;
	cursor: pointer;
}
.nav-link:focus, .nav-link:active {
  background-color:var(--active-color);
}

//.nav-link a:focus, .nav-link a:active {
  //background-color: rgba(0,188,212,0.80);
//}

.nav-title {
  color: var(--nav-text-color);
  font-weight: bold;
  height: var(--nav-height);
  margin-left: 20px;
  display: flex;
  align-items: center;
}

.nav-link-opener {
  display: none;
}

.ripple {
  background-position: center;
  transition: background 0.8s;

}
.ripple:hover {
  background: #47a7f5 radial-gradient(circle, transparent 1%, #47a7f5 1%) center/15000%;
}
.ripple:active {
  background-size: 100%;
  transition: background 0s;
}

.myButton {
	box-shadow:inset 0px -3px 7px 0px #0666a3;
	background:linear-gradient(to bottom, #0666a3 5%, #095484 100%);
	background-color:#0666a3;
	border-radius:3px;
	border:1px solid #0b0e07;
	display:inline-block;
	cursor:pointer;
	color:#ffffff;
	font-family:Arial;
	font-size:15px;
	padding:9px 23px;
	text-decoration:none;
	text-shadow:0px 1px 0px #095584;
	margin: 8px 8px 0 0;
}
.myButton:hover {
	background:linear-gradient(to bottom, #095484 5%, #0666a3 100%);
	background-color:#095484;
}
.myButton:active {
	position:relative;
	top:1px;
}

    
    

@media (min-width: 768px) {
  .nav {
    grid-template-rows: var(--nav-height) auto;
    grid-template-columns: var(--nav-width) auto;
  }
  
  .nav-header {
    grid-column-start: span 2;
  }
}

</style>
</head>

<body >
	
	<div class="container">
  <div class="nav">
    <div class="nav-header">
      <div class="nav-title">MENU</div>
		<div><a href="change_password.php" target="iframe" class="myButton">Change Password</a> <a href="index.php" class="myButton">Logout</a></div>
      
    </div>
	 
    <div class="nav-links" id="nav">
	<div class=" moderate">
		<button class="dropdown-btn nav-link dash" onclick="call('dashboard_first.php')"><i class="fa fa-dashboard"></i>&emsp;&nbsp; Dashboard </button>
	</div>
	<?php 
	if($_SESSION["utype"]=='a' or $_SESSION["utype"]=='o')
	{?>
    <div class=" moderate">
		<button class="dropdown-btn nav-link" onclick="call('confirm.php')"><i class="fa fa-check-square-o"></i>&emsp;&nbsp; Confirm Registration</button>
	</div> 
	   <div class=" moderate">
		  <button class="dropdown-btn nav-link" ><i class="fa fa-print"></i>&emsp;&nbsp; Print &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; &emsp;&nbsp;
			  <i class="fa fa-caret-right"></i>
		  </button>

		  <div class="dropdown-container">
			
			<a class="sub-link" href="print_id.php" target="iframe"><i class="fa fa-angle-right"> </i><label>Print Student ID</label></a>
			<a class="sub-link" href="print_certificate.php" target="iframe"><i class="fa fa-angle-right"> </i><label> Print Certificate</label></a>
		  </div>
		</div>
		<div class=" moderate">
	  <button class="dropdown-btn nav-link"><i class="fa fa-sticky-note-o"></i>&emsp;&nbsp; Report&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-caret-right"></i>
	  </button>
	  <div class="dropdown-container">
		<a class="sub-link" href="attendance_rpt.php" target="iframe"><i class="fa fa-angle-right"> </i><label>Attendance Report</label></a>
		<a class="sub-link" href="reg_std_rpt.php" target="iframe"><i class="fa fa-angle-right"> </i><label>Student List</label></a>
		 <a class="sub-link" href="result_sheet_rpt.php" target="iframe"><i class="fa fa-angle-right"> </i><label>Result Sheet</label></a>
		<a class="sub-link" href="course_income_rpt.php" target="iframe"><i class="fa fa-angle-right"> </i><label>Course Income Report</label></a>
	  </div>
	  </div>
	  <div class=" moderate">
	  <button class="dropdown-btn nav-link"><i class="fa fa-user"></i>&emsp;&nbsp; Student &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;
		  <i class="fa fa-caret-right"></i>
	  </button>
	  <div class="dropdown-container">
		<a class="sub-link" href="search_student.php" target="iframe"><i class="fa fa-angle-right"> </i><label> Search Student</label></a>
		<a class="sub-link" href="update_student.php" target="iframe"><i class="fa fa-angle-right"> </i><label>Update Student</label></a>
	  </div>
	  </div>
	  <?php }
	  if($_SESSION["utype"]=='c')
	{?>
	<div class=" moderate">
		<button class="dropdown-btn nav-link" onclick="call('search_student.php')"><i class="fa fa-user"></i>&emsp;&nbsp; Search Student </button>
	</div>
	<?php }
	if($_SESSION["utype"]=='a' or $_SESSION["utype"]=='c')
	{?>
	  <div class=" moderate">
	  <button class="dropdown-btn nav-link"><i class="fa fa-edit"></i>&emsp;&nbsp;Course &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;&nbsp;
		  <i class="fa fa-caret-right"></i>
	  </button>
	  <div class="dropdown-container">
		<a class="sub-link" href="add_course.php" target="iframe"><i class="fa fa-angle-right"> </i><label>Add New Course</label></a>
		<a class="sub-link" href="upd_dlt_course.php" target="iframe"><i class="fa fa-angle-right"> </i><label> Update/Delete Course</label></a>
	  </div>
	  </div>
	  <div class=" moderate">
      <button class="dropdown-btn nav-link"><i class="fa fa-user-o"></i>&emsp;&nbsp; Teacher&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;
		  <i class="fa fa-caret-right"></i>
	  </button>
	  <div class="dropdown-container">
		<a class="sub-link" href="add_teacher.php" target="iframe"><i class="fa fa-angle-right"> </i><label> Add New Teacher</label></a>
		<a class="sub-link" href="upd_dlt_teacher.php" target="iframe"><i class="fa fa-angle-right"> </i><label> Update/Delete Teacher</label></a>
	  </div>
	  </div>
	  <div class=" moderate">
	  <button class="dropdown-btn nav-link"><i class="fa fa-users "></i>&emsp;&nbsp;Batch &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		  <i class="fa fa-caret-right"></i>
	  </button>
	  <div class="dropdown-container">
		<a class="sub-link" href="create_batch.php" target="iframe"><i class="fa fa-angle-right"> </i><label>Create Batch</label></a>
		<a class="sub-link" href="update_batch.php" target="iframe"><i class="fa fa-angle-right"> </i><label>Update Batch</label></a>
		<a class="sub-link" href="dlt_batch_acc.php" target="iframe"><i class="fa fa-angle-right"> </i><label> Delete Batch Accounts</label></a>
	  </div>
	  </div>
		<?php }
		if($_SESSION["utype"]=='a')
	{?>
	  <div class=" moderate">
	  <button class="dropdown-btn nav-link"><i class="fa fa-user-circle-o"></i>&emsp;&nbsp;System Users &emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-caret-right"></i>
	  </button>
	  <div class="dropdown-container">
		<a class="sub-link" href="add_user.php" target="iframe"><i class="fa fa-angle-right"> </i><label>Add Users</label></a>
		<a class="sub-link" href="upd_dlt_user.php" target="iframe"><i class="fa fa-angle-right"> </i><label> Update/Delete Users</label></a>
	  </div>
	  </div> <?php } 
		if($_SESSION["utype"]=='a' or $_SESSION["utype"]=='t') {?>
	<div class=" moderate">
		<button class="dropdown-btn nav-link" onclick="call('upload_lm.php')"><i class="fa fa-cloud-upload"></i>&emsp;&nbsp;Upload Learning Material</button>
	</div>  
     <div class=" moderate">
		<button class="dropdown-btn nav-link" onclick="call('add_result.php')"><i class="fa fa-plus-square"></i>&emsp;&nbsp; Add Exam Result</button>
	</div>
	<div class=" moderate">
		<button class="dropdown-btn nav-link" onclick="call('take_attendance.php')"><i class="fa fa-qrcode"></i>&emsp;&nbsp; Record Attendance</button>
	</div>
	<?php }
		if($_SESSION["utype"]=='a' or $_SESSION["utype"]=='t' or $_SESSION["utype"]=='c')
	{?>
	<div class=" moderate">
		<button class="dropdown-btn nav-link" onclick="call('email.php')"><i class="fa fa-envelope-o"></i>&emsp;&nbsp; Email</button>
	</div>
	 
	<?php }
		if($_SESSION["utype"]=='s')
	{?>
	<div class=" moderate">
		<button class="dropdown-btn nav-link" onclick="call('view_lm.php')"><i class="fa fa-file-pdf-o"></i>&emsp;&nbsp; Learning Material</button>
	</div>
	
	<div class=" moderate">
		<button class="dropdown-btn nav-link" onclick="call('view_result.php')"><i class="fa fa-clone"></i>&emsp;&nbsp; Exam Results</button>
	</div>
	<div class=" moderate">
		<button class="dropdown-btn nav-link" onclick="call('view_attendance.php')"><i class="fa fa-calendar-check-o"></i>&emsp;&nbsp; Attendance</button>
	</div>
     <?php } ?>
    </div>
    <div class="nav-images" >
		<iframe name="iframe" id="iframe" src="dashboard_first.php" width="100%" ></iframe>
      
    </div>
  </div>
</div>


<script>
$(document).ready(function() {
    $('.dash').toggleClass('nav-click');
});
	
$('.dropdown-btn ').on('click', (event) => {
  $(event.target).siblings('.dropdown-container')
    .toggleClass('is-open');
	 $(event.target).toggleClass('nav-click');
	//$(event.target).siblings('.nav-link').style.backgroundColor = "red";	
});

$(document).click(function(e) {
  $('.moderate')
    .not($('.moderate').has($(e.target)))
    .children('.dropdown-container')
    .removeClass('is-open');
	
	$('.moderate')
    .not($('.moderate').has($(e.target))).children('.dropdown-btn').removeClass('nav-click');
		
	//$('.dropdown-container').removeClass('subnav-click');
	//$('.nav-link').removeClass('nav-click');
});

	
$(document).on('mousedown',function(e) {
    if (!$(e.target).hasClass('.sub-link')) {
        $('label').removeClass('subnav-click');
		$('i').removeClass('subnav-click');
    } else {
    }
});	
	
$('.sub-link').on('mouseup', (event) => {
	 $(event.target).toggleClass('subnav-click');
	$(event.target).siblings('i')
    .toggleClass('subnav-click');
});

/*
$('.nav-link').on('click', (event) => {
	 $(event.target).toggleClass('nav-click');
});
/*
$(document).click(function(e) {
	$('.moderate')
    .not($('.moderate').has($(e.target))).children('.dropdown-btn').removeClass('subnav-click');
});
	
	//* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
	
/*var dropdown = document.getElementsByClassName("dropdown-btn");
var i;

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
    this.classList.toggle("active"); 
    var dropdownContent = this.nextElementSibling;
    if (dropdownContent.style.display === "block") {
      alert("ss");
    } else {
      //dropdownContent.style.display = "block";
    }/*
	 dropdown.splice(i, 1);
	var x;

	for (x = 0; i < dropdown.length; x++) {
	  this.classList.toggle("active");
		var dropdownContent = this.nextElementSibling;
		dropdownContent.style.display = "none";
		
	}
  });
//var colors = ["red","blue","car","green"];
//var carIndex = dropdown.indexOf("car");//get  "car" index
//remove car from the colors array

}*/
	
</script>
</body>
</html>
<?php
ob_start();
include"connection.php";
$stdno="";
if($_POST["studentNo"]!="")
{
$stdno=$_POST["studentNo"];
$con = mysqli_connect($host,$uname,$pwd);
mysqli_select_db($con, $db_name);
$sql = "SELECT * FROM student,studentbatch WHERE student.nic=studentbatch.nic and studentbatch.studentNo='$stdno' ";
	$result=mysqli_query($con,$sql) or die(mysqli_error($con));
	
	while($row=mysqli_fetch_array($result))
		{
		    $batch=$row["batchCode"];
			$fName = $row["fName"];
			$lName = $row["lName"];
			$nic=$row["nic"];
			$title = $row["title"];
			$bDate = $row["dob"];
			$add1 = $row["aLine1"];
			$add2 = $row["aLine2"];
			$add3 = $row["aLine3"];
			$add4 = $row["aLine4"];
			$mobile = $row["mobile"];
			$email = $row["email"];
			$photo = $row["image"];			
		}
	mysqli_close($con);
}
?>

<!doctype html>
<html>
<head>
	 <link type="text/css" rel="stylesheet" href="css/form.css">

<title>Search Student</title>
</head>
<body>
	<div class="testbox">
	<form method="post" action="#">
		 <div class="banner">
         <h1>Search Student</h1>
        </div>
            <div class="item">
		
		 <p> Student Number
		</p>
			<input type="text" name="studentNo" onChange="submit()" value="<?php echo $stdno; ?>"> </div>
	
		<div class="item">
		
		 <p> NIC
		</p>
			<input type="text" name="NIC" readonly value="<?php echo $nic; ?>"> </div>
		<div class="item">
	    <p>Image</p>
		<img src="student_img/<?php echo $photo; ?>"  height="150" width="90" value="">
		</div>
	    <div class="item">
         <p> Name </p>
		<input type="text" name="Name or No" readonly value="<?php echo $fName." ".$lName ?>"></div>
		<div class="item">
		  	<p>Mobile Number</p>
	
		  <input type="text" name="Mobile No" readonly value="<?php echo $mobile ?>">
		  </div>
		<div class="item">
		 	<p> Email </p>
		
		  <input type="text" name="Email" readonly value="<?php echo $email ?>">
		  </div>
		<div class="item">
		 	<p>Address</p>
		
		  <textarea name="Address" rows="4" readonly value=""><?php echo $add1."\n".$add2."\n".$add3."\n".$add4 ?></textarea>
		  </div>
		

	
	
</form>
	</div>
</body>
</html>

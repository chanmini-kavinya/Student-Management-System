<?php
ob_start();
$course="";
$batch="";
use PHPMailer\PHPMailer\PHPMailer;

require_once 'phpmailer/Exception.php';
require_once 'phpmailer/PHPMailer.php';
require_once 'phpmailer/SMTP.php';

$mail = new PHPMailer(true);

$alert = '';
	include "connection.php";

	if($_POST["cmbCourse"]!="")
	{
		$course=$_POST["cmbCourse"];
	}

	if($_POST["cmbBatch"]!="")
	{
		$batch=$_POST["cmbBatch"];
	}
if (isset($_POST["send"])) {
	
	$con = mysqli_connect($host,$uname,$pwd);
    mysqli_select_db($con, $db_name);
    $sql= "SELECT email From student,studentbatch where student.nic=studentbatch.nic and batchCode='$batch'";
    $result=mysqli_query($con,$sql) or die(mysqli_error($con));
    while($row=mysqli_fetch_array($result))
		{

	$to = $row['email'];
    $c = $_POST['comments'];
  $s = $_POST['subject'];
  

  try{
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'smartstartenglishclub0@gmail.com'; 
    $mail->Password = 'smart123!@#';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = '587';

    $mail->setFrom('smartstartenglishclub0@gmail.com'); 
    $mail->addAddress($to); 
    $mail->isHTML(true);
    $mail->Subject = $s;
    $mail->Body = $c;

    $mail->send();
    {$x=1;$batch="";$course="";}
  } catch (Exception $e){
    $alert = '<div class="alert-error">
                <span>'.$e->getMessage().'</span>
              </div>';
  }
 

} if($x==1){
      echo "<script type='text/javascript'>alert('Message sent');</script>";
  }
}


	 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Email</title>
	<link rel="stylesheet" type="text/css" href="css/form.css"/>
	<script type="text/javascript" src="js/Email.js"></script>
</head>
<body>
	
	<div class="testbox">
	<form name="form1" method="post" action="#" onsubmit="return validateform(this)">
		<div class="banner">
	<h1>Send Email</h1><br></div>
		
<div class="item">
          <p>Course</p>
          <select name="cmbCourse" required onChange="submit()">
              <option selected value="<?php echo $course;?>"><?php echo $course;?></option>
              <?php
				$con = mysqli_connect($host,$uname,$pwd);
				mysqli_select_db($con, $db_name);
				$sql = "select name from course";
				$result=mysqli_query($con,$sql) or die(mysqli_error($con));
				while($row=mysqli_fetch_array($result))
					{
						echo "<option value='". $row['name'] ."'>" .$row['name'] ."</option>";
					}
			  mysqli_close($con);
			?> 
            </select>
        </div>
		<div class="item">
          <p>Batch</p>
          <select name="cmbBatch" required onChange="submit()">
              <option selected value="<?php echo $batch;?>"><?php echo $batch;?></option>
              
			  <?php
				$con = mysqli_connect($host,$uname,$pwd);
				mysqli_select_db($con, $db_name);
				$sql = "select batch.batchCode from batch,course where course.courseNo=batch.courseNo and course.name='$course' order by batch.batchCode desc ";
				$result=mysqli_query($con,$sql) or die(mysqli_error($con));
				while($row=mysqli_fetch_array($result))
					{
						echo "<option value='". $row['batchCode'] ."'>" .$row['batchCode'] ."</option>";
					}
			  mysqli_close($con);
			?> 
            </select>
        </div>
<br>
<div class="item"><label for="subject">Subject</label>
<input type="text" id="subject" name="subject"  /></br>
Message<br></div>
<div class="item"><textarea name="comments" rows="10" cols="95">
</textarea><br></div>
 <div class="btn-block">
<input type="submit" value="Send" name="send">
</div>
</form>
</div>
</body>
</html>
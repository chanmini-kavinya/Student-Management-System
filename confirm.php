<?php
ob_start();

function genpass()
{
$data1 = '23456789';
$data2 = 'ABCDEFGHJKLMNPQRSTUVWXYZ';
$data3 = 'abcefghkkmnpqrstuvwxyz';
$data4 = '#$&@';

$p1=substr(strval(str_shuffle($data1)),1,4);

$p2=str_shuffle($data2);
$p2a=substr($p2, 1, 1);

$p3=str_shuffle($data3);
$p3a=substr($p3, 1, 2);

$p4=substr(str_shuffle($data4),1,1);
$p5=substr(strval(str_shuffle($data1)),1,2);

$mypass=$p2a.$p1.$p4.$p3a.$p5;
return $mypass;
}

include "connection.php";
$course="";
$batch="";
$flag=0;
$flag=$_POST["hdflag"];
$hdcourse="";
	$hdcourse=$_POST["hdcourse"];
	$hdbatch="";
	$hdbatch=$_POST["hdbatch"];
$flagmail=0;

if($_POST["cmbCourse"]!="")
{
	$course=$_POST["cmbCourse"];
}

if($_POST["cmbBatch"]!="")
{
	$batch=$_POST["cmbBatch"];
}

if($_POST["nic"]!="")
{
	$nic=$_POST["nic"];
}


$con = mysqli_connect($host,$uname,$pwd);
mysqli_select_db($con, $db_name);

if($_POST["cmbCourse"]!="" and $_POST["cmbBatch"]!="" and $flag==0)
{
	$flag=1;
	$sql = "SELECT * FROM student,payment,studentbatch WHERE student.nic=payment.nic and student.nic=studentbatch.nic and payment.batchCode=studentbatch.batchCode and payment.batchCode='$batch' and studentbatch.studentNo='' order by student.nic asc limit 1";
	$result=mysqli_query($con,$sql) or die(mysqli_error($con));
	
	while($row=mysqli_fetch_array($result))
		{
			$nic = $row["nic"];
			$fname = $row["fName"];
			$lname = $row["lName"];
			$amount = $row["amount"];
			$date = $row["date"];
			$slip = $row["payslip"];
			$email = $row["email"];
			$mobile = $row["mobile"];	
			$remark = $row["remark"];
		}
}

if(isset($_POST["btnPrevious"]))
{
             	$sql = "SELECT * FROM student,payment,studentbatch WHERE student.nic=payment.nic and student.nic=studentbatch.nic and payment.batchCode=studentbatch.batchCode and payment.batchCode='$batch' and studentbatch.studentNo='' and student.nic<'$nic' order by student.nic desc limit 1";
	
				$result=mysqli_query($con,$sql) or die(mysqli_error($con));
                $recno=mysqli_num_rows($result);
                
				while($row=mysqli_fetch_array($result))
					{
						$nic = $row["nic"];
						$fname = $row["fName"];
						$lname = $row["lName"];
						$amount = $row["amount"];
						$date = $row["date"];
						$slip = $row["payslip"];	
						$email = $row["email"];
						$mobile = $row["mobile"];
						$remark = $row["remark"];
					}
                
}
 
if(isset($_POST["btnNext"]))
{
	$sql = "SELECT * FROM student,payment,studentbatch WHERE student.nic=payment.nic and student.nic=studentbatch.nic and payment.batchCode=studentbatch.batchCode and payment.batchCode='$batch' and studentbatch.studentNo='' and student.nic>'$nic' order by student.nic asc limit 1";
	
				$result=mysqli_query($con,$sql) or die(mysqli_error($con));
                $recno=mysqli_num_rows($result);
               
                     while($row=mysqli_fetch_array($result))
					{
						$nic = $row["nic"];
						$fname = $row["fName"];
						$lname = $row["lName"];
						$amount = $row["amount"];
						$date = $row["date"];
						$slip = $row["payslip"];	
						$email = $row["email"];
						$mobile = $row["mobile"];
						$remark = $row["remark"];
					}
                 
				
}

if(isset($_POST["btnConfirm"]))
{
	$sql = "select * from studentbatch where batchCode='$batch' and studentNo!='' order by studentNo desc limit 1";
	$result=mysqli_query($con,$sql) or die(mysqli_error($con));
	$recno=mysqli_num_rows($result);
	
	while($row=mysqli_fetch_array($result))
		{
			$maxno=$row['studentNo'];
			$n=substr($maxno, -3);
			$new=substr($maxno, 0,6).str_pad(intval($n)+1,3,0, STR_PAD_LEFT);
		}
	
	$pw=genpass();
	
	if($recno>0)
	{
		$sql = "UPDATE studentbatch SET studentNo='$new' WHERE nic='$nic' and batchCode='$batch'";
		$result=mysqli_query($con,$sql) or die(mysqli_error($con));
		//$rows=mysqli_affected_rows($con);
		
		$sql = "INSERT INTO user(username,password,type,ID) VALUES('$new', md5('$pw'),'s','$new')";
		$result=mysqli_query($con,$sql) or die(mysqli_error($con));
		$stdno=$new;
	}
	else
	{
		$stdno= substr($batch, 0, 2)."/".substr($batch, -2)."/001";
		$sql = "UPDATE studentbatch SET studentNo='$stdno' WHERE nic='$nic' and batchCode='$batch'";
		$result=mysqli_query($con,$sql) or die(mysqli_error($con));
		
		$sql = "INSERT INTO user(username,password,type,ID) VALUES('$stdno', md5('$pw'),'s','$stdno')";
		$result=mysqli_query($con,$sql) or die(mysqli_error($con));
	}
	
	if(isset($_POST["txtRemark"]))
	{
		$remark=$_POST["txtRemark"];
		$sql = "UPDATE payment SET remark='$remark' WHERE nic='$nic' and batchCode='$batch'";
		$result=mysqli_query($con,$sql) or die(mysqli_error($con));
	}
	
	$sql = "select * from student WHERE nic='$nic'";
	$result=mysqli_query($con,$sql) or die(mysqli_error($con));
		while($row=mysqli_fetch_array($result))
		{
			$email = $row["email"];
		}
	include 'student_login_sending.php';
	
	$sql = "SELECT * FROM student,payment,studentbatch WHERE student.nic=payment.nic and student.nic=studentbatch.nic and payment.batchCode=studentbatch.batchCode and payment.batchCode='$batch' and studentbatch.studentNo='' order by student.nic asc limit 1";
	
	$result=mysqli_query($con,$sql) or die(mysqli_error($con));
	$recno=mysqli_num_rows($result);
	while($row=mysqli_fetch_array($result))
		{
			$nic = $row["nic"];
			$fname = $row["fName"];
			$lname = $row["lName"];
			$amount = $row["amount"];
			$date = $row["date"];
			$slip = $row["payslip"];
			$email = $row["email"];
			$mobile = $row["mobile"];
			$remark = $row["remark"];
		}
	if($recno==0)
	{
			$nic = "";
			$fname = "";
			$lname = "";
			$amount = "";
			$date = "";
			$slip = "";
			$email = "";
			$mobile = "";
			$remark = "";
	}
	
	
}

if(isset($_POST["btnNotConfirm"]))
{
	if($_POST["txtRemark"]!="")
	{
		$remark=$_POST["txtRemark"];
		$sql = "UPDATE payment SET remark='$remark' WHERE nic='$nic' and batchCode='$batch'";
		$result=mysqli_query($con,$sql) or die(mysqli_error($con));
	}
	
	$sql = "SELECT * FROM student,payment,studentbatch WHERE student.nic=payment.nic and student.nic=studentbatch.nic and payment.batchCode=studentbatch.batchCode and payment.batchCode='$batch' and studentbatch.studentNo='' and student.nic>'$nic' order by student.nic asc limit 1";
	
	$result=mysqli_query($con,$sql) or die(mysqli_error($con));
	
	while($row=mysqli_fetch_array($result))
		{
			$nic = $row["nic"];
			$fname = $row["fName"];
			$lname = $row["lName"];
			$amount = $row["amount"];
			$date = $row["date"];
			$slip = $row["payslip"];	
			$email = $row["email"];
			$mobile = $row["mobile"];
			$remark = $row["remark"];
		}
	
}

if(isset($_POST["btnDelete"]))
{ 
	$sql = "DELETE FROM payment WHERE nic='$nic' and batchCode='$batch' ";
	$result=mysqli_query($con,$sql) or die(mysqli_error($con));
	
	$sql = "DELETE FROM studentbatch WHERE nic='$nic' and batchCode='$batch' ";
	$result=mysqli_query($con,$sql) or die(mysqli_error($con));
	
	$sql = "select * from studentbatch where nic='$nic'";
	$result=mysqli_query($con,$sql) or die(mysqli_error($con));
	$recno=mysqli_num_rows($result);
	
	if ($recno==0)
	{
		$sql = "DELETE FROM student WHERE nic='$nic'";
		$result=mysqli_query($con,$sql) or die(mysqli_error($con));
	}
	
	
	$sql = "SELECT * FROM student,payment,studentbatch WHERE student.nic=payment.nic and student.nic=studentbatch.nic and payment.batchCode=studentbatch.batchCode and payment.batchCode='$batch' and studentbatch.studentNo='' and student.nic>'$nic' order by student.nic asc limit 1";
	
	$result=mysqli_query($con,$sql) or die(mysqli_error($con));
	$recno=mysqli_num_rows($result);
	while($row=mysqli_fetch_array($result))
		{
			$nic = $row["nic"];
			$fname = $row["fName"];
			$lname = $row["lName"];
			$amount = $row["amount"];
			$date = $row["date"];
			$slip = $row["payslip"];
			$email = $row["email"];
			$mobile = $row["mobile"];
			$remark = $row["remark"];
		}
	if($recno==0)
	{
			$nic = "";
			$fname = "";
			$lname = "";
			$amount = "";
			$date = "";
			$slip = "";
			$email = "";
			$mobile = "";
			$remark = "";
	}
}

if(isset($_POST["btnEmail"]))
{ 
	$flagmail=1;
	$sql = "SELECT * FROM student,payment,studentbatch WHERE student.nic=payment.nic and student.nic=studentbatch.nic and payment.batchCode=studentbatch.batchCode and payment.batchCode='$batch' and studentbatch.nic='$nic'";
	$result=mysqli_query($con,$sql) or die(mysqli_error($con));
	
	while($row=mysqli_fetch_array($result))
		{
			$nic = $row["nic"];
			$fname = $row["fName"];
			$lname = $row["lName"];
			$amount = $row["amount"];
			$date = $row["date"];
			$slip = $row["payslip"];
			$email = $row["email"];
			$mobile = $row["mobile"];	
			$remark = $row["remark"];
		}
		
		
}

if(isset($_POST["btnSend"]))
{ 	$sql = "SELECT * FROM student,payment,studentbatch WHERE student.nic=payment.nic and student.nic=studentbatch.nic and payment.batchCode=studentbatch.batchCode and payment.batchCode='$batch' and studentbatch.nic='$nic'";
	$result=mysqli_query($con,$sql) or die(mysqli_error($con));
	
	while($row=mysqli_fetch_array($result))
		{
			$nic = $row["nic"];
			$fname = $row["fName"];
			$lname = $row["lName"];
			$amount = $row["amount"];
			$date = $row["date"];
			$slip = $row["payslip"];
			$email = $row["email"];
			$mobile = $row["mobile"];	
			$remark = $row["remark"];
		}
		
    include 'confirm_sending.php';
}


	mysqli_close($con);
?>
<html>
  <head>
    <title>Confirm Student Registration</title>
    
    <link type="text/css" rel="stylesheet" href="css/form.css">
  </head>
  <body>
    <div class="testbox">
      <form name="confirmForm" method="post" action="">
		<?php if($flagmail==1) include "appli_email.php"; ?> 
        <div class="banner">
          <h1>Confirm Student Registration</h1>
          <input type="hidden" name="hdflag" value="<?php echo $flag;?>"/>
          <input type="hidden" name="hdcourse" value="<?php echo $hdcourse;?>"/>
			<input type="hidden" name="hdbatch" value="<?php echo $hdbatch;?>"/>
          <div class="nav_btn"><input type="submit" value="&#8249;" name="btnPrevious" > <input type="submit" value="&#8250;" name="btnNext" > </div>
        </div>
		  <div class="item">
          <div class="name-item">
            <div class="item">
          <p>Course</p>
          <select name="cmbCourse" required onChange="submit()">
              <option selected value="<?php echo $course;?>"><?php echo $course;?></option>
              <?php
				$con = mysqli_connect($host,$uname,$pwd);
				mysqli_select_db($con, $db_name);
				$sql = "select name from course order by name";
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
				$sql = "select batch.batchCode from batch,course where course.courseNo=batch.courseNo and course.name='$course' order by batch.batchCode desc limit 3";
				$result=mysqli_query($con,$sql) or die(mysqli_error($con));
				while($row=mysqli_fetch_array($result))
					{
						echo "<option value='". $row['batchCode'] ."'>" .$row['batchCode'] ."</option>";
					}
			  mysqli_close($con);
			?> 
            </select>
        </div>
          </div>
        </div>
		  
        
		<div class="item">
          <p>Name</p>
            <input type="text" name="name" required readonly value="<?php echo $fname." ".$lname; ?>"/>
          
        </div>  
		  
          <div class="four-item">
			  <div class="item">
          <p>NIC</p>
            <input type="text" name="nic" required readonly value="<?php echo $nic; ?>"/>
				  </div>
		<div class="item">
          <p>Mobile Number</p>
            <input type="text" name="mobile" readonly value="<?php echo $mobile; ?>"/>
        </div>
            <div class="item">
          <p>Amount</p>
            <input type="text" name="amount" readonly value="<?php echo "Rs. ".$amount; ?>"/>
          
        </div>
		<div class="item">
          <p>Payment Date</p>
            <input type="text" name="pdate" readonly value="<?php echo $date; ?>"/>
           
          </div>
        
		</div>
        
		<div class="item">
          <p>Payslip</p>
          <div class="item">
            <img src="payslip/<?php echo $slip; ?>" width="100%" style="border: thick"/>
          </div>
        </div>
		<div class="item">
          <p>Remark</p>
          <div class="item">
            <input type="text" name="txtRemark" value="<?php echo $remark; ?>"/>
          </div>
        </div>
		
        <div class="btn-block">
          <input type="submit" value="Confirm" name="btnConfirm">
		  <input type="submit" value="Not Confirm" name="btnNotConfirm" style="margin-left: 30px">
		  
		  <input type="submit" value="Delete" name="btnDelete" style="margin-left: 30px" onClick="return confirm('This record will be permanently deleted');">
		  <input type="submit" value="Email" name="btnEmail" style="margin-left: 30px">
			
        </div>
      </form>
    </div>
  </body>
</html>
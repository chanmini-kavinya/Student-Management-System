<?php
ob_start();
require('fpdf17/fpdf.php');
include "connection.php";

class PDF extends FPDF

{
/////
function CheckPageBreak($h)

{       if($this->GetY()+$h>$this->PageBreakTrigger)    
   $this-> AddPage($this->CurOrientation);
}

}
/////////

$pdf = new PDF('P');

//$pdf->AliasNbPages();

$pdf->SetFont('Arial','',10);

$batch=$_GET['id1'];

$con = mysqli_connect($host,$uname,$pwd);
mysqli_select_db($con, $db_name);

$sql="select * from course, batch where course.courseNo=batch.courseNo and batch.batchCode='$batch'";
$result=mysqli_query($con,$sql) or die(mysqli_error($con));
while($row=mysqli_fetch_array($result))
{
	$course=$row['name'];
	$endDate = $row['dateAward'];
}

$tdtaward=date('F-d-Y',strtotime($endDate));

$sql="select * from student inner join studentbatch on student.nic=studentbatch.nic inner join result on student.nic=result.nic where studentbatch.batchCode='$batch' and studentbatch.batchCode=result.batchCode and (result.mid+result.end)/2>=40 and result.abMid!='Y' and result.abEnd!='Y' order by studentbatch.studentNo";
$result=mysqli_query($con,$sql) or die(mysqli_error($con));

while($row=mysqli_fetch_array($result))
{
	if($row['certiNo']=="")
	{
		$sql1 ="select * from result where batchCode='$batch' order by certiNo desc limit 1";
		$result1=mysqli_query($con,$sql1) or die(mysqli_error($con));
		$row1=mysqli_fetch_array($result1);
			
		$maxno = $row1['certiNo'];
				
		if ($maxno == "")
		{
		   $certino = $batch."/001";
		}
		else
		{
			$n=substr($maxno, -3);
		   $certino = $batch."/".str_pad(intval($n)+1,3,0, STR_PAD_LEFT);

		}
		$nic=$row['nic'];
		$sql2 = "UPDATE result SET certiNo='$certino' WHERE nic='$nic' and batchCode='$batch'"; 
 		 $result2=mysqli_query($con,$sql2) or die(mysqli_error($con));
	}
	else
	{
		$certino=$row['certiNo'];
	}
	   $name=$row['fName']." ".$row['lName'];
	   $mark=($row['mid']+$row['end'])/2;
		if ($mark>84)
			$grade='A+';
		elseif ($mark>69)
			$grade='A';
		elseif ($mark>64)
			$grade='A-';
		elseif ($mark>59)
			$grade='B+';
		elseif ($mark>54)
			$grade='B';
		elseif ($mark>49)
			$grade='B-';
		elseif ($mark>44)
			$grade='C+';
		elseif ($mark>39)
			$grade='C';
	
$pdf->AddPage();
$pdf->SetAutoPageBreak(on, 5);

$pdf->SetMargins(5, 2, 5);
$pdf-> Image('images/logo.jpg',90,26,30,30);
$pdf->SetY(10); 
$pdf->SetX(13);
$pdf->multicell(185,274,'',1,L);


$pdf->SetFont('Times','B',20);
$x=16;
$y=63;
$pdf->SetY($y); 
$pdf->SetX($x);
$pdf->multicell(174,7,'SMART START ENGLISH CLUB','',C);
$pdf->SetFont('Times','B',16);
$y=75;
$pdf->SetY($y); 
$pdf->SetX($x);
$pdf->multicell(174,7,'SRI LANKA','',C);

$y=$y+20;
$pdf->SetY($y); 
$pdf->SetX($x);
$pdf->SetFont('Times','B',18);
$temp='Certificate Course in '. $course;
$pdf->multicell(174,7,trim($temp),'',C);

$pdf->SetFont('Times','',16);
$pdf->SetFont('Times','I',16);
$y=$y+20;
$pdf->SetY($y); 
$pdf->SetX($x);
$pdf->multicell(174,7,'This is to certify that','',C);

$pdf->SetFont('Times','B',16);

$y=$y+12;
$pdf->SetY($y); 
$pdf->SetX($x);
$pdf->multicell(174,7,$name,'',C);

$pdf->SetFont('Times','I',16);
$y=$y+14;

$pdf->SetY($y); 
$pdf->SetX($x);
$pdf->multicell(174,7,'has Successfully Completed','',C);
$y=$y+12;
$pdf->SetY($y); 
$pdf->SetX($x);

$l1='the Certificate Course in ' . $course;
$pdf->multicell(174,7,trim($l1),'',C);
$y=$y+12;
$pdf->SetY($y); 
$pdf->SetX($x);
$l2='conducted by this institute.';
$pdf->multicell(174,7,$l2,'',C);

$y=$y+12;
$pdf->SetY($y); 
$pdf->SetX($x);
$l5='Grade obtained - '.$grade;
$pdf->multicell(174,7,$l5,'',C);

$y=$y+12;
$pdf->SetY($y); 
$pdf->SetX($x);
$l6='Duration - '.$duration.' Hours';
$pdf->multicell(174,7,$l6,'',C);
$pdf->SetFont('Times','I',12);
$y=$y+35;
$pdf->SetY($y); 
$pdf->SetX(25);
$pdf->multicell(70,7,$nl1,'',C);
	
$t=$y-20;

$pdf->SetY($y);
		$pdf->SetX(40);
		$pdf-> Image('images/seal.jpg',30,$t,45,45);
	$t=$y-10;
	
	$pdf->SetY($y);
	$pdf->SetX(10);
	$pdf-> Image('images/signature.jpg',140,$t,25,18);
	
	$y=$y+5;
	$pdf->SetFont('Times','',12);
	$pdf->SetY($y);
		$pdf->SetX(132);
		$pdf->Cell(0,5,"....................................");	

$y=$y+5;
	$pdf->SetY($y);
		$pdf->SetX(145);
		$pdf->Cell(3,5,"Director");		
					


$y=$y+28;
$pdf->SetY($y); 
$pdf->SetX(25);
$pdf->SetFont('Times','I',9);
$l1='Date  Award : '.$endDate;
$pdf->multicell(45,7,$l1,'',C);

$pdf->SetY($y); 
$pdf->SetX(80);
$l2='Certificate No. : '.$certino;
$pdf->multicell(45,7,$l2,'',C);
$pdf->SetY($y); 
$pdf->SetX(140);

$pdf->SetFont('Times','I',8);

$y=$y+5;
$pdf->SetY($y); 
$pdf->SetX(30);
$pdf->multicell(250,10,'A+ : 85-100  A : 70-84  A- : 65-69  B+ : 60-64  B : 55-59  B- : 50-54  C+ : 45-49  C : 40-44 ','',L);

}


$pdf->Output();

?>	
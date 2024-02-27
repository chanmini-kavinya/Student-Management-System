<?php
ob_start();
require('fpdf17/fpdf.php');
require_once("phpqrcode/qrlib.php");
include "connection.php";

class PDF extends FPDF

{

function CheckPageBreak($h)

{       if($this->GetY()+$h>$this->PageBreakTrigger)    
   $this-> AddPage($this->CurOrientation);
}

}

/////////
/*
while (ob_get_level())
ob_end_clean();
header("Content-Encoding: None", true);*/



$pdf = new PDF('L','mm',array(81,200));
$pdf->AliasNbPages();

//$pdf->AddPage();

$pdf->SetFont('Arial','',10);

//////////

$batch=$_GET['id1'];

$con = mysqli_connect($host,$uname,$pwd);
mysqli_select_db($con, $db_name);


$sql="select * from course, batch where course.courseNo=batch.courseNo and batch.batchCode='$batch'";
$result=mysqli_query($con,$sql) or die(mysqli_error($con));
while($row=mysqli_fetch_array($result))
{
	$course=$row['name'];
	$duration=$row['duration'];
	$startDate=$row['startDate'];
	$fromTime=$row['fromTime'];
	$toTime=$row['toTime'];
	$difference = round((strtotime($toTime) - strtotime($fromTime))/3600, 1);
	$weeks=$duration/$difference;
	$days=($weeks+2)*7;
	$endDate=date('Y-m-d', strtotime($startDate. " + {$days} days"));
	
}

$y=10;
$sql="select * from student,studentbatch where student.nic=studentbatch.nic and studentbatch.batchCode='$batch' and studentbatch.studentNo!='' order by studentbatch.studentNo";
$result=mysqli_query($con,$sql) or die(mysqli_error($con));

while($row=mysqli_fetch_array($result))
{
	
	   $stdno=$row['studentNo'];
	   $nic=$row['nic'];
	   $fname=$row['fName'];
	   $aLine1=$row['aLine1'];
	   $aLine2=$row['aLine2'];
	   $aLine3=$row['aLine3'];
	   $aLine4=$row['aLine4'];
	   $image=$row['image'];
	
	  $len=strlen($fname);
	  $init=substr($fname,0,1).".";
	  $p=1;
	  $initlen=1;

	  while ($p < $len)
	  {
	   if (substr($fname,$p-1,1) == ' ')
	   {
	   if (substr($fname,$p,1)<>' ' )
		{
		$init=$init . strtoupper(substr($fname,$p,1)) . '.';
		$initlen=$initlen + 2 ;
		}
	   }
	  $p=$p+1;
	  }
	  $init=strtoupper($init);
	
	  $name=$init." ".$row['lName'];
	
	  //create a QR Code and save it as a png image file named test.png
	  QRcode::png($stdno,"test.png");
	
if ($y>250)
{
$pdf->CheckPageBreak($y);
$y=10;
}
$pdf->AddPage();
$y=10;
$pdf->SetY($y); 
$pdf->SetX(10);
$pdf->multicell(90,50,'',1);

$pdf->SetY($y); 
$pdf->SetX(101);
$pdf->multicell(90,50,'',1);
$y=$y+4;
//$this->SetFont('Arial','',10);
$pdf-> Image('student_img/'.$image,14,$y,17.5,22.5);


$pdf->SetFont('Arial','B',10);
$y=$y+3;
$pdf->SetY($y);
		$pdf->SetX(35);
		$pdf->Cell(0,5,"SMART START ENGLISH CLUB");

$pdf->SetFont('Arial','B',9);
$pdf->SetY($y);
		$pdf->SetX(105);
		$pdf->Cell(0,5,"NIC No.  :");

$pdf->SetY($y);
		$pdf->SetX(125);
		$pdf->Cell(0,5,$nic);
	
$pdf->Image("https://smartstartenglishclub.000webhostapp.com/qr.php?code=".$stdno, 165, 11, 25, 25, "png");
	
$pdf->SetFont('Arial','B',10);
$y=$y+7;
$pdf->SetY($y);
		$pdf->SetX(35);
$ts='Course : '. $course;
$pdf->multicell(60,5,$ts);
$pdf->SetFont('Arial','B',9);
$y=$y+4;
$pdf->SetY($y);
		$pdf->SetX(105);
		$pdf->Cell(0,4,"Address  :");


$pdf->SetY($y);
		$pdf->SetX(125);
		$pdf->multicell(100,4,$aLine1);
$y=$y+4;
	
$pdf->SetY($y);
		$pdf->SetX(125);
		$pdf->multicell(100,4,$aLine2);
$y=$y+4;

$pdf->SetY($y);
		$pdf->SetX(125);
		$pdf->multicell(100,4,$aLine3);
$y=$y+4;
	
$pdf->SetY($y);
		$pdf->SetX(125);
		$pdf->multicell(100,4,$aLine4);
	
$pdf->SetFont('Arial','B',10);

$y=$y-2;
$pdf->SetY($y);
		$pdf->SetX(13);
		$pdf->Cell(0,5,"Student No. :");
		
$pdf->SetY($y);
		$pdf->SetX(40);
		$pdf->Cell(0,5,$stdno);


$y=$y+7;		
	$pdf->SetY($y);
		$pdf->SetX(13);
		$pdf->Cell(0,5,"Name           :");
		
$pdf->SetY($y);
		$pdf->SetX(40);
		$pdf->multicell(60,5,$name);
			
	$y=$y+7;
	$pdf->SetY($y);
		$pdf->SetX(13);
		$pdf->Cell(0,5,"Valid till       :");
		
$pdf->SetY($y);
		$pdf->SetX(40);
		$pdf->Cell(0,5,$endDate);
	$t=$y-11;
	
	$pdf-> Image('images/signature.jpg',158,$t,15,12);

$pdf->SetFont('Arial','B',9);
	$pdf->SetY($y);
		$pdf->SetX(136);
		$pdf->Cell(0,5,"Director/Smart Start English Club");		
			
			}

$pdf->Output();

?>
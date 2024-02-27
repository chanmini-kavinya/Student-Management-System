<?php
ob_start();
require('fpdf17/fpdf.php');
include "connection.php";

class PDF extends FPDF

{
/////
///////
function CheckPageBreak($h)

{       if($this->GetY()+$h>$this->PageBreakTrigger)    
   $this-> AddPage($this->CurOrientation);

}
	
function Header()
{
include "connection.php";
$con = mysqli_connect($host,$uname,$pwd);
mysqli_select_db($con, $db_name);
$batch=$_GET['id1'];
$adate=$_GET['id2'];
$sql="select * from course, batch where course.courseNo=batch.courseNo and batch.batchCode='$batch'";
$result=mysqli_query($con,$sql) or die(mysqli_error($con));
while($row=mysqli_fetch_array($result))
{
	$course=$row['name'];
}


$this->SetFont('Arial','UB',12);

///
$this->SetY(10);
		$this->SetX(70);
		$this->Cell(0,5,"SMART START ENGLISH CLUB");
$this->SetFont('Arial','UB',12);
$this->SetY(17);
		$this->SetX(71);
		$this->Cell(0,5,"DAILY ATTENDANCE REPORT");

$this->SetFont('Arial','',10);
$this->SetX(160);
$this->Cell(0,5,'Page '.$this->PageNo().'/{nb}',0,0,'R');

$this->SetFont('Arial','B',10);

$this->SetY(30);
		$this->SetX(10);
$tc='Course : '.$course ;
$tb='Batch : '.$batch ;
$td='Date : '.$adate ;
		$this->Cell(100,5,$tc);


$this->SetY(30);
$this->SetX(115);
$this->Cell(30,5,$tb);

$this->SetY(30);
$this->SetX(165);
$this->Cell(30,5,$td);
	

$y=$y+38;
$this->SetY($y); 
$this->SetX(10);
$this->multicell(10,6,'',1,R);


$this->SetY($y); 
$this->SetX(20);
$this->multicell(30,6,'Student No.',1,C);
$this->SetY($y); 
$this->SetX(50);
$this->multicell(145,6,'Name',1,C);

}
}

$pdf = new PDF('P','mm');

$pdf->AliasNbPages();

$pdf->AddPage();
$pdf->SetFont('Arial','',10);

$sno=0;
$batch=$_GET['id1'];
$adate=$_GET['id2'];
$y=44;

$con = mysqli_connect($host,$uname,$pwd);
mysqli_select_db($con, $db_name);

$sql="select * from student,studentbatch,attendance where student.nic=studentbatch.nic and student.nic=attendance.nic and studentbatch.batchCode=attendance.batchCode and studentbatch.batchCode='$batch' and attendance.date='$adate' and studentbatch.studentNo!='' order by studentbatch.studentNo";
$result=mysqli_query($con,$sql) or die(mysqli_error($con));

while($row=mysqli_fetch_array($result))
{
	   $stdno=$row['studentNo'];
	   $name=$row['fName']." ".$row['lName'];

if ($y>270)
{
$pdf->CheckPageBreak($y);
$y=44;
}

$sno=$sno+1;
$pdf->SetY($y); 
$pdf->SetX(10);
$pdf->multicell(10,6,$sno,'1',R);

$pdf->SetY($y); 
$pdf->SetX(20);
$pdf->multicell(30,6,$stdno,'1',C);
	
$pdf->SetY($y); 
$pdf->SetX(50);
$pdf->multicell(145,6,trim($name),'1',L);

$y +=6;
}


$pdf->Output();

?>
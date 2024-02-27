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


///////
function Header()
{

include "connection.php";
$con = mysqli_connect($host,$uname,$pwd);
mysqli_select_db($con, $db_name);
$batch=$_GET['id1'];

$sql="select * from course, batch where course.courseNo=batch.courseNo and batch.batchCode='$batch'";
$result=mysqli_query($con,$sql) or die(mysqli_error($con));
while($row=mysqli_fetch_array($result))
{
	$course=$row['name'];
}



$this->SetFont('Arial','',8);

///
$y=10;
//$this->SetY(10);
//$this->SetX(175);
//$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');

$this->SetFont('Arial','UB',12);

///
$this->SetY(10);
		$this->SetX(70);
		$this->Cell(0,5,"SMART START ENGLISH CLUB");
	
$this->SetFont('Arial','UB',12);
$this->SetY(17);
		$this->SetX(75);
		$this->Cell(0,5,"COURSE INCOME REPORT");

$this->SetFont('Arial','',10);
$this->SetX(160);
$this->Cell(0,5,'Page '.$this->PageNo().'/{nb}',0,0,'R');

$this->SetFont('Arial','B',10);

$this->SetY(30);
		$this->SetX(10);
$tc='Course  : '.$course ;
$tb='Batch  : '.$batch ;
		$this->Cell(120,5,$tc);


$this->SetY(30);
		$this->SetX(171);

$this->Cell(30,5,$tb);



$y=$y+30;
$this->SetY($y); 
$this->SetX(10);
$this->multicell(10,6,'',1,R);


$this->SetY($y); 
$this->SetX(20);
$this->multicell(30,6,'Student No.',1,C);
$this->SetY($y); 
$this->SetX(50);
$this->multicell(80,6,'Name',1,C);
$this->SetY($y); 
$this->SetX(130);
$this->multicell(35,6,'Date of Payment',1,C);

$this->SetY($y); 
$this->SetX(165);
$this->multicell(30,6,'Amount (Rs.)',1,C);

}

}

/////////

include "connection.php";
$pdf = new PDF('P');

$pdf->AliasNbPages();
$batch=$_GET['id1'];

$pdf->AddPage();

$pdf->SetFont('Arial','',10);

$tot=0;
$y=46;

$sno=0;

$con = mysqli_connect($host,$uname,$pwd);
mysqli_select_db($con, $db_name);

$sql="select * from student,studentbatch,payment where student.nic=studentbatch.nic and student.nic=payment.nic and studentbatch.batchCode='$batch' and studentbatch.batchCode=payment.batchCode and studentbatch.studentNo!='' order by studentbatch.studentNo";
$result=mysqli_query($con,$sql) or die(mysqli_error($con));
$tot=0;
while($row=mysqli_fetch_array($result))
{
	   $stdno=$row['studentNo'];
	   $fname=$row['fName'];
	$lname=$row['lName'];
		$pdate=$row['date'];
		$amount=$row['amount'];
		$tot=$tot+$amount;
	
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

if ($y>265)
{
$pdf->CheckPageBreak($y);

$y=46;
}


$sno=$sno+1;
$pdf->SetY($y); 
$pdf->SetX(10);
$pdf->multicell(10,6,$sno,1,R);

$pdf->SetY($y); 
$pdf->SetX(20);
$pdf->multicell(30,6,$stdno,1,C);

$pdf->SetY($y); 
$pdf->SetX(50);
$pdf->multicell(80,6,$name,1,L);

$pdf->SetY($y); 
$pdf->SetX(130);

$pdf->multicell(35,6,$pdate,1,C);


$pdf->SetY($y); 
$pdf->SetX(165);
$pdf->multicell(30,6,$amount,1,R);

$y +=6;


}
$pdf->SetFont('Arial',B,10);

$pdf->SetY($y); 
$pdf->SetX(10);
$pdf->multicell(155,6,'****  Total  ****',1,R);
$pdf->SetY($y); 
$pdf->SetX(165);
$pdf->multicell(30,6,number_format($tot,2),1,R);


$pdf->Output();

?>
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
		$this->SetX(85);
		$this->Cell(0,5,"RESULT SHEET");

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
$this->multicell(70,6,'Name',1,C);
$this->SetY($y); 
$this->SetX(120);
$this->multicell(20,6,'Mid',1,C);

$this->SetY($y); 
$this->SetX(140);
$this->multicell(20,6,'End',1,C);
$this->SetY($y); 
$this->SetX(160);
$this->multicell(20,6,'Total',1,C);
$this->SetY($y); 
$this->SetX(180);
$this->multicell(20,6,'Grade',1,C);

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

$sql="select * from student,studentbatch,result where student.nic=studentbatch.nic and student.nic=result.nic and studentbatch.batchCode='$batch' and studentbatch.batchCode=result.batchCode and studentbatch.studentNo!='' order by studentbatch.studentNo";
$result=mysqli_query($con,$sql) or die(mysqli_error($con));
$tot=0;
while($row=mysqli_fetch_array($result))
{
	   $stdno=$row['studentNo'];
	   $fname=$row['fName'];
		$lname=$row['lName'];
		$mid=$row['mid'];
		$end=$row['end'];
	    $abm=$row['abMid'];
		$abe=$row['abEnd'];
		$tot=number_format(($mid+$end)/2,0);
		if ($abm=='Y')
		{
			$mid='Ab';
			$tot='-';
			$grade='-';
		}
		else if ($abe=='Y')
		{
			$end='Ab';
			$tot='-';
			$grade='-';
		}
		else if ($tot>84)
			$grade='A+';
		elseif ($tot>69)
			$grade='A';
		elseif ($tot>64)
			$grade='A-';
		elseif ($tot>59)
			$grade='B+';
		elseif ($tot>54)
			$grade='B';
		elseif ($tot>49)
			$grade='B-';
		elseif ($tot>44)
			$grade='C+';
		elseif ($tot>39)
			$grade='C';
	
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
$pdf->multicell(70,6,$name,1,L);

$pdf->SetY($y); 
$pdf->SetX(120);

$pdf->multicell(20,6,$mid,1,C);


$pdf->SetY($y); 
$pdf->SetX(140);
$pdf->multicell(20,6,$end,1,C);

$pdf->SetY($y); 
$pdf->SetX(160);
$pdf->multicell(20,6,$tot,1,C);
	
$pdf->SetY($y); 
$pdf->SetX(180);
$pdf->multicell(20,6,$grade,1,C);

$y +=6;


}

$pdf->Output();

?>
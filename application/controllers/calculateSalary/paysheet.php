<?php
require_once("../../controllers/DBfunctions/DbFunctions.php");
require_once('../../../assets/pdf/fpdf.php');

//Sanitize input data using PHP filter_var().

$Ref_id      = filter_var($_GET["refname"], FILTER_SANITIZE_STRING);
$datestart        = filter_var($_GET["CurrentDatestart"]);
$Bonus      = abs(filter_var($_GET["Amount"], FILTER_SANITIZE_STRING));
$telephoneCost = abs(filter_var($_GET["Tchargers"], FILTER_SANITIZE_STRING));


//echo $Ref_id.$datestart.$Bonus;

//$db->beginTransaction();

$salary = $db->query("SELECT * FROM Transaction WHERE DATE_FORMAT(Time_Stamp,'%Y-%m') = :yermonth and ref_id = :ref_id",array("yermonth"=>$datestart,"ref_id"=>$Ref_id));

$missing = $db->query("SELECT * FROM Missing WHERE DATE_FORMAT(Time_Stamp,'%Y-%m') = :yermonth and ref_id = :ref_id",array("yermonth"=>$datestart,"ref_id"=>$Ref_id));

$advance = $db->query("SELECT * FROM Advances WHERE DATE_FORMAT(Time_stamp,'%Y-%m') = :yermonth and ref_id = :ref_id",array("yermonth"=>$datestart,"ref_id"=>$Ref_id));


$name = getrefName($Ref_id);
$totalSalary = 0;
$totalCommision = 0;
$totalMissings = 0;
$totalAdvaces = 0;


//echo "Commision<br>";
foreach ($salary as $srow){
    $totalCommision += $srow['commission'];

}

//echo "Missings<br>";
foreach ($missing as $mrow){
    $totalMissings += $mrow['totalMissingcost'];

}

//echo "Advances<br>";
foreach ($advance as $arow){
    $totalAdvaces += $arow['Amount'];

}
//echo "<br>Total salary : $totalSalary.$totalDeductions.$totalAdditions";

$SalesCommision = $totalCommision - $totalMissings;


// 500 for telephone allowance
$totalAdditions = $SalesCommision + $Bonus + 500;

$totalDeductions =  $totalAdvaces + $telephoneCost;

$totalSalary = $totalAdditions - $totalDeductions;




//$db->commit();




class PDF extends FPDF
{
// Page header
    function Header()
    {
        // Logo
        //$this->Image('logo.png',10,6,30);
        // Arial bold 15
        $this->SetFont('Arial','B',20);
        // Move to the right
        $this->Cell(75);
        // Title
        $this->Cell(40,5,'Selikno Holding (PVT) Ltd.',0,1,'C');
        // Move to the right
        $this->Cell(73);
        // Title
        $this->SetFont('Arial','B',12);
        $this->Cell(40,10,'THE WAY TO THE SUCCESS',0,1,'C');

        $this->Cell(73);
        $this->SetFont('Arial','',8);
        $this->Cell(40,1,' No.65,parm grow av,3rd lane,Rathmalana.',0,1,'C');
        // Line break
        $this->Ln(5);
    }

// Page footer
    function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Text color in gray
        $this->SetTextColor(128);
        // Page number
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }

    function ChapterTitle($label)
    {
        // Arial 12
        $this->SetFont('Arial','',14);
        // Background color
        $this->SetFillColor(200,220,255);
        // Title

        $this->Cell(15);
        $this->Cell(160,6,"$label",0,0,'L',true);
        // Line break
        $this->Ln(8);
    }

    // Load data
    function LoadData($file)
    {
        // Read file lines
        $lines = file($file);
        $data = array();
        foreach($lines as $line)
            $data[] = explode(';',trim($line));
        return $data;
    }



    function FancyTable2($header, $data,$margin,$totalAddition,$totaldeduction,$netTotal)
    {
        // Colors, line width and bold font
        $this->SetFillColor(100);
        $this->SetTextColor(255);
        $this->SetDrawColor(100);
        $this->SetLineWidth(.3);
        $this->SetFont('Times','',11);;
        $this->Cell($margin);
        // Header
        $w = array(40, 35, 40, 45);
        for($i=0;$i<count($header);$i++)
            $this->Cell($w[$i],6,$header[$i],1,0,'C',true);
        $this->Ln();
        // Color and font restoration
        $this->SetFillColor(230);
        $this->SetTextColor(0);
        $this->SetFont('Times','',10);
        // Data
        $fill = false;

        foreach($data as $row)
        {   $this->Cell($margin);
            $this->Cell($w[0],6,$row[0],'LR',0,'L',$fill);

            $this->Cell($w[1],6,number_format($row[1],2, '.', ','),'LR',0,'R',$fill);

            $this->Cell($w[2],6,$row[2],'LR',0,'L',$fill);

            $this->Cell($w[3],6,number_format($row[3],2, '.', ','),'LR',0,'R',$fill);

            $this->Ln();
            $fill = !$fill;
        }
        $this->Cell($margin);
        $this->Cell($w[0],6,"Target commision",'LR',0,'L',$fill);

        global $Bonus;

        $this->Cell($w[1],6,number_format($Bonus,2, '.', ','),'LR',0,'R',$fill);

        $this->Cell($w[2],6,"",'LR',0,'L',$fill);

        $this->Cell($w[3],6,"",'LR',0,'R',$fill);

        $this->Ln();
        $fill = !$fill;




        $this->Cell($margin);
        $this->Cell($w[0],6,"",'LR',0,'L',$fill);

        $this->Cell($w[1],6,"",'LR',0,'R',$fill);

        $this->Cell($w[2],6,"",'LR',0,'L',$fill);

        $this->Cell($w[3],6,"",'LR',0,'R',$fill);

        $this->Ln();
        $fill = !$fill;


        $this->Cell($margin);
        $this->Cell($w[0],6,"Total Addition",'LR',0,'L',$fill);

        $this->Cell($w[1],6,number_format($totalAddition,2, '.', ','),'LR',0,'R',$fill);

        $this->Cell($w[2],6,"Total Deduction",'LR',0,'L',$fill);

        $this->Cell($w[3],6,number_format($totaldeduction,2, '.', ','),'LR',0,'R',$fill);

        $this->Ln();

        $fill = !$fill;


        $this->Cell($margin);
        $this->Cell($w[0],6,"",'LR',0,'L',$fill);

        $this->Cell($w[1],6,"",'LR',0,'R',$fill);

        $this->Cell($w[2],6,"",'LR',0,'L',$fill);

        $this->Cell($w[3],6,"",'LR',0,'R',$fill);

        $this->Ln();
        //$fill = !$fill;


        $this->SetFillColor(100);
        $this->SetTextColor(255);
        $this->Cell($margin);
        $this->Cell($w[0],6,"",'LR',0,'L',true);

        $this->Cell($w[1],6,"",'LR',0,'R',true);

        $this->Cell($w[2],6,"NET Salary",'LR',0,'L',true);

        $this->Cell($w[3],6,number_format($netTotal,2, '.', ','),'LR',0,'R',true);

        $this->Ln();
        $fill = !$fill;
        $this->SetTextColor(0);
        // Closing line
        $this->Cell($margin);
        $this->Cell(array_sum($w),0,'','T');
        $this->Ln(15);
    }








}

// Instanciation of inherited class
$pdf = new PDF('P','mm','A4');
$pdf->AliasNbPages();
$pdf->AddPage();


$pdf->ChapterTitle("Salary Slip");

$pdf->Ln(5);
$pdf->Cell(15);
$pdf->SetFont('Times','',11);
$pdf->Cell(40,0,"Employee Name",0,1);
$pdf->Cell(50);
$pdf->Cell(40,0,":  Mr.$name",0,1);

$pdf->Ln(5);
$pdf->Cell(15);
$pdf->Cell(40,0,"Designation ",0,1);
$pdf->Cell(50);
$pdf->Cell(40,0,":  Sales Representative",0,1);

$pdf->Ln(5);
$pdf->Cell(15);
$pdf->Cell(40,0,"Year & Month",0,1);
$pdf->Cell(50);
$temp = mktime(0,0,0,10,3,1975);
//$datestart  = date("F-Y",$temp);

$new = strtotime($datestart);
$datestart  = date("F-Y",$new);

$pdf->Cell(40,0,":  $datestart",0,1);

$pdf->Ln(15);


////////

// Column headings
//$header = array('Earnings', 'Rs', 'Deductions', 'Rs');
// Data loading
//$data = $pdf->LoadData('countries.txt');
//$pdf->FancyTable($header,$data,15);
//$pdf->Ln(4);


// Column headings
$header = array('Earnings', 'Rs', 'Deductions', 'Rs');
// Data loading

$data2 = array();

$data2[] = array("Sales Commissions",$SalesCommision,"Salary Advances",$totalAdvaces);
//$data2[] = array("Bonus",$Bonus,"Missing",$totalMissings);
$data2[] = array("Telephon allowanc",500,"Telephone Cost",$telephoneCost);

$data2[] = array("Other Earnings",0,"No pay deduction ",0);



//$data = $pdf->LoadData('countries2.txt');
$pdf->FancyTable2($header,$data2,15,$totalAdditions,$totalDeductions,$totalSalary);
$pdf->Ln(4);




////
$pdf->Cell(15);
$pdf->SetFont('Times','',11);
$pdf->Cell(40,5,'Date                     :',0,1);
$pdf->Ln(30);
////






/////
$pdf->Cell(38);
$pdf->Cell(40,0,'..............................',0,1);
$pdf->Cell(115);
$pdf->Cell(40,0,'...............................',0,1);
$pdf->Ln(4);
$pdf->Cell(45);
$pdf->Cell(40,0,'Employee',0,1);
$pdf->Cell(117);
$pdf->Cell(40,0,'Head of Account ',0,1);
/////


//for($i=1;$i<=40;$i++)
    //$pdf->Cell(0,10,'Printing line number '.$i,0,1);
$pdf->Output('D',"Salary_Slip_$name.pdf");

?>
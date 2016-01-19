<?php
require_once("../../controllers/DBfunctions/DbFunctions.php");
require_once('../../../assets/pdf/fpdf.php');

//Sanitize input data using PHP filter_var().

$Ref_id      = filter_var($_GET["refname"], FILTER_SANITIZE_STRING);
$datestart        = filter_var($_GET["CurrentDatestart"]);
$Bonus      = abs(filter_var($_GET["Amount"], FILTER_SANITIZE_STRING));
$telephoneCost = abs(filter_var($_GET["Tchargers"], FILTER_SANITIZE_STRING));



$commisionn = getMonthlySaleSummary($Ref_id,$datestart);
$missingss = getMissingSummary($Ref_id,$datestart);
//$advance = getTotaladvance($Ref_id,$datestart);
$productinfo = getProductInfo();

$name = getrefName($Ref_id);


/////// sales tabale totales
$totalSales = 0;
$totalReturn = 0;
$totalCommission = 0;
/////


/// missings table total

$totalMssings = 0;
$totalMissingsCost = 0;

////













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
        $this->SetFont('Arial','',12);
        // Background color
        $this->SetFillColor(200,220,255);
        // Title

        $this->Cell(15);
        $this->Cell(160,5,"$label",0,0,'L',true);
        // Line break
        $this->Ln(8);
    }

    function ChapterTitle2($label,$lable2)
    {
        // Arial 12
        $this->SetFont('Arial','',11);
        // Background color
        $this->SetFillColor(200,220,255);
        // Title

        $this->Cell(15);
        $this->Cell(160,5,"$label      :    Rs.".number_format($lable2,2, '.', ','),0,0,'R',true);
        //$this->Cell(160,6,"$label",0,0,'L',true);
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



    function FancyTable2($header, $data,$margin)
    {
        // Colors, line width and bold font
        $this->SetFillColor(100);
        $this->SetTextColor(255);
        $this->SetDrawColor(100);
        $this->SetLineWidth(.3);
        $this->SetFont('Times','',11);;
        $this->Cell($margin);
        // Header
        $w = array(25, 25, 20,20, 25);
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

            $this->Cell($w[2],6,$row[2],'LR',0,'R',$fill);

            $this->Cell($w[3],6,$row[3],'LR',0,'R',$fill);

            $this->Cell($w[4],6,number_format($row[4],2, '.', ','),'LR',0,'R',$fill);

            $this->Ln();
            $fill = !$fill;
        }


        global $totalCommission;
        global $totalReturn;
        global $totalSales;

        $this->SetFillColor(100);
        $this->SetTextColor(255);
        $this->Cell($margin);
        $this->Cell($w[0],6,"",'LR',0,'L',true);

        $this->Cell($w[1],6,"Total",'LR',0,'C',true);

        $this->Cell($w[2],6,$totalSales,'LR',0,'R',true);

        $this->Cell($w[3],6,$totalReturn,'LR',0,'R',true);

        $this->Cell($w[4],6,number_format($totalCommission,2, '.', ','),'LR',0,'R',true);

        $this->Ln();
        $fill = !$fill;
        $this->SetTextColor(0);


        // Closing line
        $this->Cell($margin);
        $this->Cell(array_sum($w),0,'','T');
        $this->Ln(0);


    }

    function FancyTable3($header, $data,$margin)
    {
        // Colors, line width and bold font
        $this->SetFillColor(100);
        $this->SetTextColor(255);
        $this->SetDrawColor(100);
        $this->SetLineWidth(.3);
        $this->SetFont('Times','',11);;
        $this->Cell($margin);
        // Header
        $w = array(25, 35, 20, 35);
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

            $this->Cell($w[2],6,$row[2],'LR',0,'R',$fill);

            //$this->Cell($w[3],6,$row[3],'LR',0,'R',$fill);

            $this->Cell($w[3],6,number_format($row[3],2, '.', ','),'LR',0,'R',$fill);

            $this->Ln();
            $fill = !$fill;
        }



        global $totalMssings;
        global $totalMissingsCost;


        $this->SetFillColor(100);
        $this->SetTextColor(255);
        $this->Cell($margin);
        $this->Cell($w[0],6,"",'LR',0,'L',true);

        $this->Cell($w[1],6,"Total",'LR',0,'C',true);

        $this->Cell($w[2],6,$totalMssings,'LR',0,'R',true);

        //$this->Cell($w[3],6,$totalReturn,'LR',0,'R',true);

        $this->Cell($w[3],6,number_format($totalMissingsCost,2, '.', ','),'LR',0,'R',true);

        $this->Ln();
        $fill = !$fill;
        $this->SetTextColor(0);


        // Closing line
        $this->Cell($margin);
        $this->Cell(array_sum($w),0,'','T');
        $this->Ln(0);


    }








}

// Instanciation of inherited class
$pdf = new PDF('P','mm','A4');
$pdf->AliasNbPages();
$pdf->AddPage();


$pdf->ChapterTitle("Performance Sheet");

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

$datestart  = date("F-Y",strtotime($datestart));
$pdf->Cell(40,0,":  $datestart",0,1);

$pdf->Ln(15);


$pdf->ChapterTitle("Sales and Return Summary");
$pdf->Ln(5);

// Column headings
$header = array('Item', 'Commission', 'Sales','Returns', 'Value');
// Data loading

$data2 = array();




foreach ($commisionn as $srow){
    //$totalCommision += $srow['commission'];
    $data2[] = array($productinfo[$srow['product_id']]['Product_Name'],$productinfo[$srow['product_id']]['Commision'],$srow['SUM(selles)'],$srow['SUM(returns)'],$srow['SUM(commission)']);
    $totalSales += $srow['SUM(selles)'];
    $totalReturn += $srow['SUM(returns)'];
    $totalCommission += $srow['SUM(commission)'];
}


$pdf->FancyTable2($header,$data2,35);
$pdf->Ln(5);



if (!empty($missingss)){

    $pdf->ChapterTitle("Missing Summary");
    $pdf->Ln(5);

// Column headings
    $header2 = array('Item', 'Selling Price', 'Amount','Value');

    $data3 = array();


    foreach ($missingss as $mrow){
        $data3[] = array($productinfo[$mrow['Product_id']]['Product_Name'],$productinfo[$mrow['Product_id']]['Selling_price'],$mrow['SUM(NoOfItem)'],$mrow['SUM(totalMissingcost)']);
        $totalMssings += $mrow['SUM(NoOfItem)'];
        $totalMissingsCost += $mrow['SUM(totalMissingcost)'];
    }

    $pdf->FancyTable3($header2,$data3,35);
    $pdf->Ln(5);
}

$subTotalll = $totalCommission - $totalMissingsCost;
$pdf->ChapterTitle2("SUB TOTAL",$subTotalll);
$pdf->Ln(5);




/*

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
*/

$pdf->Output('D',"Performances_sheet_$name.pdf");

?>
<?php
/**
 * Created by IntelliJ IDEA.
 * User: chamathsilva
 * Date: 1/17/16
 * Time: 11:59 PM
 */



require('../../../assets/pdf/fpdf.php');




class PDF extends FPDF
{
// Page header
    function Header()
    {
        // Logo
        $this->Image('logo.png',10,6,30);
        // Arial bold 15
        $this->SetFont('Arial','B',9);
        // Move to the right
        $this->Cell(80);
        // Title
        $this->Cell(40,10,'Salary-Sheet',0,1,'C');
        // Line break
        $this->Ln(20);
    }

// Page footer
    function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Page number
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }
}

// Instanciation of inherited class
$pdf = new PDF('P','mm','A4');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);
$pdf->Cell(40,10,'Employee Name : test ',0,1);
$pdf->Cell(40,0,'Month                 : test',0,1);


for($i=1;$i<=40;$i++)
    $pdf->Cell(0,10,'Printing line number '.$i,0,1);
$pdf->Output();
?>
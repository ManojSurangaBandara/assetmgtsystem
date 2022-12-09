<?php

//require('../fpdf17/fpdf.php');

class PDF_S extends FPDF {

    // Page header
    function Header() {
        global $assetscenter;
        global $assetunit;
        global $currentYear;
        global $disposal;
        $this->SetFont('Times', 'B', 15);
        // Move to the right
        $this->Cell(1);
        // Title
        $TT =  ($disposal == 1 ? '  - DISPOSALS' : ' ');
        $this->Cell(0, 0, 'PLANT AND MACHINARY ASSETS' . $TT, 0, 0, 'L');
        $this->SetFont('Times', 'B', 12);
        $this->Ln(6);
        $this->Cell(0, 0, 'Assest Year      : ' . $currentYear , 0, 0, 'L');
        $this->Ln(6);
        $this->Cell(0, 0, 'Assets Centre    : ' . $assetscenter, 0, 0, 'L');
        $this->Ln(6);
        $this->Cell(0, 0, 'Assets HQ/Unit   : ' . $assetunit, 0, 0, 'L');
        $header = array('SNo', 'Category', 'Description', 'Calalogue No', 'Quantity', 'Value');
        // Line break
        $this->Ln(6);
        $this->SetFillColor(200, 0, 0);
        $this->SetTextColor(255);
        $this->SetDrawColor(128, 0, 0);
        $this->SetLineWidth(.1);
        $this->SetFont('Times', 'B', 10);
        // Header
        $w = array(10, 50, 140, 25, 20, 30);
        for ($i = 0; $i < count($header); $i++)
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', true);
        $this->Ln();
    }

// Page footer
    function Footer() {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Times', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page ' . $this->PageNo(), 0, 0, 'C');
     //   $this->Cell(0, 10, 'Printed Date :' . date('F j, Y'), 0, 0, 'R');
    }

    function FancyTable($header, $data) {
        // Colors, line width and bold font
        global $disposal;
        $this->SetFillColor(200, 0, 0);
        $this->SetTextColor(255);
        $this->SetDrawColor(128, 0, 0);
        $this->SetLineWidth(.1);
        $this->SetFont('', 'B');
        // Header
        $w = array(10, 50, 140, 25, 20, 30);
        //  for ($i = 0; $i < count($header); $i++)
        //       $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', true);
        // $this->Ln();
        // Color and font restoration
        $this->SetFillColor(224, 235, 255);
        $this->SetTextColor(0);
        $this->SetFont('', '');
        // Data
        $fill = false;
        $i = 0;
        foreach ($data as $row) {
            $i++;
			$this->Cell($w[0], 6, $i, 'LR', 0, 'R', $fill);
            $this->Cell($w[1], 6, $row['itemCategory'], 'LR', 0, 'L', $fill);
            $this->Cell($w[2], 6, $row['itemDescription'], 'LR', 0, 'L', $fill);
            $this->Cell($w[3], 6, $row['catalogueno'], 'LR', 0, 'C', $fill);
			$this->Cell($w[4], 6, number_format($row['quantity'], 0), 'LR', 0, 'R', $fill);
            $this->Cell($w[5], 6, number_format($row['totalcost'], 2), 'LR', 0, 'R', $fill);
            $this->Ln();
            $fill = !$fill;
        }
        // Closing line
        $this->Cell(array_sum($w), 0, '', 'T');
    }
    

}

$pdf = new PDF_S('L', 'mm', 'A4');
// $pdf = new PDF();
// Column headings
$header = array('SNo', 'Category', 'Description', 'Calalogue No', 'Quantity', 'Value');
// Data loading
$data = $items_s;
$title = "aaaa";

$pdf->SetFont('Times', '', 10);
$pdf->AddPage();
$pdf->FancyTable($header, $items_s);
$YY = $pdf->GetY();	
$pdf->SetY($YY + 10);
        $pdf->SetX(10);
	$pdf->Cell(40,10,"CERTIFIED CORRECT");
        $pdf->SetX(120);
        $pdf->Cell(40,10,"CERTIFIED CORRECT");
        $pdf->SetX(220);
        $pdf->Cell(40,10,"CHECKED AND FOUND CORRECT");
$YY = $pdf->GetY();	        
        $pdf->SetY($YY + 20);
        $pdf->SetX(10);
	$pdf->Cell(60,10,"..........................................................");
        $pdf->SetX(120);
        $pdf->Cell(60,10,"..........................................................");
        $pdf->SetX(220);
        $pdf->Cell(60,10,"..........................................................");
$YY = $pdf->GetY();		
        $pdf->SetY($YY + 5);
	$pdf->SetX(10);
	$pdf->Cell(40,10,$boardMemberName3);
        $pdf->SetX(120);
        $pdf->Cell(40,10,$boardMemberName2);
        $pdf->SetX(220);
        $pdf->Cell(40,10,$boardMemberName1);
		$YY = $pdf->GetY();		
        $pdf->SetY($YY + 5);
	$pdf->SetX(10);
	$pdf->Cell(40,10,$boardMemberRank3);
        $pdf->SetX(120);
        $pdf->Cell(40,10,$boardMemberRank2);
        $pdf->SetX(220);
        $pdf->Cell(40,10,$boardMemberRank1);
		$YY = $pdf->GetY();		
        $pdf->SetY($YY + 5);
	$pdf->SetX(10);
	$pdf->Cell(40,10,$boardMemberNumber3);
        $pdf->SetX(120);
        $pdf->Cell(40,10,$boardMemberNumber2);
        $pdf->SetX(220);
        $pdf->Cell(40,10,$boardMemberNumber1);
$pdf->Output('Plant and Machinary Summary' . '.pdf', 'D');
$pdf->Output($filename, 'F');
?>      
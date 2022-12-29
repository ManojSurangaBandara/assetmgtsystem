<?php

require('../fpdf185/fpdf.php');

class PDF extends FPDF {

    // Page header
    function Header() {
        // Logo
        //$this->Image('logo.png',10,6,30);
        // Arial bold 15
        global $assetscenter;
        global $assetunit;
		global $currentYear;
        $this->SetFont('Times', 'B', 15);
        // Move to the right
        $this->Cell(1);
        // Title
        $this->Cell(0, 0, 'LAND DETAILS', 0, 0, 'L');
        $this->SetFont('Times', 'B', 12);
        $this->Ln(8);
        $this->Cell(0, 0, 'Assest Year      : ' . $currentYear , 0, 0, 'L');
        $this->Ln(8);
        $this->Cell(0, 0, 'Assets Centre    : ' . $assetscenter, 0, 0, 'L');
        $this->Ln(8);
        $this->Cell(0, 0, 'Assets HQ/Unit   : ' . $assetunit, 0, 0, 'L');
        $header = array('S/N', 'Identification No.', 'Category Name', 'District', 'DS Division', 'GS Division', 'Deed Number', 'Land Name', 'Area(Hec)', 'DOR', 'Value');
        // Line break
        $this->Ln(10);
        $this->SetFillColor(200, 0, 0);
        $this->SetTextColor(255);
        $this->SetDrawColor(128, 0, 0);
        $this->SetLineWidth(.1);
        $this->SetFont('Times', 'B', 10);
        // Header
        $w = array(10, 60, 60, 30, 40, 50, 20, 60, 20, 20, 25);
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
        //$this->Cell(0, 10, 'Printed Date :' . date('F j, Y'), 0, 0, 'R');
    }

    function FancyTable($header, $data) {
        // Colors, line width and bold font
        $this->SetFillColor(200, 0, 0);
        $this->SetTextColor(255);
        $this->SetDrawColor(128, 0, 0);
        $this->SetLineWidth(.1);
        $this->SetFont('', 'B');
        // Header
        $w = array(10, 60, 60, 30, 40, 50, 20, 60, 20, 20, 25);
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
            $this->Cell($w[1], 6, $row['identificationno'], 'LR', 0, 'L', $fill);
            $this->Cell($w[2], 6, $row['category'], 'LR', 0, 'L', $fill);
            $this->Cell($w[3], 6, $row['district'], 'LR', 0, 'L', $fill);
            $this->Cell($w[4], 6, $row['dsDivision'], 'LR', 0, 'L', $fill);
            $this->Cell($w[5], 6, $row['gsDivision'], 'LR', 0, 'L', $fill);
            $this->Cell($w[6], 6, $row['deedno'], 'LR', 0, 'R', $fill);
            $this->Cell($w[7], 6, $row['landname'], 'LR', 0, 'L', $fill);
            $this->Cell($w[8], 6, $row['area'], 'LR', 0, 'R', $fill);
            $this->Cell($w[9], 6, $row['acquisitiondate'], 'LR', 0, 'C', $fill);
            //$this->Cell($w[10], 6, number_format((float)$row['quantity'], 2), 'LR', 0, 'R', $fill);
            $this->Cell($w[10], 6, number_format((float)$row['estimatedValue'], 2), 'LR', 0, 'R', $fill);
            //$this->Cell($w[12], 6, number_format((float)$row['totalCost'], 2), 'LR', 0, 'R', $fill);
            $this->Ln();
            $fill = !$fill;
        }
        // Closing line
        $this->Cell(array_sum($w), 0, '', 'T');
    }

}

$pdf = new PDF('L', 'mm', 'A3');
// $pdf = new PDF();
// Column headings
$header = array('SNo', 'Identification No.', 'Category Name', 'District', 'DS Division', 'GS Division', 'Deed Number', 'Land Name', 'Area(Hec)', 'DOR', 'Value');
//$header = array('SNo', 'Identification No.', 'Category', 'Description', 'Asset No', 'Calalogue No', 'Ledger No', 'Folio No', 'DOP', 'DOR', 'Unit Value');
//	  $header = array('Country', 'Capital', 'Area (sq km)', 'Pop. (thousands)');
// Data loading
$data = $items;
//$title = "aaaa";

$pdf->SetFont('Times', '', 10);
$pdf->AddPage();
$pdf->FancyTable($header, $items);
$YY = $pdf->GetY();	
$pdf->SetY($YY + 10);
        $pdf->SetX(10);
	$pdf->Cell(40,10,"CERTIFIED CORRECT");
        $pdf->SetX(180);
        $pdf->Cell(40,10,"CERTIFIED CORRECT");
        $pdf->SetX(340);
        $pdf->Cell(40,10,"CHECKED AND FOUND CORRECT");
$YY = $pdf->GetY();	        
        $pdf->SetY($YY + 20);
        $pdf->SetX(10);
	$pdf->Cell(60,10,"..........................................................");
        $pdf->SetX(180);
        $pdf->Cell(60,10,"..........................................................");
        $pdf->SetX(340);
        $pdf->Cell(60,10,"..........................................................");
$YY = $pdf->GetY();		
        $pdf->SetY($YY + 5);
	$pdf->SetX(10);
	$pdf->Cell(40,10,$boardMemberName3);
        $pdf->SetX(180);
        $pdf->Cell(40,10,$boardMemberName2);
        $pdf->SetX(340);
        $pdf->Cell(40,10,$boardMemberName1);
		$YY = $pdf->GetY();		
        $pdf->SetY($YY + 5);
	$pdf->SetX(10);
	$pdf->Cell(40,10,$boardMemberRank3);
        $pdf->SetX(180);
        $pdf->Cell(40,10,$boardMemberRank2);
        $pdf->SetX(340);
        $pdf->Cell(40,10,$boardMemberRank1);
		$YY = $pdf->GetY();		
        $pdf->SetY($YY + 5);
	$pdf->SetX(10);
	$pdf->Cell(40,10,$boardMemberNumber3);
        $pdf->SetX(180);
        $pdf->Cell(40,10,$boardMemberNumber2);
        $pdf->SetX(340);
        $pdf->Cell(40,10,$boardMemberNumber1);
$pdf->Output('Land Details Details ' . '.pdf', 'D');
$pdf->Output($filename, 'F');
?>      
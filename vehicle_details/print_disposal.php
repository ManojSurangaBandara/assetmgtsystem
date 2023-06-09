<?php

//require('../fpdf185/fpdf.php');

class PDF_DES extends FPDF {

    // Page header
    function Header() {
        // Logo
        //$this->Image('logo.png',10,6,30);
        // Arial bold 15
        global $assetscenter;
        global $assetunit;
        global $currentYear;
        global $disposal;
        $this->SetFont('Times', 'B', 15);
        // Move to the right
        $this->Cell(1);
        // Title
        $this->Cell(0, 0, 'VEHICLE DETAILS - DISPOSALS', 0, 0, 'L');
        $this->SetFont('Times', 'B', 12);
        $this->Ln(6);
        $this->Cell(0, 0, 'Assest Year      : ' . $currentYear , 0, 0, 'L');
        $this->Ln(6);
        $this->Cell(0, 0, 'Assets Centre    : ' . $assetscenter, 0, 0, 'L');
        $this->Ln(6);
        $this->Cell(0, 0, 'Assets HQ/Unit   : ' . $assetunit, 0, 0, 'L');

		$header = array('SNo', 'Identification No.', 'Description', 'Make', 'Fuel','Asset No', 'Engine No', 'Army No', 'Condemnation Board - Ref', 'Disposed Date', 'DOR', 'Unit Value');												
        $this->Ln(6);
        $this->SetFillColor(200, 0, 0);
        $this->SetTextColor(255);
        $this->SetDrawColor(128, 0, 0);
        $this->SetLineWidth(.1);
        $this->SetFont('Times', 'B', 10);
        // Header
        $w = array(10, 60, 80, 35, 15, 15, 45, 20, 50, 20, 20, 25);
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
       // $this->Cell(0, 10, 'Printed Date :' . date('F j, Y'), 0, 0, 'R');
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
        $w = array(10, 60, 80, 35, 15, 15, 45, 20, 50, 20, 20, 25);
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
            $this->Cell($w[2], 6, substr($row['itemDescription'],0,37), 'LR', 0, 'L', $fill);
			$this->Cell($w[3], 6, $row['make'], 'LR', 0, 'L', $fill);
			$this->Cell($w[4], 6, $row['modle'], 'LR', 0, 'L', $fill);
            $this->Cell($w[5], 6, $row['assetsno'], 'LR', 0, 'C', $fill);
            $this->Cell($w[6], 6, $row['engineno'], 'LR', 0, 'L', $fill);
            $this->Cell($w[7], 6, $row['armyno'], 'LR', 0, 'L', $fill);
			$this->Cell($w[8], 6, substr($row['condemnation'],0,21), 'LR', 0, 'L', $fill);
            $this->Cell($w[9], 6, $row['disposedDate'], 'LR', 0, 'C', $fill);
            $this->Cell($w[10], 6, $row['receivedDate'], 'LR', 0, 'C', $fill);
            $this->Cell($w[11], 6, number_format((float)$row['unitValue'], 2), 'LR', 0, 'R', $fill);
            $this->Ln();
            $fill = !$fill;
        }
        // Closing line
        $this->Cell(array_sum($w), 0, '', 'T');
    }
    

}

$pdf_des = new PDF_DES('L', 'mm', 'A3');
$header = array('SNo', 'Identification No.', 'Description', 'Make', 'Fuel','Asset No', 'Engine No', 'Army No', 'Condemnation Board - Ref', 'Disposed Date', 'DOR', 'Unit Value');
$data = $items;
$title = "aaaa";

$pdf_des->SetFont('Times', '', 10);
$pdf_des->AddPage();
$pdf_des->FancyTable($header, $des_items);
$YY = $pdf_des->GetY();	
$pdf_des->SetY($YY + 10);
        $pdf_des->SetX(10);
	$pdf_des->Cell(40,10,"CERTIFIED CORRECT");
        $pdf_des->SetX(180);
        $pdf_des->Cell(40,10,"CERTIFIED CORRECT");
        $pdf_des->SetX(340);
        $pdf_des->Cell(40,10,"CHECKED AND FOUND CORRECT");
$YY = $pdf_des->GetY();	        
        $pdf_des->SetY($YY + 20);
        $pdf_des->SetX(10);
	$pdf_des->Cell(60,10,"..........................................................");
        $pdf_des->SetX(180);
        $pdf_des->Cell(60,10,"..........................................................");
        $pdf_des->SetX(340);
        $pdf_des->Cell(60,10,"..........................................................");
$YY = $pdf_des->GetY();		
        $pdf_des->SetY($YY + 5);
	$pdf_des->SetX(10);
	$pdf_des->Cell(40,10,$boardMemberName3);
        $pdf_des->SetX(180);
        $pdf_des->Cell(40,10,$boardMemberName2);
        $pdf_des->SetX(340);
        $pdf_des->Cell(40,10,$boardMemberName1);
		$YY = $pdf_des->GetY();		
        $pdf_des->SetY($YY + 5);
	$pdf_des->SetX(10);
	$pdf_des->Cell(40,10,$boardMemberRank3);
        $pdf_des->SetX(180);
        $pdf_des->Cell(40,10,$boardMemberRank2);
        $pdf_des->SetX(340);
        $pdf_des->Cell(40,10,$boardMemberRank1);
		$YY = $pdf_des->GetY();		
        $pdf_des->SetY($YY + 5);
	$pdf_des->SetX(10);
	$pdf_des->Cell(40,10,$boardMemberNumber3);
        $pdf_des->SetX(180);
        $pdf_des->Cell(40,10,$boardMemberNumber2);
        $pdf_des->SetX(340);
        $pdf_des->Cell(40,10,$boardMemberNumber1);
//$pdf_des->Output('Vehicle Details ' . '.pdf', 'D');
$pdf_des->Output($filename_des, 'F');
?>      
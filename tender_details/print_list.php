<?php

require('../fpdf17/fpdf.php');

class PDF extends FPDF {

    // Page header
    function Header() {
        // Logo
        //$this->Image('logo.png',10,6,30);
        // Arial bold 15
		global $tenderno;
		global $tplace;
        $this->SetFont('Times', 'B', 15);
        // Move to the right
        $this->Cell(1);
        // Title
        $this->Cell(0, 0, 'TENDER  DETAILS - VEHICLES', 0, 0, 'L');
        $this->SetFont('Times', 'B', 12);
        $this->Ln(8);
        $this->Cell(0, 0, 'Tender Number      : ' . $tenderno , 0, 0, 'L');
        $this->Ln(8);
        $this->Cell(0, 0, 'Unit               : ' . $tplace, 0, 0, 'L');
        $header = array('SNo', 'Lot No.', 'Army No.', 'Vehicle Type', 'Engine No.', 'Chassis Number', 'Estimate Value', 'Tender Value', 'Buyer Name', 'Buyer Address', 'Buyer NIC No.');
        // Line break
        $this->Ln(5);
        $this->SetFillColor(200, 0, 0);
        $this->SetTextColor(255);
        $this->SetDrawColor(128, 0, 0);
        $this->SetLineWidth(.1);
        $this->SetFont('Times', 'B', 10);
        // Header
        $w = array(10, 15, 20, 50, 50, 50, 30, 30, 50, 70, 25);
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
        $w = array(10, 15, 20, 50, 50, 50, 30, 30, 50, 70, 25);
        $this->SetFillColor(224, 235, 255);
        $this->SetTextColor(0);
        $this->SetFont('', '');
        // Data
        $fill = false;
        $i = 0;
        foreach ($data as $row) {
            $i++;
            $this->Cell($w[0], 6, $i, 'LR', 0, 'R', $fill);
            $this->Cell($w[1], 6, $row['lotno'], 'LR', 0, 'R', $fill);
            $this->Cell($w[2], 6, $row['armyno'], 'LR', 0, 'L', $fill);
            $this->Cell($w[3], 6, $row['itemDescription'], 'LR', 0, 'L', $fill);
            $this->Cell($w[4], 6, $row['engineno'], 'LR', 0, 'L', $fill);
            $this->Cell($w[5], 6, $row['chessisno'], 'LR', 0, 'L', $fill);
            $this->Cell($w[6], 6, $row['estimatevalue'], 'LR', 0, 'R', $fill);
            $this->Cell($w[7], 6, $row['tendervalue'], 'LR', 0, 'R', $fill);
            $this->Cell($w[8], 6, $row['buyername'], 'LR', 0, 'L', $fill);
            $this->Cell($w[9], 6, $row['buyeraddress'], 'LR', 0, 'L', $fill);
            $this->Cell($w[10], 6,$row['buyernicno'], 'LR', 0, 'L', $fill);
            $this->Ln();
            $fill = !$fill;
        }
        // Closing line
        $this->Cell(array_sum($w), 0, '', 'T');
    }

}

$pdf = new PDF('L', 'mm', 'A3');
$header = array('SNo', 'Lot No.', 'Army No.', 'Vehicle Type', 'Engine No.', 'Chassis Number', 'Estimate Value', 'Tender Value', 'Buyer Name', 'Buyer Address', 'Buyer NIC No.');
$data = $exps;

$pdf->SetFont('Times', '', 10);
$pdf->AddPage();
$pdf->FancyTable($header, $exps);
$pdf->Output('Land Details Details ' . '.pdf', 'D');
?>      
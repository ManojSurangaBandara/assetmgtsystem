<?php

require('../fpdf17/fpdf.php');

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
        $this->Cell(0, 0, 'Fixed Assets Details List', 0, 0, 'L');
        $this->SetFont('Times', 'B', 12);
        $this->Ln(2);
        $header = array('SNo', 'Main Category.', 'Item Category', 'Description', 'Make', 'Modle', 'vote Head', 'new Assestno', 'assets no', 'Catalogue No');
        // Line break
        $this->Ln(10);
        $this->SetFillColor(200, 0, 0);
        $this->SetTextColor(255);
        $this->SetDrawColor(128, 0, 0);
        $this->SetLineWidth(.1);
        $this->SetFont('Times', 'B', 10);
        // Header
        $w = array(10, 80, 60, 100, 40, 40, 10, 20, 20, 20);
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
        $this->SetFillColor(200, 0, 0);
        $this->SetTextColor(255);
        $this->SetDrawColor(128, 0, 0);
        $this->SetLineWidth(.1);
        $this->SetFont('', 'B');
        // Header
        $w = array(10, 80, 60, 100, 40, 40, 10, 20, 20, 20);
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
			//substr("Hello world",0,10)
            $this->Cell($w[1], 6, substr($row['mainCategory'],0,35), 'LR', 0, 'L', $fill);
            $this->Cell($w[2], 6, substr($row['itemCategory'],0,29), 'LR', 0, 'L', $fill);
            $this->Cell($w[3], 6, substr($row['itemDescription'],0,45), 'LR', 0, 'L', $fill);
            $this->Cell($w[4], 6, $row['make'], 'LR', 0, 'L', $fill);
            $this->Cell($w[5], 6, substr($row['modle'],0,18), 'LR', 0, 'L', $fill);
            $this->Cell($w[6], 6, $row['voteHead'], 'LR', 0, 'C', $fill);
            $this->Cell($w[7], 6, $row['newAssestno'], 'LR', 0, 'C', $fill);
            $this->Cell($w[8], 6, $row['assetsno'], 'LR', 0, 'C', $fill);
            $this->Cell($w[9], 6, $row['catalogueno'], 'LR', 0, 'C', $fill);
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
$pdf->Output('Fixed Assets Details List' . '.pdf', 'D');
?>      
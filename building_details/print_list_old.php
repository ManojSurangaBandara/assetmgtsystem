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
        $this->SetFont('Times', 'B', 15);
        // Move to the right
        $this->Cell(1);
        // Title
        $this->Cell(0, 0, 'BUILDING DETAILS', 0, 0, 'L');
        $this->SetFont('Times', 'B', 12);
        $this->Ln(8);
        $this->Cell(0, 0, 'Assest Year      : 2014', 0, 0, 'L');
        $this->Ln(8);
        $this->Cell(0, 0, 'Assets Centre    : ' . $assetscenter, 0, 0, 'L');
        $this->Ln(8);
        $this->Cell(0, 0, 'Assets HQ/Unit   : ' . $assetunit, 0, 0, 'L');
        $header = array('SNo', 'Identification No.', 'Building Category', 'Building Type', 'Name of Land', 'District', 'DS Division', 'Area (sqrt)', 'Construction Cost', 'Building Value', 'DOR', 'Name of the Owner');
        // Line break
        $this->Ln(10);
        $this->SetFillColor(200, 0, 0);
        $this->SetTextColor(255);
        $this->SetDrawColor(128, 0, 0);
        $this->SetLineWidth(.1);
        $this->SetFont('Times', 'B', 10);
        // Header
        $w = array(10, 55, 40, 40, 45, 30, 30, 20, 30, 30, 20, 50);
        for ($i = 0; $i < count($header); $i++)
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', true);
        $this->Ln();
    }

// Page footer
                function Footer() {
                    // Position at 1.5 cm from bottom
                    $this->SetY(-15);
                    // Arial italic 8
                    $this->SetFont('Arial', 'I', 8);
                    // Page number
                    $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
                }

                function FancyTable($header, $data) {
                    // Colors, line width and bold font
                    $this->SetFillColor(200, 0, 0);
                    $this->SetTextColor(255);
                    $this->SetDrawColor(128, 0, 0);
                    $this->SetLineWidth(.3);
                    $this->SetFont('', 'B');
                    // Header
                    $w = array(10, 55, 40, 40, 45, 30, 30, 20, 30, 30, 20, 50);
                    for ($i = 0; $i < count($header); $i++)
                        $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', true);
                    $this->Ln();
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
                        $this->Cell($w[2], 6, $row['buildingCategory'], 'LR', 0, 'L', $fill);
                        $this->Cell($w[3], 6, $row['buildingType'], 'LR', 0, 'L', $fill);
                        $this->Cell($w[4], 6, $row['landname'], 'LR', 0, 'L', $fill);
                        $this->Cell($w[5], 6, $row['district'], 'LR', 0, 'L', $fill);
                        $this->Cell($w[6], 6, $row['dsDivision'], 'LR', 0, 'L', $fill);
                        $this->Cell($w[7], 6, number_format((float)$row['area'], 2), 'LR', 0, 'R', $fill);
                        $this->Cell($w[8], 6, number_format((float)$row['constructionCost'], 2), 'LR', 0, 'R', $fill);
                        $this->Cell($w[9], 6, number_format((float)$row['alterationValue'], 2), 'LR', 0, 'R', $fill);
                        $this->Cell($w[10], 6, $row['acquisitiondate'], 'LR', 0, 'C', $fill);
                        $this->Cell($w[11], 6, $row['ownerName'], 'LR', 0, 'L', $fill);
                        //  $this->Cell($w[2], 6, number_format((float)$row[2]), 'LR', 0, 'R', $fill);
                        //  $this->Cell($w[3], 6, number_format((float)$row[3]), 'LR', 0, 'R', $fill);
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
            $header = array('SNo', 'Identification No.', 'Building Category', 'Building Type', 'Name of Land', 'District', 'DS Division', 'Area (sqrt)', 'Construction Cost', 'Building Value', 'DOR', 'Name of the Owner');
            //	  $header = array('Country', 'Capital', 'Area (sq km)', 'Pop. (thousands)');
// Data loading
            $data = $items;
            $pdf->SetFont('Times', '', 10);
            $pdf->AddPage();
            $pdf->FancyTable($header, $data);
			$YY = $pdf->GetY();	
$pdf->SetY($YY + 10);
        $pdf->SetX(10);
	$pdf->Cell(40,10,"CERTIFIED CORRECT");
        $pdf->SetX(180);
        $pdf->Cell(40,10,"CERTIFIED CORRECT");
        $pdf->SetX(340);
        $pdf->Cell(40,10,"CHECKED AND FOUND CORRECT");
        
        $pdf->SetY($YY + 30);
        $pdf->SetX(10);
	$pdf->Cell(60,10,"..........................................................");
        $pdf->SetX(180);
        $pdf->Cell(60,10,"..........................................................");
        $pdf->SetX(340);
        $pdf->Cell(60,10,"..........................................................");
        $pdf->SetY($YY + 34);
	$pdf->SetX(10);
	$pdf->Cell(40,10,$boardMemberName1);
        $pdf->SetX(180);
        $pdf->Cell(40,10,$boardMemberName2);
        $pdf->SetX(340);
        $pdf->Cell(40,10,$boardMemberName3);
        $pdf->SetY($YY + 38);
	$pdf->SetX(10);
	$pdf->Cell(40,10,$boardMemberRank1);
        $pdf->SetX(180);
        $pdf->Cell(40,10,$boardMemberRank2);
        $pdf->SetX(340);
        $pdf->Cell(40,10,$boardMemberRank3);
        $pdf->SetY($YY + 42);
	$pdf->SetX(10);
	$pdf->Cell(40,10,$boardMemberNumber1);
        $pdf->SetX(180);
        $pdf->Cell(40,10,$boardMemberNumber1);
        $pdf->SetX(340);
        $pdf->Cell(40,10,$boardMemberNumber1);
            $pdf->Output('Building Details Details ' . date('Y-m-d') . '.pdf', 'D');
?>      
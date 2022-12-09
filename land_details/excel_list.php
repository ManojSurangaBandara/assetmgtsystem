<?php
            require_once "../excel/excelexport.php";
            $xls = new ExcelExport();
			$heading = "LAND DETAILS";
			$row = 0;
			$col = 0;			
            $xls->writeCell($heading,$row,$col);
			$row = $row + 1;
			$xls->writeCell("Assest Year      : " . $currentYear ,$row,$col);
			$row++;
			$xls->writeCell("Assets Centre    : " . $assetscenter ,$row,$col);
			$row++;
			$xls->writeCell("Assets HQ/Unit   : " . $assetunit ,$row,$col);
			$row++;
			$header = array('SNo', 'Identification No.', 'Category Name', 'District', 'DS Division', 'GS Division', 'Deed Number', 'Land Name', 'Area(Hec)', 'DOR', 'Value');        
			$xls->addRow($header,$row);
			$row = $row + 1;
            foreach ($items as $exp) {
                $xls->addRow(Array(
				$exp['identificationno'],
            $exp['category'],
            $exp['district'],
            $exp['dsDivision'],
            $exp['gsDivision'],
            $exp['deedno'],
            $exp['landname'],
            $exp['area'], 'LR',
            $exp['acquisitiondate'],
            $exp['estimatedValue']),$row);
            $row++;
			}
			$row = $row + 2;
			$xls->writeCell("CERTIFIED CORRECT",$row,$col);
			$col = $col + 5;
			$xls->writeCell("CERTIFIED CORRECT",$row,$col);
			$col = $col + 5;
			$xls->writeCell("CHECKED AND FOUND CORRECT",$row,$col);
			$row = $row + 3;
			$col = 0;
			$xls->writeCell(".......................................",$row,$col);
			$col = $col + 5;
			$xls->writeCell(".......................................",$row,$col);
			$col = $col + 5;
			$xls->writeCell(".......................................",$row,$col);
			$row = $row + 1;
			$col = 0;
			$xls->writeCell($boardMemberName1,$row,$col);
			$col = $col + 5;
			$xls->writeCell($boardMemberName2,$row,$col);
			$col = $col + 5;
			$xls->writeCell($boardMemberName3,$row,$col);
			$row = $row + 1;
			$col = 0;
			$xls->writeCell($boardMemberRank1,$row,$col);
			$col = $col + 5;
			$xls->writeCell($boardMemberRank2,$row,$col);
			$col = $col + 5;
			$xls->writeCell($boardMemberRank3,$row,$col);
			$row = $row + 1;
			$col = 0;
			$xls->writeCell($boardMemberNumber1,$row,$col);
			$col = $col + 5;
			$xls->writeCell($boardMemberNumber1,$row,$col);
			$col = $col + 5;
			$xls->writeCell($boardMemberNumber1,$row,$col);
            $xls->download("Land Details.xls");
?>      
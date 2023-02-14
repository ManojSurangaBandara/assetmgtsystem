<?php
            require_once "../excel/excelexport.php";
            $xls = new ExcelExport();
			$heading = "BUILDING DETAILS";
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
			        
			$xls->addRow($header,$row);
			$row = $row + 1;
            foreach ($items as $exp) {
                $xls->addRow(Array(
                    $exp['assetscenter'],
                    $exp['assetunit'],
                    $exp['province'],
                    $exp['district'],
                    $exp['dsDivision'],
                    $exp['gsDivision'],
                    $exp['landname'],
                    $exp['ownerName'],
                    $exp['buildingCategory'],
                    $exp['assetsno'],
                    $exp['buildingType'],
                    $exp['rentAndRate'],
                    $exp['ownership'],
                    $exp['regOwnerName'],
                    $exp['classificationno'],
                    $exp['identificationno'],
                    $exp['buildingno'],
                    $exp['planno'],
                    $exp['plandate'],
                    $exp['areaMeasure'],
                    $exp['area'],
                    $exp['constructionCost'],
                    $exp['additionsValue'],
                    $exp['alterationValue'],
                    $exp['acquisitiondate'],
                    $exp['remarks']),$row);
            $row++;
			}
			$row = $row + 2;
			$xls->writeCell("CERTIFIED CORRECT",$row,$col);
			$col = $col + 4;
			$xls->writeCell("CERTIFIED CORRECT",$row,$col);
			$col = $col + 4;
			$xls->writeCell("CHECKED AND FOUND CORRECT",$row,$col);
			$row = $row + 3;
			$col = 0;
			$xls->writeCell(".......................................",$row,$col);
			$col = $col + 4;
			$xls->writeCell(".......................................",$row,$col);
			$col = $col + 4;
			$xls->writeCell(".......................................",$row,$col);
			$row = $row + 1;
			$col = 0;
			$xls->writeCell($boardMemberName1,$row,$col);
			$col = $col + 4;
			$xls->writeCell($boardMemberName2,$row,$col);
			$col = $col + 4;
			$xls->writeCell($boardMemberName3,$row,$col);
			$row = $row + 1;
			$col = 0;
			$xls->writeCell($boardMemberRank1,$row,$col);
			$col = $col + 4;
			$xls->writeCell($boardMemberRank2,$row,$col);
			$col = $col + 4;
			$xls->writeCell($boardMemberRank3,$row,$col);
			$row = $row + 1;
			$col = 0;
			$xls->writeCell($boardMemberNumber1,$row,$col);
			$col = $col + 4;
			$xls->writeCell($boardMemberNumber1,$row,$col);
			$col = $col + 4;
			$xls->writeCell($boardMemberNumber1,$row,$col);
            $xls->download("Building Details.xls");
?>      
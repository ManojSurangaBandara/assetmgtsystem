<?php
            require_once "../excel/excelexport.php";
            $xls = new ExcelExport();
			$TT =  ($disposal == 1 ? '  - DISPOSALS' : ' ');
			$heading = "OFFICE EQUIPMENTS" . $TT;
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
			$header = array('Identification No.', 'Category', 'Description', 'Asset No', 'Calalogue No', 'Ledger No', ($disposal == 1 ? 'Disposed Dte' : 'Folio No'), 'DOP', 'DOR', 'Unit Value');        
			$xls->addRow($header,$row);
			$row = $row + 1;
            foreach ($items as $exp) {
                $xls->addRow(Array(
          $exp['identificationno'],
            $exp['itemCategory'],
            $exp['itemDescription'],
           $exp['assetsno'], 'LR',
            $exp['catalogueno'],
            $exp['ledgerno'],
            ($disposal == 1 ? $exp['disposedDate'] : $exp['ledgerFoliono']), 
            $exp['purchasedDate'],
            $exp['receivedDate'],
           $exp['unitValue'],
            ),$row);
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
            $xls->download("Office Equipments".".xls");
?>      
<?php
            require_once "../excel/excelexport.php";
            $xls = new ExcelExport();
			$heading = "Fixed Assets Details List";
			$row = 0;
			$col = 0;			
            $xls->writeCell($heading,$row,$col);
			$row = $row + 1;
			 $header = array('SNo', 'Main Category.', 'Item Category', 'Description', 'Make', 'Modle', 'vote Head', 'new Assestno', 'assets no', 'Catalogue No');      
			$xls->addRow($header,$row);
			$row = $row + 1;
			
			$i = 0;
			foreach ($items as $exp) {
                $i++;
				$xls->addRow(Array(
				$i,
				$exp['mainCategory'],
            $exp['itemCategory'],
            $exp['itemDescription'],
            $exp['make'],
            $exp['modle'],
            $exp['voteHead'],
            $exp['newAssestno'],
            $exp['assetsno'],
            $exp['catalogueno'],),$row);
            $row++;
			}
            $xls->download("Fixed Assets Details List". date('Y-m-d') . ".xls");
?>      
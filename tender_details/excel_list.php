<?php
            require_once "../excel/excelexport.php";
            $xls = new ExcelExport();
			$heading = "TENDER  DETAILS - VEHICLES";
			$row = 0;
			$col = 0;
			$sno = 1;			
            $xls->writeCell($heading,$row,$col);
			$row = $row + 1;
			$xls->writeCell("Tender Number      : " . $tenderno ,$row,$col);
			$row++;
			$xls->writeCell("Unit               : " . $tplace ,$row,$col);
			$row++;
			$header = array('SNo', 'Lot No.', 'Army No.', 'Vehicle Type', 'Engine No.', 'Chassis Number', 'Estimate Value', 'Tender Value', 'Buyer Name', 'Buyer Address', 'Buyer NIC No.');        
			$xls->addRow($header,$row);
			$row = $row + 1;
            foreach ($exps as $exp) {
                $xls->addRow(Array(
				$sno++,
				$exp['lotno'],
            $exp['armyno'],
            $exp['itemDescription'],
            $exp['engineno'],
            $exp['chessisno'],
            $exp['estimatevalue'],
            $exp['tendervalue'],
            $exp['buyername'],
            $exp['buyeraddress'],
            $exp['buyernicno']),$row);
            $row++;
			}
            $xls->download("TenderVehicleDetails.xls");
?>      
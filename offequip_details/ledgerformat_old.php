<?php	
	include 'header7.php';
?>
<script type="text/javascript">
        $(document).ready(function () {
            // prepare the data
            var numberrenderer = function (row, column, value) {
                return '<div style="text-align: center; margin-top: 5px;">' + (1 + value) + '</div>';
            }           
		   var source =
            {
                datatype: "json",
                datafields: [
                    { name: 'assetunit', type: 'string'},
					{ name: 'itemCategory', type: 'string'},
                    { name: 'itemDescription', type: 'string'},
                    { name: 'assetsno', type: 'string'},
                    { name: 'catalogueno', type: 'string'},
                    { name: 'newAssestno', type: 'string'},
					{ name: 'identificationno', type: 'string'},
					{ name: 'ledgerno', type: 'string'},
					{ name: 'ledgerFoliono', type: 'string'},
					{ name: 'eqptSriNo', type: 'string'},
					{ name: 'purchasedDate', type: 'string'},
					{ name: 'capacity', type: 'string'},
					{ name: 'unitValue', type: 'numeric'}
                ],
                url: 'index.php?action=ledgerformatdata',
				cache: false
            };

            var dataAdapter = new $.jqx.dataAdapter(source);
			
			$("#jqxgrid").jqxGrid(
            {
                width: '100%',
				source: dataAdapter,
                theme: 'darkblue',
				columnsresize: true,
				ready: function () {
					$('#jqxgrid').jqxGrid('autoresizecolumns');
					},
                columns: [
                  { text: 'No:', dataField: '', columntype: 'number', width: 50, cellsrenderer: numberrenderer },
				  { text: 'Unit', datafield: 'assetunit', width: 150},
				  { text: 'Item Category', datafield: 'itemCategory', width: 250},
                  { text: 'Item Description', datafield: 'itemDescription', width: 150 },
                  { text: 'Assets No.', datafield: 'assetsno', width: 180 },
                  { text: 'Catalogue No.', datafield: 'catalogueno', width: 200 },
                  { text: 'Classification No.', datafield: 'newAssestno', width: 220 },
				  { text: 'Identification No.', datafield: 'identificationno', width: 220 },
				  { text: 'Ledger No.', datafield: 'ledgerno', width: 220 },
				  { text: 'Ledger Folio No.', datafield: 'ledgerFoliono', width: 220 },
				  { text: 'Equ. Serial Number', datafield: 'eqptSriNo', width: 220 },
				  { text: 'Date of Purchased', datafield: 'purchasedDate', width: 220 },
				  { text: 'Capacity', datafield: 'capacity', cellsalign: 'right', align: 'right', cellsformat: 'd2' },,
				  { text: 'Unit Value (Rs.)', datafield: 'unitValue', cellsalign: 'right', align: 'right', cellsformat: 'd2' }
              ]
            });
			//var exportInfo;
				$("#excelExport").click(function() {
					$("#jqxgrid").jqxGrid('exportdata', 'xls', 'jqxGrid');
				});			
        });
    </script>
<div id="page">
        <div class="title_wrapper">
            <h2>Office Equipments - Ledger Format</h2>
            <span class="title_wrapper_left"></span>
            <span class="title_wrapper_right"></span>
        </div>
<div id="jqxgrid"></div>
<input style='margin-top: 10px;' type="button" value="Export to Excel" id='excelExport' />
</div>				
</div>
<?php
//include('sidebar.php');
include '../view/footer.php';
?>
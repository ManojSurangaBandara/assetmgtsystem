<?php include '../view/header7.php'; ?>
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
                    { name: 'brandName', type: 'string'},
                    { name: 'modelName', type: 'string'},
                    { name: 'assetsno', type: 'string'},
					{ name: 'catalogueno', type: 'string'},
					{ name: 'engineno', type: 'string'},
					{ name: 'chessisno', type: 'string'},
					{ name: 'armyno', type: 'string'},
					{ name: 'civilno', type: 'string'},
					{ name: 'fuel', type: 'string'},
					{ name: 'purchasedDate', type: 'string'},
					{ name: 'unitValue', type: 'numeric'},
					{ name: 'identificationno', type: 'string'}
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
				  { text: 'Land Category', datafield: 'itemCategory', width: 250},
                  { text: 'Asset No', datafield: 'itemDescription', width: 150 },
                  { text: 'Classification No.', datafield: 'brandName', width: 180 },
                  { text: 'District', datafield: 'modelName', width: 200 },
                  { text: 'DS Division', datafield: 'assetsno', width: 220 },
				  { text: 'GS Division', datafield: 'catalogueno', width: 220 },
				  { text: 'Identification No', datafield: 'engineno', width: 220 },
				  { text: 'Register', datafield: 'chessisno', width: 220 },
				  { text: 'Plan No', datafield: 'armyno', width: 220 },
				  { text: 'Land Name', datafield: 'civilno', width: 220 },
				  { text: 'Acres', datafield: 'fuel', width: 220 },
				  { text: 'Rood', datafield: 'purchasedDate', width: 220 },
				  { text: 'Perch', datafield: 'identificationno', width: 220 },
				  { text: 'Estimated Value (Rs.)', datafield: 'unitValue', cellsalign: 'right', align: 'right', cellsformat: 'd2' }
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
            <h2>Land Details - Ledger Format</h2>
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
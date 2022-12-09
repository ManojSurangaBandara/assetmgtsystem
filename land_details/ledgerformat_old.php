<?php	
	include '../view/header7.php';
?>
<div id="sec_menu">
	<?php include("sub_menu.tpl");?>
</div>
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
					{ name: 'category', type: 'string'},
                    { name: 'assetsno', type: 'string'},
                    { name: 'classificationno', type: 'string'},
                    { name: 'district', type: 'string'},
                    { name: 'dsDivision', type: 'string'},
					{ name: 'gsDivision', type: 'string'},
					{ name: 'identificationno', type: 'string'},
					{ name: 'register', type: 'string'},
					{ name: 'planno', type: 'string'},
					{ name: 'landname', type: 'string'},
					{ name: 'area', type: 'string'},
					{ name: 'acre', type: 'string'},
					{ name: 'rood', type: 'string'},
					{ name: 'parch', type: 'string'},
					{ name: 'estimatedValue', type: 'numeric'}
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
				  { text: 'Land Category', datafield: 'category', width: 250},
                  { text: 'Asset No', datafield: 'assetsno', width: 150 },
                  { text: 'Classification No.', datafield: 'classificationno', width: 180 },
                  { text: 'District', datafield: 'district', width: 200 },
                  { text: 'DS Division', datafield: 'dsDivision', width: 220 },
				  { text: 'GS Division', datafield: 'gsDivision', width: 220 },
				  { text: 'Identification No', datafield: 'identificationno', width: 220 },
				  { text: 'Register', datafield: 'register', width: 220 },
				  { text: 'Plan No', datafield: 'planno', width: 220 },
				  { text: 'Land Name', datafield: 'landname', width: 220 },
				  { text: 'Area - Hectare', datafield: 'area', cellsalign: 'right', align: 'right', cellsformat: 'd2' },
				  { text: 'Acres', datafield: 'acre', width: 220 },
				  { text: 'Rood', datafield: 'rood', width: 220 },
				  { text: 'Perch', datafield: 'parch', width: 220 },
				  { text: 'Estimated Value (Rs.)', datafield: 'estimatedValue', cellsalign: 'right', align: 'right', cellsformat: 'd2' }
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
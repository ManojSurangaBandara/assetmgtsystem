<?php include 'header3.php'; ?>
    <script type="text/javascript">
        $(document).ready(function () {
            // prepare the data
            var source =
            {
                datatype: "json",
                datafields: [
                    { name: 'assetscenter', type: 'string'},
                    { name: 'assetunit', type: 'string'},
					{ name: 'province', type: 'string'},
					{ name: 'district', type: 'string'},
					{ name: 'dsDivision', type: 'string'},
					{ name: 'gsDivision', type: 'string'},
					{ name: 'category', type: 'string'},
					{ name: 'classificationno', type: 'string'},
					{ name: 'natureOwnership', type: 'string'},
					{ name: 'ownership', type: 'string'},
					{ name: 'register', type: 'string'},
					{ name: 'landname', type: 'string'},
					{ name: 'planno', type: 'string'},
					{ name: 'deedno', type: 'string'},
					{ name: 'deeddate', type: 'string'},
					{ name: 'landNature', type: 'string'},
					{ name: 'areaMeasure', type: 'string'},
					{ name: 'area', type: 'string'},
					{ name: 'estimatedValue', type: 'string'},
					{ name: 'previousownership', type: 'string'},
					{ name: 'acquisitiondate', type: 'string'},
					{ name: 'remarks', type: 'string'},
					{ name: 'identificationno', type: 'string'}
                ],
                url: 'index.php?action=List_columnlist_easyui_query',
				cache: false
            };

            var dataAdapter = new $.jqx.dataAdapter(source);
			
			$("#jqxgrid").jqxGrid(
            {
                source: dataAdapter,
                width: '100%',
				theme: 'energyblue',
				columnsresize: true,
                columns: [
                  { text: 'assetscenter', datafield: 'assetscenter', width: 100},
                  { text: 'assetunit', datafield: 'assetunit', width: 100},
				  { text: 'province', datafield: 'province', width: 100},
				  { text: 'district', datafield: 'district', width: 100},
				  { text: 'dsDivision', datafield: 'dsDivision', width: 100},
				  { text: 'gsDivision', datafield: 'gsDivision', width: 100},
				  { text: 'category', datafield: 'category', width: 100},
				  { text: 'classificationno', datafield: 'classificationno', width: 100},
				  { text: 'natureOwnership', datafield: 'natureOwnership', width: 100},
				  { text: 'ownership', datafield: 'ownership', width: 100},
				  { text: 'register', datafield: 'register', width: 100},
				  { text: 'landname', datafield: 'landname', width: 100},
				  { text: 'planno', datafield: 'planno', width: 100},
				  { text: 'deedno', datafield: 'deedno', width: 100},
				  { text: 'deeddate', datafield: 'deeddate', width: 100},
				  { text: 'landNature', datafield: 'landNature', width: 100},
				  { text: 'areaMeasure', datafield: 'areaMeasure', width: 100},
				  { text: 'area', datafield: 'area', width: 100},
				  { text: 'estimatedValue', datafield: 'estimatedValue', width: 100},
				  { text: 'previousownership', datafield: 'previousownership', width: 100},
				  { text: 'acquisitiondate', datafield: 'acquisitiondate', width: 100},
				  { text: 'remarks', datafield: 'remarks', width: 100},
				  { text: 'identificationno', datafield: 'identificationno', width: 250}
              ]
            });
			$("#excelExport").jqxButton();
            $("#pdfExport").jqxButton();
			$("#excelExport").click(function () {
                $("#jqxgrid").jqxGrid('exportdata', 'xls', 'jqxGrid');           
            });
       
            $("#pdfExport").click(function () {
                $("#jqxgrid").jqxGrid('exportdata', 'pdf', 'jqxGrid');
            });
            $("#button").jqxButton({ theme: theme });
            $("#button").click(function () {
                $("#jqxgrid").jqxGrid('autoresizecolumns');
            });
            // trigger the column resized event.
           /* $("#jqxgrid").on('columnresized', function (event) {
                var column = event.args.columntext;
                var newwidth = event.args.newwidth
                var oldwidth = event.args.oldwidth;
                $("#eventlog").text("Column: " + column + ", " + "New Width: " + newwidth + ", Old Width: " + oldwidth);
            });
				var addfilter = function () {
                var filtergroup = new $.jqx.filter();

                var filter_or_operator = 1;
                var filtervalue = 'Beate';
                var filtercondition = 'contains';
                var filter1 = filtergroup.createfilter('stringfilter', filtervalue, filtercondition);

                filtervalue = 'Andrew';
                filtercondition = 'starts_with';
                var filter2 = filtergroup.createfilter('stringfilter', filtervalue, filtercondition);
 
                filtergroup.addfilter(filter_or_operator, filter1);
                filtergroup.addfilter(filter_or_operator, filter2);
                // add the filters.
                $("#jqxgrid").jqxGrid('addfilter', 'firstname', filtergroup);
                // apply the filters.
                $("#jqxgrid").jqxGrid('applyfilters');
            }
$('#events').jqxPanel({ width: 300, height: 80});

            $("#jqxgrid").on("filter", function (event) {
                $("#events").jqxPanel('clearcontent');
                var filterinfo = $("#jqxgrid").jqxGrid('getfilterinformation');

                var eventData = "Triggered 'filter' event";
                for (i = 0; i < filterinfo.length; i++) {
                    var eventData = "Filter Column: " + filterinfo[i].filtercolumntext;
                    $('#events').jqxPanel('prepend', '<div style="margin-top: 5px;">' + eventData + '</div>');
                }
            });
			$('#clearfilteringbutton').jqxButton({ height: 25});
			            // clear the filtering.
            $('#clearfilteringbutton').click(function () {
                $("#jqxgrid").jqxGrid('clearfilters');
            });
			            // show/hide filter icons
            $('#filtericons').on('change', function (event) {
                $("#jqxgrid").jqxGrid({ autoshowfiltericon: !event.args.checked });
            });
        });
    </script>
<div id="sec_menu">
	<?php include("sub_menu.tpl");?>
</div>
<div id="page">
<div id='jqxWidget'>
        <div id="jqxgrid"></div>
		<div id='jqxWidget' style="font-size: 13px; font-family: Verdana; float: left;">
        <div id="jqxgrid"></div>
        <div style='margin-top: 20px;'>
		<div style='float: left;'>
            <input id="button" type="button" value="Auto Resize Columns" />
        </div>
            <div style='margin-left: 10px; float: left;'>
                <input type="button" value="Export to Excel" id='excelExport' />
                <br /><br />
            </div>
            <div style='margin-left: 10px; float: left;'>
                <input type="button" value="Export to PDF" id='pdfExport' />
            </div>
        </div>		        
    </div>
    </div>
</div>
<?php
//include('sidebar.php');
include '../view/footer.php';
?>
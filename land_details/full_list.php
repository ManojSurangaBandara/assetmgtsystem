<?php include 'header5.php'; ?>
<script>
	document.getElementById("wrap").addEventListener("scroll",function(){
   var translate = "translate(0,"+this.scrollTop+"px)";
   this.querySelector("thead").style.transform = translate;
	});
</script>
<div id="page">

    <div class="section table_section">
        <div class="title_wrapper">
            <h2><?php echo $subMenu[0][$lang]?></h2>
            <span class="title_wrapper_left"></span>
            <span class="title_wrapper_right"></span>
        </div>
        <div class="section_content">
            <div class="sct">
                <div class="sct_left">
                    <div class="sct_right">
                        <div class="sct_left">
                            <div class="sct_right">
                                <fieldset>                                   
                                        <div id="wrap">
                                            <table border="0" cellspacing="5" cellpadding="5">
        <tbody><tr>
            <td>From date:</td>
            <td><input type="text" id="min" name="min"></td>
             <td>To date:</td>
            <td><input type="text" id="max" name="max"></td>
        </tr>
        
    </tbody></table>  
										<table id="abc" class="tablesorter" cellpadding="1" cellspacing="0" width="100%" border="1" BORDERCOLOR=skyblue style="font-size:11px;">
											<thead>
												<tr>
                                                <th><nobr>S/N</nobr></th>
												<th><nobr>Assets Unit</nobr></th>
												<th><nobr>Identification No</nobr></th>
                                                <th><nobr>Category Name</nobr></th>
												<th><nobr>Assets No</nobr></th>
												<th><nobr>Classification No</nobr></th>
                                                <th><nobr>District</nobr></th>
                                                <th><nobr>DS Division</nobr></th>
                                                <th><nobr>GS Division</nobr></th>
												<th><nobr>Land Registration Number/Date</nobr></th>
												<th><nobr>Land Name</nobr></th>
												<th><nobr>Nature of the Ownership</nobr></th>
												<th><nobr>Plan Number</nobr></th>
                                                <th><nobr>Deed Number</nobr></th>
                                                <th><nobr>Area(Hect)</nobr></th>
												<th><nobr>Area(Acre/Rood/Parch)</nobr></th>
                                                <th><nobr>Acqu. Date</nobr></th>
                                                <th><nobr>Value</nobr></th>
                                                                                <th><nobr>Reference</nobr></th>
                                                </tr>
											</thead>
											<tbody>
                                                <?php $i = 1; 
												$totvalue = 0;
												$t_acre = 0;
												$t_rood = 0;
												$t_perch = 0;
												$t_area = 0;
												?>
                                                <?php foreach ($items as $exp) { ?>																
                                                    <tr>
                                                        <td><nobr><?php echo $i; ?></nobr></td>
														<td><nobr><?php echo $exp['assetunit']; ?></nobr></td>
                                                        <td><nobr><a href="index.php?action=ApprovedList&identificationno=<?php echo $exp['identificationno'];?>"><font color="DarkBlue"><?php echo $exp['identificationno']; ?></a></nobr></td>
                                                        <td><nobr><?php echo $exp['category']; ?></nobr></td>
														<td><nobr><?php echo $exp['assetsno']; ?></nobr></td>
														<td><nobr><?php echo $exp['classificationno']; ?></nobr></td>
                                                        <td><nobr><?php echo $exp['district']; ?></nobr></td>
                                                        <td><nobr><?php echo $exp['dsDivision']; ?></nobr></td>
														<td><nobr><?php echo $exp['gsDivision']; ?></nobr></td>	
                                                        <td><nobr><?php echo $exp['register']; ?></nobr></td>
														<td><nobr><?php echo $exp['landname']; ?></nobr></td>
														<td><nobr><?php echo $exp['natureOwnership']; ?></nobr></td>
														<td><nobr><?php echo $exp['planno']; ?></nobr></td>																											
                                                        <td><nobr><?php echo $exp['deedno']; ?></nobr></td>
                                                        <td align="right"><nobr><?php echo number_format((float)$exp['area'], 2, '.', ','); ?></nobr></td>
														<td align="right"><nobr><?php echo $exp['acre']."A, ".$exp['rood']."R, ".number_format((float)$exp['parch'], 2, '.', ',')."P "; ?></nobr></td>
                                                        <td align="right"><nobr><?php echo $exp['acquisitiondate']; ?></nobr></td>
                                                        <td align="right"><nobr><?php echo number_format((float)$exp['estimatedValue'], 2, '.', ','); ?></nobr></td>
                                                     <td align="right"><nobr><?php echo $exp['refValue']; ?></nobr></td>
                                                                                </tr>
                                                    <?php $i++; 
													      $totvalue = $totvalue + $exp['estimatedValue']; 
															$t_acre = $t_acre + $exp['acre'];
															$t_rood = $t_rood + $exp['rood'];
															$t_perch = $t_perch + $exp['parch'];
															$t_area = $t_area + $exp['area'];														  
														  ?>
                                                <?php } 
												$tt_perch = intval($t_perch) % 40;
												$t_rood = $t_rood + ($t_perch - $tt_perch) / 40;
												$tt_rood = intval($t_rood) % 4;
												$t_acre = $t_acre + ($t_rood - $tt_rood) / 4;
												?> 
												</tbody>
												<tfoot>
												<tr>
												<td></td>
												<td>Total Value</td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td align="right"><?php echo number_format((float)$t_area, 2, '.', ','); ?></td>
												<td align="right"><nobr><?php echo number_format((float)$t_acre, 0, '.', ',')."A, ".$tt_rood."R, ".number_format((float)$tt_perch, 2, '.', ',')."P "; ?></nobr></td>												
												  <td></td>
												  <td align="right"><?php echo number_format((float)$totvalue, 2, '.', ','); ?></td>
												</tr>
											  </tfoot>
											  </table>
                                        </div>
                                    
                                </fieldset>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
			<iframe id="txtArea1" style="display:none"></iframe>
                        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

    <!-- Datatable Dependency start -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.20/b-1.6.1/b-colvis-1.6.1/b-html5-1.6.1/b-print-1.6.1/r-2.2.3/datatables.min.css" />
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.20/b-1.6.1/b-colvis-1.6.1/b-html5-1.6.1/b-print-1.6.1/r-2.2.3/datatables.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/datetime/1.1.1/js/dataTables.dateTime.min.js"></script>
    <link href="https://cdn.datatables.net/datetime/1.1.1/css/dataTables.dateTime.min.css" rel="stylesheet" id="bootstrap-css">
   

			<script>
//				function generate() {
//					 var doc = new jsPDF('l', 'pt', 'a1');
//					doc.text("Building Details List", 30, 50);
//					var res = doc.autoTableHtmlToJson(document.getElementById("abc"));
//					doc.autoTable(res.columns, res.data, {startY: 60});
//					doc.save("table.pdf");
//				}
var minDate, maxDate;
 
// Custom filtering function which will search data in column four between two values
$.fn.dataTable.ext.search.push(
    function( settings, data, dataIndex ) {
        //alert(data[9]);
        var min = minDate.val();
        var max = maxDate.val();
        var date = new Date( data[16] )
       // alert(date);
 
        if (
            ( min === null && max === null ) ||
            ( min === null && date <= max ) ||
            ( min <= date   && max === null ) ||
            ( min <= date   && date <= max )
        ) {
            return true;
        }
        return false;
    }
);
$(document).ready(function() {
    
    
            
             // Create date inputs
    minDate = new DateTime($('#min'), {
         format: 'MMMM Do YYYY'
    });
    maxDate = new DateTime($('#max'), {
         format: 'MMMM Do YYYY'
    });
 
    // DataTables initialisation
   
 var table = $('#abc').DataTable({

                dom: 'Bfrtip',
                //responsive: true,
                pageLength: 25,
                // lengthMenu: [0, 5, 10, 20, 50, 100, 200, 500],

                buttons: [
                    'copy',
                    'csv', 
                    'excel', 
                    {
                        extend: 'pdfHtml5',
                        orientation: 'portrait',
                        pageSize: 'A0'   
                    },
                     'print'
                ],



            });
    // Refilter the table
    $('#min, #max').on('change', function () {
        table.draw();
    });
        });

			</script>
<!--			<button id="btnExport" onclick="fnExcelReport();">Export to Excel</button>
			<button onclick="generate()">Export to pdf</button>
			<script src="../jspdf/libs/jspdf.min.js"></script>
			<script src="../jspdf/libs/jspdf.plugin.autotable.src.js"></script>
			<script src="../jspdf/libs/json2.js"></script>
			<script>
				function generate() {
					var doc = new jsPDF('l', 'pt', 'a1');
					doc.text("Land Details List", 30, 50);
					var res = doc.autoTableHtmlToJson(document.getElementById("abc"));
					doc.autoTable(res.columns, res.data, {startY: 60});
					doc.save("table.pdf");
				}
			</script>			-->
            <span class="scb"><span class="scb_left"></span><span class="scb_right"></span></span>						
        </div>
    </div>

</div>
<?php
//include('sidebar.php');
include '../view/footer.php';
?>
<?php
include 'header1.php';
?>
<script>	
$(document).ready(function () {
$('.date').datepicker({dateFormat: 'yy-mm-dd',
maxDate: '0',
changeMonth : true,
changeYear: true});

    $('#ordinance').change(function() {
        getAsstUnit($(this).val(), "");
    });

$("#submit").click(function(){   
    var ordinance = $('#ordinance').val();
	var unit = $('#unit').val();
    var ordinance_send_date_1 = $('#ordinance_send_date_1').val();
	var ordinance_send_date_2 = $('#ordinance_send_date_2').val();
    var querystring = {
			ordinance: ordinance,
			unit: unit,
			ordinance_send_date_1: ordinance_send_date_1,
			ordinance_send_date_2: ordinance_send_date_2,
			action: 'get_unit_ordinance_record'
		}
		$.get('index.php', querystring, processResponse);
	 function processResponse(result) {
			    var data = $.parseJSON(result);
                $('#abc tr').not(':first').remove();
                var i = 1;
                $.each(data, function (key, value) {
                    html = '<tr id="' + value.id + '"><td>' + i +
                            '</td><td><nobr>' + value.ordinance_receive_date +
                            '</nobr></td><td><nobr>' + value.ordinance_send_date +
                            '</nobr></td><td>' + value.identificationno +
							'</td><td>' + value.mainCategory +
                            '</td><td>' + value.itemCategory + 
							'</td><td>' + value.itemDescription + 
							'</td><td>' + value.catalogueno + 
							'</td><td>' + value.eqptSriNo + 
							'</td><td>' + value.purchasedDate + 
							'</td><td align="right"><nobr>' + value.unitValue + 			
							'</nobr></td></tr>';
                    $('#abc tr:last').after(html);
                    i++;
                });
			
			
			//if (result != 1){
			//	alert(result);
			//}
		}
	return false
});
	
	
$('table').tablesorter({
			widgets        : ['stickyHeaders'],
			usNumberFormat : false,
			sortReset      : true,
			sortRestart    : true
		});	
	});
	
function getAsstUnit(ordinance, unit)
    {
        var querystring = {
            ordinance: ordinance,
            action: 'get_assets_units_ordinance'
        }
        $.get('index.php', querystring, processResponse);
        function processResponse(result) {
            var numbers = $.parseJSON(result);
            var option = '<option></option>';
            for (var i = 0; i < numbers.length; i++) {
                option += '<option value="' + numbers[i] + '">' + numbers[i] + '</option>';
            }
            $('#unit').html(option);
            $('#unit option[value="' + unit + '"]').attr('selected', 'selected');
        } // end processData
    }
    ;	
</script>
<div id="page">
	<div class="section">
		<div class="section_content">
			<div class="sct">
				<div class="sct_left">
					<div class="sct_right">
						<div class="sct_left">
    <div class="section table_section">
                                    <ul id="message" class="system_messages">
                                        <li class="blue"><span class="ico"></span><strong class="system_title">Fill Details press "Search" Button</strong></li>
                                    </ul>
                                    <form name="add_form" method="post" id="add_form" action="index.php" class="add_form"> 
                                        <input type="hidden" name="action" value="add_ordinance_places_record" />
                                        <input type="hidden" name="id" id="id" value="0" />
                                        <div><label for="code" class="label">Ordnance :</label>
										<select name="ordinance"  id ="ordinance" class="categ">
											<option value=""></option>
											<?php foreach ($ordinances as $ordinance) { ?>
											<option value="<?php echo $ordinance['code']; ?>"><?php echo $ordinance['code']; ?></option>
													<?php } ?>
											</select>
                                        </div>
										<div><label for="name" class="label">Handover Unit :</label>
										<select name="unit"  id ="unit" class="categ">
											</select>
                                        </div>									
                                        <div><label for="name" class="label">Ordnance Received Date Range :</label>
										<input type="text" name="ordinance_send_date_1; ?>" id="ordinance_send_date_1" value="" class="date" style="width:75px">
										- 
										<input type="text" name="ordinance_send_date_2; ?>" id="ordinance_send_date_2" value="" class="date" style="width:75px"></div>										
										<div><input type="submit" name="submit" id="submit" value="Search"></div>										
                                    </form> 
        <div class="title_wrapper">
            <h2>Plant & Machinery Ordnance List</h2>
            <span class="title_wrapper_left"></span>
            <span class="title_wrapper_right"></span>
        </div>
		<table id="abc" class="tablesorter"> 
<thead> 
                                            <th><nobr>S/N</nobr></th>
											<th>Received Date</th>
											<th>Send From Unit</nobr></th>
                                            <th><nobr><?php echo $tList[18][$lang]?></th>
                                            <th><nobr><?php echo $tList[2][$lang]?></nobr></th>
                                            <th><nobr><?php echo $tList[3][$lang]?></nobr></th>
                                            <th><nobr><?php echo $tList[4][$lang]?></nobr></th>
                                            <th><?php echo $tList[5][$lang]?></th>                                            
                                            <th><?php echo $tList[9][$lang]?></th>
											<th><?php echo $tList[10][$lang]?></th>
											<th><?php echo $tList[13][$lang]?></th>
											 </tr> 
</thead> 
<tbody> 
  <!--                                              <?php $i = 1; 
												$totvalue = 0;?>
                                                <?php foreach ($exps as $exp) { ?>																
                                                    <tr>
                                                                <td><nobr><?php echo $i; ?></nobr></td>
																<td><nobr><?php echo $exp['ordinance_receive_date']; ?></nobr></td>
                                                                <td><nobr><?php echo $exp['ordinance_send_date']; ?></nobr></td>
																<td><nobr><?php echo $exp['identificationno']; ?></nobr></td>
                                                                <td><nobr><?php echo $exp['mainCategory']; ?></nobr></td>
																<td><nobr><?php echo $exp['itemCategory']; ?></nobr></td>
                                                                <td><nobr><?php echo $exp['itemDescription']; ?></nobr></td>
                                                                 <td><nobr><?php echo $exp['catalogueno']; ?></nobr></td>																
                                                                <td><nobr><?php echo $exp['eqptSriNo']; ?></nobr></td>
																 <td><nobr><?php echo $exp['purchasedDate']; ?></nobr></td>
                                                                <td align="right"><nobr><?php echo $exp['unitValue']; ?></nobr></td>															
                                                                </tr>
																<?php $i++; 
													      $totvalue = $totvalue + $exp['unitValue']; ?>
                                                <?php } ?> 
-->
</tbody>
	<tfoot>
	<tr>
	<td></td>
	<td>Total</td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>	
	  <td align="right"><?php echo number_format($totvalue, 2, '.', ','); ?></td>
	</tr>
  </tfoot> 
</table>
<iframe id="txtArea1" style="display:none"></iframe>
<button id="btnExport" onclick="fnExcelReport();">Export to Excel</button>
															<button onclick="generate()">Export to pdf</button>
															<script src="../jspdf/libs/jspdf.min.js"></script>
															<script src="../jspdf/libs/jspdf.plugin.autotable.src.js"></script>
															<script>
																function generate() {
																	 var doc = new jsPDF('l', 'pt', 'a3');
																	doc.text("Plant & Machinery Details List", 30, 50);
																	var res = doc.autoTableHtmlToJson(document.getElementById("abc"));
																	doc.autoTable(res.columns, res.data, {startY: 60});
																	doc.save("table.pdf");
																}
															</script>
 
                                                        </div>

                                                        </div>
														</div>
					</div>
				</div>
			</div>
		</div>
  </div>
                                                        <?php
//include('sidebar.php');
                                                        include '../view/footer.php';
                                                        ?>
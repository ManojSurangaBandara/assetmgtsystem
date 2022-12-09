<?php	
	include 'header1.php';
?>
<script>	
$(document).ready(function () {
$('.date').datepicker({dateFormat: 'yy-mm-dd',
maxDate: '0',
changeMonth : true,
changeYear: true});
var d = new Date();
var month = d.getMonth()+1;
var day = d.getDate();
var output = d.getFullYear() + '-' +
(month<10 ? '0' : '') + month + '-' +
(day<10 ? '0' : '') + day;

$('.date').change(function() {  
	var arr = $(this).attr('id').split('_');
	var id = arr[3];
	if (Date.parse($(this).val())) {
		$('#Loss_'+id).prop('disabled', false);
	} else {
		$('#Loss_'+id).prop('disabled', true);
	}
} );

$("#abc").on('change', 'input:checkbox', function(){ 
   var arr = $(this).attr('id').split('_');
   var id = arr[1];
   var selectLoss = ($(this).prop('checked')) ? 1 : 0;
   	if (selectLoss == 1) {
		var ordinance_receive_date = $('#ordinance_receive_date_'+id).val();
	} else {
		var ordinance_receive_date = "";	
	}
	var querystring = {
			id: id,
			ordinance_receive_date: ordinance_receive_date,
			selectLoss: selectLoss, 				 
			action: 'receive_ordinance_save'
		}
		$.get('index.php', querystring, processResponse);
	 function processResponse(result) {
		//alert(result);
		} 	
return false
});
			$('table').tablesorter({
			widgets        : ['stickyHeaders', "filter"],
			usNumberFormat : false,
			sortReset      : true,
			sortRestart    : true
		});	
	}); 
</script>
<div id="page">
<div class="inner">
    <div class="section table_section">
        <div class="title_wrapper">
            <h2><?php echo $title ?></h2>
            <span class="title_wrapper_left"></span>
            <span class="title_wrapper_right"></span>
        </div>
	<div class="section">
		<div class="section_content">
			<div class="sct">
				<div class="sct_left">
					<div class="sct_right">
						<div class="sct_left">
							<div class="sct_right">
                                <fieldset>
                                    <div class="table_wrapper_inner">
                                        <table id="abc" class="tablesorter" border="1" BORDERCOLOR=skyblue style="font-size:11px;">
                                            <thead>
                                            <th><nobr>S/N</nobr></th>
											<th><nobr>Received Date      &     Select</nobr></th>
											<th><nobr>Send From Unit</nobr></th>
                                            <th><nobr><?php echo $tList[18][$lang]?></nobr></th>
                                            <th><nobr><?php echo $tList[2][$lang]?></nobr></th>
                                            <th><nobr><?php echo $tList[3][$lang]?></nobr></th>
                                            <th><nobr><?php echo $tList[4][$lang]?></nobr></th>
                                            <th><nobr><?php echo $tList[5][$lang]?></nobr></th>                                            
                                            <th><nobr><?php echo $tList[9][$lang]?></nobr></th>
											<th><nobr><?php echo $tList[10][$lang]?></nobr></th>
											<th><nobr><?php echo $tList[13][$lang]?></nobr></th>
                                             </tr>
											</thead>                                                     
                                            <tbody>
                                                <?php $i = 1; 
												$totvalue = 0;?>
                                                <?php foreach ($exps as $exp) { ?>																
                                                    <tr>
                                                                <td><nobr><?php echo $i; ?></nobr></td>
																<td><nobr><form name="add_form" id="add_form" class="add_form" action="." method="post">
																<input type="text" name="ordinance_receive_date_<?php echo $exp['id']; ?>" id="ordinance_receive_date_<?php echo $exp['id']; ?>" value="<?php echo $ordinance_receive_date = ($exp['ordinance_receive_date'] == '0000-00-00') ? '' : $exp['ordinance_receive_date'];?>" class="date" style="width:75px">
																<input type="checkbox" name="Loss_<?php echo $exp['id']; ?>" id="Loss_<?php echo $exp['id']; ?>" <?php if($exp['confirm_receive_ordinance']==1) echo "checked=checked"; ?> <?php if ($exp['ordinance_receive_date'] == '0000-00-00'){ ?> disabled <?php   } ?>/></form></nobr></td>
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
                                                            </tbody>
															</table>
                                                            </div>
                                                            </fieldset>


                                                            </div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
  </div>
</div>
 </div>
<?php
include('sidebar.php');
include '../view/footer.php';
?>
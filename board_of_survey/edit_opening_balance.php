<?php
include 'header1.php';
?>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
		<script src="../jquery/bootstrap-datepicker.js"></script>
		<script src="../jquery/jquery.notifyBar.js"></script>
		<link rel="stylesheet" href="../css/datepicker.css">
        <link media="screen" rel="stylesheet" type="text/css" href="../css/admin.css"  />
		<link href="../css/jquery.notifyBar.css"  rel="stylesheet" type="text/css" >
		<link href="../css/bootstrap-dialog.css" rel="stylesheet" type="text/css" />		
		<script src="../jquery/bootstrap-dialog.js"></script>
		<script src="../jquery/bootstrap.js"></script>
<style>
#data {
  background-color: #ebfafa;
}
</style>
<script>
$(document).ready(function() {
		$('table').tablesorter({
			widgets        : ['stickyHeaders', "filter", 'cssStickyHeaders'],
			usNumberFormat : false,
			sortReset      : true,
			sortRestart    : true
		});	
});	
$(document).ready(function () {
/***************************************************************************************************/
    function getDescriptionList(itemtype, qstore, description)
    {
        var querystring = {
            itemtype: itemtype,
			qstore: qstore,
			description: description,
            action: 'getDescriptionList'
        }
        $.get('index.php', querystring, processResponse);
        function processResponse(result) {
			//alert(result);
			var descriptions = $.parseJSON(result);
            var option = '';
			$.each(descriptions, function(key, value) {
				option += '<option value="' + value.description + '">';
            });
            //alert(option);
			$('#descriptions').html(option);
			
        } // end processData
    };
/***************************************************************************************************/
    function setMessage(err)
    {
        switch (err) {
            case 0:
                $('#message').html('<li class="blue"><span class="ico"></span><strong class="system_title">Enter Data and press - Save - Button</strong></li>');
                break;
            case 1:
                $('#message').html('<li class="green"><span class="ico"></span><strong class="system_title">Data Successfully Saved.</strong></li>');
                break;
            case 2:
                $('#message').html('<li class="green"><span class="ico"></span><strong class="system_title">Data Successfully Updated.</strong></li>');
                break;
            case 3:
                $('#message').html('<li class="red"><span class="ico"></span><strong class="system_title">Assets Identification Number Already Entered</strong></li>');
                break;
            case 4:
                $('#message').html('<li class="blue"><span class="ico"></span><strong class="system_title">Modify Data and Press Update Button.</strong></li>');
                break;
            case 5:
                $('#message').html('<li class="red"><span class="ico"></span><strong class="system_title">Data Error. Please Check Data !</strong></li>');
                break;
            case 6:
                $('#message').html('<li class="red"><span class="ico"></span><strong class="system_title">Error when Database Writing !</strong></li>');
                break;
			case 7:			
			$('#message').html('<li class="green"><span class="ico"></span><strong class="system_title">Data Successfully Deleted.</strong></li>');
				break;
        }
    }
});
/***************************************************************************************************/	
function isNumberKey(evt){
	var charCode = (evt.which) ? evt.which : event.keyCode
	if (charCode > 31 && (charCode != 46 &&(charCode < 48 || charCode > 57)))
		return false;
	return true;
}
/***************************************************************************************************/
$(document).on('change','.sname',function(){
	var id = $(this).attr('id');
	values=id.split('_');
	q1 = $('#qty_q1_'+values[2]).val();
	$('#qty_ledger_'+values[2]).val(parseFloat($('#qty_onhand_'+values[2]).val())+parseFloat($('#qty_q1_'+values[2]).val())+ parseFloat($('#qty_q2_'+values[2]).val())+parseFloat($('#qty_q3_'+values[2]).val())+parseFloat($('#qty_q4_'+values[2]).val())+parseFloat($('#qty_q5_'+values[2]).val()));
	$("#"+values[2]).show();	
return false
});
/***************************************************************************************************/
$(document).ready(function () {
$(".savebttn").click(function(){
	var id = $(this).attr('id');
	var itemtype = $('#itemtype_'+id).val();	
	var qstore = $('#qstore_'+id).val();	
	var votename = $('#votename_'+id).val();	
	var itemcode = $('#itemcode_'+id).val();	
	var description = $('#description_'+id).val();
	var ledger_folio = $('#ledger_folio_'+id).val();
	var qty_onhand = $('#qty_onhand_'+id).val();
	var qty_q1 = $('#qty_q1_'+id).val();
	var qty_q2 = $('#qty_q2_'+id).val();
	var qty_q3 = $('#qty_q3_'+id).val();
	var qty_q4 = $('#qty_q4_'+id).val();
	var qty_q5 = $('#qty_q5_'+id).val();
	var qty_ledger = $('#qty_ledger_'+id).val();
	var querystring = {
			id: id,
			itemtype : itemtype, 	
			qstore : qstore,		
			votename : votename,	
			itemcode : itemcode,	
			description	: description,
			ledger_folio : ledger_folio,
			qty_onhand: qty_onhand,
			qty_q1: qty_q1,
			qty_q2: qty_q2,
			qty_q3: qty_q3,
			qty_q4: qty_q4,
			qty_q5: qty_q5,
			qty_ledger: qty_ledger,
			action: 'add_opening_balance_save'
		}
		$.get('index.php', querystring, processResponse);
	 function processResponse(result) {
		$.notifyBar({ cssClass: "success", html: "Data has been Saved...!" });
		//alert(result);
		$("#"+id).hide();	
		}
	return false
});

$(".deletebttn").click(function(){
	var t_id = $(this).attr('id');
	var values = t_id.split('_');
	var id = values[1];
	BootstrapDialog.confirm('Are you sure you want to delete this Record?', function(result){
				if(result) {					
					var querystring = {
					id: id,
					action: 'delete_opening_balance'
					}
					$.get('index.php', querystring, processResponse);
					function processResponse(result) {
						if (result == 1) {
						$("#tr_"+id).remove();
						$.notifyBar({ cssClass: "success", html: "Data has been deleted...!" });
						}
					}					
				}
			});
return false
});
	
}); 
</script>
<div id="page">
	<div class="title_wrapper">
		<h2><span id ="heading1">ADD -</span> Opening Balance (2020/12/31 වන දිනට තොගය ඇතුලත් කල විස්තර වෙනස් කිරීම)</h2>
		<span class="title_wrapper_left"></span>
		<span class="title_wrapper_right"></span>
	</div>
	<div class="panel panel-primary">
	<ul class="system_messages" id="message"></ul>	
		</div>
    </div>
 

			<table id="buyerTable" class="tablesorter" cellpadding="1" cellspacing="0" width="100%" border="1" BORDERCOLOR=skyblue style="font-size:11px;">
				<thead>
				<tr>
						<th>S No.</th>
						<th>Item Type</th>
						<th>Item Code</th>
						<th>Description</th>
						<th style="background-color: #CAEEFE;">Ledger Folio</th>
						<th style="background-color: #C4EEFF;">Qty On Hand</th>
						<th style="background-color: #BDEBFF;">Q1 Issue</th>
						<th style="background-color: #B5E9FF;">Q2 Issue</th>
						<th style="background-color: #ABE6FF;">Q3 Issue</th>
						<th style="background-color: #A2E3FF;">Q4 Issue</th>
						<th style="background-color: #99E1FF;">Q5 Issue</th>
						<th style="background-color: #8CDDFF;">Ledger Qty</th>
						<th style="background-color: #7ED8FE;">Save</th>
						<th style="background-color: #FE827E;">Delete</th>						
					</tr>
				</thead>	
				<tbody>
				<?php $i = 1; 
				   foreach ($items as $exp) {
				   ?>																
						<input type="hidden" id="itemtype_<?php echo $exp['id']; ?>" value="<?php echo $exp['itemtype']; ?>" />
						<input type="hidden" id="qstore_<?php echo $exp['id']; ?>" value="<?php echo $exp['qstore']; ?>" />
						<input type="hidden" id="votename_<?php echo $exp['id']; ?>" value="<?php echo $exp['votename']; ?>" />
						<input type="hidden" id="itemcode_<?php echo $exp['id']; ?>" value="<?php echo $exp['itemcode']; ?>" />
						<input type="hidden" id="description_<?php echo $exp['id']; ?>" value="<?php echo $exp['description']; ?>" />
						<tr id = "tr_<?php echo $exp['id']; ?>">
							<td><nobr><?php echo $i; ?></td>
							<td><nobr><?php echo $exp['itemtype']; ?></nobr></td>
							<td><nobr><?php echo $exp['itemcode']; ?></nobr></td>							
							<td title = "<?php echo $exp['description']; ?>"><nobr><?php echo substr($exp['description'],0,60); ?></nobr></td>
							<td style="background-color: #CAEEFE;"><nobr><input class = "sname" type="text" value="<?php echo $exp['ledger_folio']; ?>" id="ledger_folio_<?php echo $exp['id']; ?>" style="text-align: left;font-family: courier;font-size:14px; font-weight:bold;" size="8" onClick="this.select();"></nobr></td>
							<td style="background-color: #C4EEFF;"><nobr><input class = "sname" type="text" value="<?php echo str_replace(".00", "", (string)number_format ((float)$exp['qty_onhand'], 2, ".", "")); ?>" id="qty_onhand_<?php echo $exp['id']; ?>" style="text-align: right; font-family: courier;font-size:14px; font-weight:bold;" size="8" onClick="this.select();" onkeypress="return isNumberKey(event);"></nobr></td>
							<td style="background-color: #BDEBFF;"><nobr><input class = "sname" type="text" value="<?php echo str_replace(".00", "", (string)number_format ((float)$exp['qty_q1'], 2, ".", "")); ?>" id="qty_q1_<?php echo $exp['id']; ?>" style="text-align: right; font-family: courier;font-size:14px; font-weight:bold;" size="8" onClick="this.select();" onkeypress="return isNumberKey(event);"></nobr></td>
							<td style="background-color: #B5E9FF;"><nobr><input class = "sname" type="text" value="<?php echo str_replace(".00", "", (string)number_format ((float)$exp['qty_q2'], 2, ".", "")); ?>" id="qty_q2_<?php echo $exp['id']; ?>" style="text-align: right; font-family: courier;font-size:14px; font-weight:bold;" size="8" onClick="this.select();" onkeypress="return isNumberKey(event);"></nobr></td>
							<td style="background-color: #ABE6FF;"><nobr><input class = "sname" type="text" value="<?php echo str_replace(".00", "", (string)number_format ((float)$exp['qty_q3'], 2, ".", "")); ?>" id="qty_q3_<?php echo $exp['id']; ?>" style="text-align: right; font-family: courier;font-size:14px; font-weight:bold;" size="8" onClick="this.select();" onkeypress="return isNumberKey(event);"></nobr></td>
							<td style="background-color: #A2E3FF;"><nobr><input class = "sname" type="text" value="<?php echo str_replace(".00", "", (string)number_format ((float)$exp['qty_q4'], 2, ".", "")); ?>" id="qty_q4_<?php echo $exp['id']; ?>" style="text-align: right; font-family: courier;font-size:14px; font-weight:bold;" size="8" onClick="this.select();" onkeypress="return isNumberKey(event);"></nobr></td>
							<td style="background-color: #99E1FF;"><nobr><input class = "sname" type="text" value="<?php echo str_replace(".00", "", (string)number_format ((float)$exp['qty_q5'], 2, ".", "")); ?>" id="qty_q5_<?php echo $exp['id']; ?>" style="text-align: right; font-family: courier;font-size:14px; font-weight:bold;" size="8" onClick="this.select();" onkeypress="return isNumberKey(event);"></nobr></td>
							<td style="background-color: #8CDDFF;"><nobr><input class = "sname" type="text" value="<?php echo str_replace(".00", "", (string)number_format ((float)$exp['qty_ledger'], 2, ".", "")); ?>" id="qty_ledger_<?php echo $exp['id']; ?>" style="text-align: right; font-family: courier;font-size:14px; font-weight:bold;" size="8" onClick="this.select();" onkeypress="return isNumberKey(event);" readonly></nobr></td>
							<td style="background-color: #7ED8FE;"><nobr><input class = "savebttn" id = "<?php echo $exp['id']; ?>" name="submit" type="submit" value="Save" hidden/></nobr></td>
							<td style="background-color: #7ED8FE;"><nobr><button type="button" class="deletebttn btn btn-danger btn-xs" id = "del_<?php echo $exp['id']; ?>"> <span class="fa fa-remove"></span> Delete </button></td>
						</tr>					
						<?php $i++; 
					} ?> 
				</tbody>
			</table>
</div>
	
</div>	
<?php
include '../view/footer.php';
?>











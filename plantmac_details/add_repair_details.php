<?php include 'header1.php';?>
<script>
    jQuery(document).ready(function () {
    $('.date').datepicker({dateFormat: 'yy-mm-dd',
        maxDate: '0',
		changeMonth : true,
        changeYear: true});


	$(".nr").dblclick(function() {
	var $row = $(this).closest("tr");
	var $td2 = $row.find("td:nth-child(2)");
	var $td3 = $row.find("td:nth-child(3)");
	var $td4 = $row.find("td:nth-child(4)");
	$("#vehicle_id").val($td2.text());
	$("#identificationno").val($td3.text());
	$("#armyno").val($td4.text());
	$("#r_date").val("");
	$("#r_type").val("");
	$("#r_desc").val("");
	$("#r_amount").val("");
	$vehicle_id = $td2.text();
	populate_repair_table($vehicle_id);
	$('#message').html('<li class="blue"><span class="ico"></span><strong class="system_title">Enter Data and  press "Add Details" Button</strong></li>');
	$("html, body").animate({scrollTop: 0}, "slow");
});

$('#armyno').focus(function() {
  $( this ).blur();
});
$('#identificationno').focus(function() {
  $( this ).blur();
});

$("#add_form").validate({
	rules: {
		"armyno": {
			required: true
		},
		"identificationno": {
			required: true
		},
		"r_date": {
			required: true
		},
		"r_amount": {
			required: true
		}
	},
	submitHandler: function () {
		var formData = $("#add_form").serialize();
		$.post('index.php', formData, processData).error(errorResponse);
		function processData(data) {
			//alert(data);
			if (data == '1') {
				$('#message').html('<li class="green"><span class="ico"></span><strong class="system_title">Data Successfully Saved.</strong></li>');				
			} else if (data == '3') {
				$('#message').html('<li class="red"><span class="ico"></span><strong class="system_title">Error in Saving, Details Already Entered</strong></li>');
			} else {
				$('#message').html('<li class="red"><span class="ico"></span><strong class="system_title">Error in Saving</strong></li>');
			}
			populate_repair_table($("#vehicle_id").val());
		} // end processData
		function errorResponse() {
		alert('Data Not Saved');
		}
		return false;
	}
});

function populate_repair_table(vehicle_id)
{
 	var querystring = {
			vehicle_id: vehicle_id,				 
			action: 'populate_repair_table'
		}
		$.get('index.php', querystring, processResponse);
	 function processResponse(result) {
				var data = $.parseJSON(result);
				$('#details_table tr').not(':first').remove();
                var i = 1;
                $.each(data, function (key, value) {
                    html = '<tr id="tr_' + value.id + '"><td>' + i +
                            '</td><td><nobr>' + value.r_date +
                            '</nobr></td><td>' + value.r_type +
                            '</td><td>' + value.r_amount +							
							'</td><td><input type="button" class="delbtn" <?php if ($_SESSION['SESS_LEVEL'] != 1) { echo "disabled"; } ?> value="Delete" id="' + value.id + '"></td></tr>';
					$('#details_table tr:last').after(html);
                    i++;
                });
		}
}

$(document).on("click", ".delbtn", function() {
	if (confirm("Are you sure?")) {
	var id = $(this).attr('id');
	var querystring = {
		id: id,
        action: 'delete_vehicle_repair_record'
        }
		$.get('index.php', querystring, processResponse);
		function processResponse(data) {
			populate_repair_table($("#vehicle_id").val());	
		} // end processData
    }
    });

    });

function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode != 46 &&(charCode < 48 || charCode > 57)))
        return false;
    return true;
}
</script>


<style>
#col-1 {
  position: relative;
  width: 60%;
  float: left;
  height: 100%;
}

#col-2 {
  position: relative;
  width: 40%;
  float: left;
  height: 100%;
}
</style>
<div id="page">
    <div class="section table_section">
        <div class="title_wrapper">
            <h2>Add Plant & Machinery Repair Details</h2>
            <span class="title_wrapper_left"></span>
            <span class="title_wrapper_right"></span>
        </div>
        <form action="." method="post" id="record_status">
            <input type="hidden" name="action" value="add_repair_details"/>
            <table width="1009" border="0">
                <tr>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td>
                        <b><?php echo $tList[0][$lang]?></b>
                    </td>
                    <td>
                        <select name="assetscenter" onChange="getAssetsUnitByCenter('index.php?action=findAssetsUnitsByCenter&center=' + this.value)">
                            <option value=""></option>
                            <?php foreach ($assetsCenters as $center) { ?>
                                <option value="<?php echo $center->getName(); ?>" <?php if ($assetscenter == $center->getName()) echo "selected = 'selected'"; ?>>
                                    <?php echo $center->getName(); ?>
                                </option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                    </td>
                    <td>
                        <b><?php echo $tList[1][$lang]?></b>
                    </td>
                    <td>   
                        <div id="Unitdiv">
                            <select name="assetunit" onChange="getPresentUnitByUnit('index.php?action=findPresentUnitByUnit&unit=' + this.value)">
                                <option value=""></option>
                                <?php foreach ($assetunits as $unit) { ?>
                                    <option value="<?php echo $unit->getName(); ?>" <?php if ($assetunit == $unit->getName()) echo "selected = 'selected'"; ?>>
                                        <?php echo $unit->getName(); ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td> </td>
                    <td> </td>
                    <td>  
                        <input type="submit" value="Search" /> 
                    </td>
                </tr>
            </table>
        </form>
<div id="col-1">
        <div class="title_wrapper">
            <h2>Plant & Machinery Details</h2>
            <span class="title_wrapper_left"></span>
            <span class="title_wrapper_right"></span>
        </div>
        <div class="section_content">
            <div class="sct">
                <div class="sct_left">
                    <div class="sct_right">
                        <div class="sct_left">
                            <div class="sct_right">
									<div class="table_wrapper">
									<div class="table_wrapper_inner">
                                        <table id="abc" class="tablesorter" cellpadding="1" cellspacing="0" width="100%" border="1" BORDERCOLOR=skyblue style="font-size:11px;">
											<thead>
												<tr>
												<th>S/N</th>
												<th><nobr>Identification No</nobr></th>
												<th><nobr>Description</nobr></th>
												<th><nobr>Serial No.</nobr></th>
												<th><nobr>Unit Value</nobr></th>                                     
												</tr>
											</thead>
											<tbody>
                                                        <?php $i = 1; ?>
                                                        <?php foreach ($items as $exp) { ?>																
                                                            <tr class="nr">
																<td><?php echo $i; ?></td>
																<td hidden><?php echo $exp['id']; ?></td>
																<td><?php echo $exp['identificationno']; ?></td>
                                                                <td><nobr><?php echo $exp['itemDescription']; ?></nobr></td>
                                                                <td><nobr><?php echo $exp['eqptSriNo']; ?></nobr></td>
                                                                <td align="right"><nobr><?php echo $exp['unitValue']; ?></nobr></td>																															
                                                            </tr>
                                                            <?php $i++; ?>
                                                        <?php } ?> 
                                                        </tbody></table>
                                                        </div>
														 </div>


                                                        </div>
                                                        </div>
                                                        </div>
                                                        </div>
                                                        </div>
                                                        <span class="scb"><span class="scb_left"></span><span class="scb_right"></span></span>						
                                                        </div>
				</div>
				<div id="col-2">
        <div class="title_wrapper">
            <h2>Repair Details</h2>
            <span class="title_wrapper_left"></span>
            <span class="title_wrapper_right"></span>
        </div>
		<div class="section_content">
            <div class="sct">
                <div class="sct_left">
                    <div class="sct_right">
                        <div class="sct_left">
                            <div class="sct_right">
									<div id="confirm" title="Confirm Destruction"></div>
                                    <ul id="message" class="system_messages">
                                        <li class="blue"><span class="ico"></span><strong class="system_title">Enter Data and  press "Add Details" Button</strong></li>
                                    </ul>
                                    <form name="add_form" method="post" id="add_form" action="index.php" class="add_form"> 
                                        <input type="hidden" name="action" value="add_vehicle_repair_record" />
										<input type="hidden" name="vehicle_id" id="vehicle_id" value="" />
                                        <div><label for="model" class="label">Vehicle Number :</label><input type="text" class="text" name="armyno"  id="armyno" style="width:100px"/></div>
										<div><label for="model" class="label">Vehicle Identification No :</label><input type="text" class="text" name="identificationno"  id="identificationno" style="width:220px"/></div>
										<div><label for="model" class="label">Vehicle Repair Date :</label><input type="text" class="date" name="r_date" id="r_date" style="width:100px" autocomplete="off"/></div>
										<div><label for="brand" class="label">Vehicle Repair Type :</label>
										<select name="r_type" id="r_type">
                                                                <option value=""></option>
                                                                <?php foreach ($v_repairtype as $cat) { ?>
                                                                    <option value="<?php echo $cat['details']; ?>">
                                                                        <?php echo $cat['details']; ?>
                                                                    </option>
                                                                <?php } ?>
                                                            </select></div>
										<div><label for="model" class="label">Repair Description :</label><input type="text" class="text" name="r_desc"  id="r_desc" style="width:300px" autocomplete="off"/></div>
										<div><label for="model" class="label">Repair Amount  :</label><input type="text" class="text" name="r_amount"  id="r_amount" style="width:100px; text-align:right;" onkeypress="return isNumberKey(event)" autocomplete="off"/></div>
										<div><input type="submit" name="submit" id="submit" value="Add Details"></div>										
                                    </form>
									<div class="table_wrapper">
									<div class="table_wrapper_inner">
                                        <table id="details_table" class="tablesorter" cellpadding="1" cellspacing="0" width="100%" border="1" BORDERCOLOR=skyblue style="font-size:11px;">
											<thead>
												<tr>
												<th>S/N</th>
													<th nowrap="nowrap"><nobr>Repair Date</nobr></th>
													<th nowrap="nowrap"><nobr>Repair Type</nobr></th>
													<th nowrap="nowrap"><nobr>Amount</nobr></th>
													<th></th>													
												</tr>
											</thead>
											<tbody>

											</tbody>
											</table>
									</div>
									</div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <span class="scb"><span class="scb_left"></span><span class="scb_right"></span></span>						
        </div>
		</div>	
        </div>
        </div>
                                                        <?php
                                                        include '../view/footer.php';
                                                        ?>
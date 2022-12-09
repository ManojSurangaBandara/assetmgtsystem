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
		} // end processData
		function errorResponse() {
		alert('Data Not Saved');
		}
		return false;
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
            <h2>Add Vehicle Repair Details</h2>
            <span class="title_wrapper_left"></span>
            <span class="title_wrapper_right"></span>
        </div>
        <form action="." method="post" id="record_status">
            <input type="hidden" name="action" value="add_vehicle_repair"/>
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
            <h2>Vehicle Details</h2>
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
													<th nowrap="nowrap"><nobr>Army No</nobr></th>
													<th nowrap="nowrap"><nobr>Description</nobr></th>
													<th nowrap="nowrap"><nobr>Brand</nobr></th>
													<th nowrap="nowrap"><nobr>Model</nobr></th>
													<th nowrap="nowrap"><nobr>Engine No</nobr></th>
													<th nowrap="nowrap"><nobr>Chassis No</nobr></th>                                         
												</tr>
											</thead>
											<tbody>
                                                        <?php $i = 1; ?>
                                                        <?php foreach ($items as $exp) { ?>																
                                                            <tr class="nr">
																<td><?php echo $i; ?></td>
																<td hidden><?php echo $exp['id']; ?></td>
																<td hidden><?php echo $exp['identificationno']; ?></td>
																<td><?php echo $exp['armyno']; ?></td>
																<td><?php echo $exp['itemDescription']; ?></td> 
																<td><?php echo $exp['brandName']; ?></td>
																<td><?php echo $exp['modelName']; ?></td>
																<td><?php echo $exp['engineno']; ?></td>
                                                                <td><?php echo $exp['chessisno']; ?></td>																																
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
                                        <table id="abc1" class="tablesorter" cellpadding="1" cellspacing="0" width="100%" border="1" BORDERCOLOR=skyblue style="font-size:11px;">
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
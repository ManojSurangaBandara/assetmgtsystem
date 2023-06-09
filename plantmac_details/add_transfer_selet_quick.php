<?php
include 'header1.php';
?>

<script>	
$(document).ready(function () {

    $('#transferToCenter').change(function() {
        getAsstUnit($(this).val(), "");
    });

    function getAsstUnit(assetscenter, assetunit)
    {
        var querystring = {
            center: assetscenter,
            action: 'findAssetsUnitsByCenterAll_Ajax'
        }
        $.get('index.php', querystring, processResponse);
        function processResponse(result) {
            var numbers = $.parseJSON(result);
            var option = '<option></option>';
            for (var i = 0; i < numbers.length; i++) {
                option += '<option value="' + numbers[i] + '">' + numbers[i] + '</option>';
            }
            $('#transferToUnit').html(option);
            $('#transferToUnit option[value="' + assetunit + '"]').attr('selected', 'selected');
        } // end processData
    }
$(".savebttn").click(function(){
	var id = $(this).attr('id');
        if ($('#transferToUnit').val() == '' && $('#transferSelect_'+id).val() == 0) {
		alert('Select Transfer Unit');
	} else {
	var transferToCenter = $('#transferToCenter').val();
	var transferToUnit = $('#transferToUnit').val();
	var transferSelect = $('#transferSelect_'+id).val() == 0 ? 1 : 0;
        
        if (transferSelect == 1){
		$(this).closest('tr').children('td,th').css('background-color','#F6DDCC');
	} else {
		$(this).closest('tr').children('td,th').css('background-color','#FFFFFF');
	}

 	 var querystring = {
			id: id,
			transferToCenter: transferToCenter,
			transferToUnit: transferToUnit,
			transferSelect: transferSelect,
			action: 'transfer_selet_quick_save'
		}
		$.get('index.php', querystring, processResponse);
	 function processResponse(result) {
		//alert(result);
		}
            }
	return false
});
}); 
</script>
<div id="page">

    <div class="section table_section">
        <form action="." method="post" id="search_Expendable__form">
            <input type="hidden" name="action" value="transfer_selet_quick"/>
            <table width="100%" border="0">
                <tr>                    
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
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
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <b><?php echo $tList[1][$lang]?></b>
                    </td>
                    <td>   
                        <div id="Unitdiv">
                            <select name="assetunit" id="assetunit" onChange="getPresentUnitByUnit('index.php?action=findPresentUnitByUnit&unit=' + this.value)">
                                <option value=""></option>
                                <?php foreach ($assetunits as $unit) { ?>
                                    <option value="<?php echo $unit->getName(); ?>" <?php if ($assetunit == $unit->getName()) echo "selected = 'selected'"; ?>>
                                        <?php echo $unit->getName(); ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </td>
                    <td></td>
                </tr>

                <tr>
                    <td></td>
                    <td></td>
                    <td>  
                        <input type="submit" value="Search" />
                    </td>
                    <td>  
                    </td> 
                </tr>
					<tr>
					<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
					<td width="30%"><label><b><?php echo $tList[25][$lang]?></b></label></td>
						<td width="70%">
							<select name="transferToCenter" id="transferToCenter">
								<option value=""></option>
								<?php foreach ($assetsCenters_all as $center) { ?>
									<option value="<?php echo $center->getName(); ?>">
										<?php echo $center->getName(); ?>
									</option>
								<?php } ?>
							</select>
						</td>	
				</tr>
            <tr>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
				<td width="30%"><label><b><?php echo $tList[26][$lang]?></b></label></td>
				<td width="70%">
					<div id="Unitdiv">
						<select name="transferToUnit" id="transferToUnit">
							<option value=""></option>
							<?php foreach ($assetunits_all as $unit) { ?>
								<option value="<?php echo $unit->getName(); ?>">
									<?php echo $unit->getName(); ?>
								</option>
							<?php } ?>
						</select>
				</div>
			</tr>
			
			</table>
        </form>
		

													
        <div class="title_wrapper"> 
			<h2>Plant & Machinery Details - Transfer Select - Quick</h2>
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
                                    <div class="table_wrapper_inner">
                                        <table cellpadding="1" cellspacing="0" width="100%" border="1" BORDERCOLOR=skyblue style="font-size:11px;">
                                            <thead>
                                            <th>S/N</th>
                                            <th>Identification No</th>							
                                            <th>Category</th>
                                            <th>Description</th>
                                            <th>Asset No</th>
                                            <th>Catalogue No</th>
                                            <th>Serial No.</th>
                                            <th style="width: 8%;">DOP</th>
                                            <th style="width: 8%;">DOR</th>
                                            <th>Unit Value</th>
											 <th></th>
											<th>Transfer To</th>
                                              </thead>          
											<tbody>
                                                        <?php $i = 1; ?>
                                                        <?php foreach ($items as $exp) { ?>																
                                                            <tr <?php if ($exp['transferSelect'] == 1) { echo "bgcolor='#33cccc'"; } ?>>
                                                                <td><?php echo $i; ?></td>
                                                                <td><?php echo $exp['identificationno']; ?></td>
																<td><?php echo $exp['itemCategory']; ?></td>
                                                                <td><?php echo $exp['itemDescription']; ?></td>
                                                                <td><?php echo $exp['assetsno']; ?></td>
                                                                <td><?php echo $exp['catalogueno']; ?></td>
																<td><?php echo $exp['eqptSriNo']; ?></td>
																<td><?php echo $exp['purchasedDate']; ?></td>
																<td><?php echo $exp['receivedDate']; ?></td>
																<td><?php echo $exp['unitValue']; ?></td>
																<td><form name="add_form" id="add_form" class="add_form" action="." method="post">
																	<input type="hidden" name="transferSelect_<?php echo $exp['id']; ?>" id="transferSelect_<?php echo $exp['id']; ?>" value="<?php echo $exp['transferSelect']; ?>"/>
																	<input class = "savebttn" id = "<?php echo $exp['id']; ?>" name="submit" type="submit" value="<?php echo $exp['transferSelect'] == 1 ? "Unselect Transfer" : "select Transfer"; ?>"/>
																</form>
																</td>
																<td><?php echo $exp['transferToUnit']; ?></td>
                                                            </tr>
                                                            <?php $i++; ?>
                                                        <?php } ?> 
                                                        </tbody></table>
                                                        </div>

                                                        </fieldset>


                                                        </div>
                                                        </div>
                                                        </div>
                                                        </div>
                                                        </div>
                                                        <span class="scb"><span class="scb_left"></span><span class="scb_right"></span></span>						
                                                        </div>
                                                        </div>

                                                        </div>
                                                        <?php
                                                        include '../view/footer.php';
                                                        ?>
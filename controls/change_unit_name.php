<?php include 'header1.php';?>
<script>	
$(document).ready(function() {
		$('table').tablesorter({
			widgets        : ['stickyHeaders'],
			usNumberFormat : false,
			sortReset      : true,
			sortRestart    : true
		});	
    $('#assetscenter').change(function() {
        getAsstUnit($(this).val(), "");
    });
    function getAsstUnit(assetscenter, assetunit)
    {
        var querystring = {
            center: assetscenter,
            action: 'findAssetsUnitsByCenter_Ajax'
        }
        $.get('index.php', querystring, processResponse);
        function processResponse(result) {
            var numbers = $.parseJSON(result);
            var option = '<option></option>';
            for (var i = 0; i < numbers.length; i++) {
                option += '<option value="' + numbers[i] + '">' + numbers[i] + '</option>';
            }
            $('#assetunit').html(option);
            $('#assetunit option[value="' + assetunit + '"]').attr('selected', 'selected');
        } // end processData
    }
    ;	
    $('#assetscenter1').change(function() {
        getAsstUnit1($(this).val(), "");
    });
    function getAsstUnit1(assetscenter, assetunit)
    {
        var querystring = {
            center: assetscenter,
            action: 'findAssetsUnitsByCenter_Ajax'
        }
        $.get('index.php', querystring, processResponse);
        function processResponse(result) {
            var numbers = $.parseJSON(result);
            var option = '<option></option>';
            for (var i = 0; i < numbers.length; i++) {
                option += '<option value="' + numbers[i] + '">' + numbers[i] + '</option>';
            }
            $('#assetunit1').html(option);
            $('#assetunit1 option[value="' + assetunit + '"]').attr('selected', 'selected');
        } // end processData
    }
    ;
});
</script>
<style>
#col-1 {
  position: relative;
  width: 50%;
  float: left;
  height: 100%;
  z-index: 1010101010
}

#col-2 {
  position: relative;
  width: 50%;
  float: left;
  height: 100%;
  z-index: 1010101010
}
</style>


<div id="page">
        <div class="section">
              <div class="title_wrapper" id="title">
                <span><h2>Change Unit Name</h2></span>
                <span class="title_wrapper_left"></span>
                <span class="title_wrapper_right"></span>
            </div>

   <ul class="system_messages">
	<?php
	switch ($error) {
		case '0':
			?>
			<li class="blue"><span class="ico"></span><strong class="system_title" style="font-size:15px";>Current Designation යනු දැනට තිබෙන ඒකකයයි. New Designation යනු අළුත් ඒකකයයි. ඒකක දෙක නිවැරදිව තෝරා "Change Unit Name" Button එක Click කරන්න.</strong></li>
			<?php
			break;
		case '1':
			?>
			<li class="green"><span class="ico"></span><strong class="system_title" style="font-size:15px";>ඒකකයෙහි නම වෙනස් කරන ලදි. </strong></li>
			<?php
			break;
		case '2':
			?>
			<li class="red"><span class="ico"></span><strong class="system_title" style="font-size:15px";>New Designation හි දත්තයන් ඇතුලත් කර ඇත.   ඒවා සියල්ල ඉවත්කරන්න.</strong></li>
			<?php
			break;
			} ?>
</ul> 
<div id="col-1">
              <div class="title_wrapper" id="title">
                <span><h2>Current Designation</h2></span>
                <span class="title_wrapper_left"></span>
                <span class="title_wrapper_right"></span>
            </div>
				<div class="section_content">
                <div class="sct">
                    <div class="sct_left">
                        <div class="sct_right">
                            <div class="sct_left">
                                <div class="sct_right">
									<form name="add_form" method="post" id="add_form" action="index.php" class="add_form"> 
                                        <input type="hidden" name="action" value="change_unit_name" />
										<label for="assetscenter" class="label">Assets Center :</label>
                                        <div> 
                                            <select name="assetscenter" id="assetscenter">
                                                <option value=""></option>
                                                <?php foreach ($assetsCenters as $center) { ?>
                                                    <option value="<?php echo $center->getName(); ?>" <?php if ($assetscenter == $center->getName()) echo "selected = 'selected'"; ?>>
                                                <?php echo $center->getName(); ?>
                                                    </option>
												<?php } ?>
												</select>
										</div>
												<label for="assetunit" class="label">Assets Unit :</label>                                                        
                                        <div>
                                            <select name="assetunit" id="assetunit">
                                                <option value=""></option>
                                                <?php foreach ($assetunits as $unit) { ?>
                                                    <option value="<?php echo $unit->getName(); ?>" <?php if ($assetunit == $unit->getName()) echo "selected = 'selected'"; ?>>
                                                <?php echo $unit->getName(); ?>
                                                    </option>
												<?php } ?></select>
											<br />
                                        </div>
										<div><input type="submit" name="submit" id="submit" value="Search"></div>
									</form>
									</div>
                    </div>
                </div>
            </div>
        </div>
  </div>
</div>
<div id="col-2">
              <div class="title_wrapper" id="title">
                <span><h2>New Designation</h2></span>
                <span class="title_wrapper_left"></span>
                <span class="title_wrapper_right"></span>
            </div>
				<div class="section_content">
                <div class="sct">
                    <div class="sct_left">
                        <div class="sct_right">
                            <div class="sct_left">
                                <div class="sct_right">
									<form name="add_form" method="post" id="add_form" action="index.php" class="add_form"> 
                                        <input type="hidden" name="action" value="change_unit_name" />
										<input type="hidden" name="assetscenter" value="<?php echo $assetscenter; ?>" />
										<input type="hidden" name="assetunit" value="<?php echo $assetunit; ?>" />
										<label for="assetscenter1" class="label">Assets Center :</label>
                                        <div> 
                                            <select name="assetscenter1" id="assetscenter1">
                                                <option value=""></option>
                                                <?php foreach ($assetsCenters as $center) { ?>
                                                    <option value="<?php echo $center->getName(); ?>" <?php if ($assetscenter1 == $center->getName()) echo "selected = 'selected'"; ?>>
                                                <?php echo $center->getName(); ?>
                                                    </option>
												<?php } ?>
												</select>
										</div>
												<label for="assetunit1" class="label">Assets Unit :</label>                                                        
                                        <div>
                                            <select name="assetunit1" id="assetunit1">
                                                <option value=""></option>
                                                <?php foreach ($assetunits as $unit) { ?>
                                                    <option value="<?php echo $unit->getName(); ?>" <?php if ($assetunit1 == $unit->getName()) echo "selected = 'selected'"; ?>>
                                                <?php echo $unit->getName(); ?>
                                                    </option>
												<?php } ?></select>
											<br />
                                        </div>
										<div><input type="submit" name="submit" id="submit" value="Change Unit Name" style="background-color:red;color:white;" onclick="return confirm('Are you sure you want to Change?');"></div>
									</form>
									</div>
                    </div>
                </div>
            </div>
        </div>
  </div>
</div>
 <div class="section_content">
            <div class="sct">
                <div class="sct_left">
                    <div class="sct_right">
                        <div class="sct_left">
                            <div class="sct_right">
                                   <div class="title_wrapper">
										<h2>Land Details List</h2>
										<span class="title_wrapper_left"></span>
										<span class="title_wrapper_right"></span>
									</div>    
									<div class="table_wrapper_inner">
                                        <table id="abc" class="tablesorter" cellpadding="1" cellspacing="0" width="100%" border="1" BORDERCOLOR=skyblue style="font-size:11px;">
											<thead>
												<tr>
                                                <th><nobr>S/N</nobr></th>
												<th><nobr>Identification No</nobr></th>												
                                                <th><nobr>Category Name</nobr></th>
                                                <th><nobr>District</nobr></th>
                                                <th><nobr>DS Division</nobr></th>
                                                <th><nobr>GS Division</nobr></th>
												<th><nobr>Land Registration Number/Date</nobr></th>
												<th><nobr>Plan Number</nobr></th>
												<th><nobr>Land Name</nobr></th>												
                                                <th><nobr>Area(Hect)</nobr></th>
												<th><nobr>Area(Acre/Rood/Parch)</nobr></th>
                                                <th><nobr>Estimated Value</nobr></th>
                                                </tr>
											</thead>
											<tbody>
                                                <?php $i = 1; 
												$totvalue = 0;?>
                                                <?php foreach ($Landitems as $exp) { ?>																
                                                    <tr>
                                                        <td><nobr><?php echo $i; ?></nobr></td>
														<td><nobr><?php echo $exp['identificationno']; ?></nobr></td>
                                                        <td><nobr><?php echo $exp['category']; ?></nobr></td>
                                                        <td><nobr><?php echo $exp['district']; ?></nobr></td>
                                                        <td><nobr><?php echo $exp['dsDivision']; ?></nobr></td>
														<td><nobr><?php echo $exp['gsDivision']; ?></nobr></td>	
                                                        <td><nobr><?php echo $exp['register']; ?></nobr></td>
														<td><nobr><?php echo $exp['planno']; ?></nobr></td>
														<td><nobr><?php echo $exp['landname']; ?></nobr></td>
                                                        <td align="right"><nobr><?php echo number_format($exp['area'], 2, '.', ','); ?></nobr></td>
														<td align="right"><nobr><?php echo $exp['acre']."A, ".$exp['rood']."R, ".number_format($exp['parch'], 2, '.', ',')."P "; ?></nobr></td>
                                                        <td align="right"><nobr><?php echo number_format($exp['estimatedValue'], 2, '.', ','); ?></nobr></td>
                                                    </tr>
                                                    <?php $i++; 
													      $totvalue = $totvalue + $exp['estimatedValue']; ?>
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
  <div class="section_content">
            <div class="sct">
                <div class="sct_left">
                    <div class="sct_right">
                        <div class="sct_left">
                            <div class="sct_right">
                                   <div class="title_wrapper">
										<h2>Building Details List</h2>
										<span class="title_wrapper_left"></span>
										<span class="title_wrapper_right"></span>
									</div>    
									<div class="table_wrapper_inner">
                                        <table id="abc" class="tablesorter" cellpadding="1" cellspacing="0" width="100%" border="1" BORDERCOLOR=skyblue style="font-size:11px;">
											<thead>
												<tr>
                                                <th><nobr>S/N</nobr></th>
												<th><nobr>Identification No</nobr></th>												
                                                <th><nobr>Category Name</nobr></th>
												<th><nobr>Assets No</nobr></th>
												<th><nobr>Classification No</nobr></th>
												<th><nobr>Building Type</nobr></th>
                                                <th><nobr>District</nobr></th>
                                                <th><nobr>DS Division</nobr></th>
                                                <th><nobr>GS Division</nobr></th>
												<th><nobr>Plan Number</nobr></th>												
                                                <th><nobr>Area(Sqr Mtrs)</nobr></th>
												<th><nobr>Area(Sqr Foot)</nobr></th>
                                                <th><nobr>Consruction Cost</nobr></th>
												<th><nobr>Consruction Year</nobr></th>
                                                </tr>
											</thead>
											<tbody>
                                                <?php $i = 1; 
												$totvalue = 0;?>
                                                <?php foreach ($Buildingitems as $exp) { ?>																
                                                    <tr>
                                                        <td><nobr><?php echo $i; ?></nobr></td>
														<td><nobr><?php echo $exp['identificationno']; ?></nobr></td>
                                                        <td><nobr><?php echo $exp['buildingCategory']; ?></nobr></td>
														<td><nobr><?php echo $exp['assetsno']; ?></nobr></td>
														<td><nobr><?php echo $exp['classificationno']; ?></nobr></td>
														<td><nobr><?php echo $exp['buildingType']; ?></nobr></td>
                                                        <td><nobr><?php echo $exp['district']; ?></nobr></td>
                                                        <td><nobr><?php echo $exp['dsDivision']; ?></nobr></td>
														<td><nobr><?php echo $exp['gsDivision']; ?></nobr></td>	
														<td><nobr><?php echo $exp['planno']; ?></nobr></td>
                                                        <td align="right"><nobr><?php echo number_format($exp['area'], 2, '.', ','); ?></nobr></td>
														<td align="right"><nobr><?php echo number_format($exp['feets'], 2, '.', ','); ?></nobr></td>
                                                        <td align="right"><nobr><?php echo number_format($exp['constructionCost'], 2, '.', ','); ?></nobr></td>
														<td align="right"><nobr><?php echo date('Y', strtotime($exp['acquisitiondate'])); ?></nobr></td>
                                                    </tr>
                                                    <?php $i++;?>
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
 <div class="section_content">
         <div class="sct">
                <div class="sct_left">
                    <div class="sct_right">
                        <div class="sct_left">
                            <div class="sct_right">
                                   <div class="title_wrapper">
										<h2>Plant & Machinery Details List</h2>
										<span class="title_wrapper_left"></span>
										<span class="title_wrapper_right"></span>
									</div>    
									<div class="table_wrapper_inner">
                                        <table id="abc" class="tablesorter" cellpadding="1" cellspacing="0" width="100%" border="1" BORDERCOLOR=skyblue style="font-size:11px;">
                                             <thead>
											 <tr>
                                            <th><nobr>S/N</nobr></th>
                                            <th><nobr>Identification No</nobr></th>
                                            <th><nobr>Category</nobr></th>
                                            <th><nobr>Description</nobr></th>
                                            <th><nobr>Asset No</nobr></th>
                                            <th><nobr>Catalogue No</nobr></th>
                                            <th><nobr>Serial No.</nobr></th>
                                            <th><nobr>DOP</nobr></th>
                                            <th><nobr>DOR</nobr></th>
                                            <th><nobr>Unit Value</nobr></th>
											</tr>
                                           </thead>
														<tbody>
                                                        <?php $i = 1; 
														$totvalue = 0;?>
                                                        <?php foreach ($Plantitems as $exp) { ?>																
                                                            <tr>
                                                                <td><nobr><?php echo $i; ?></nobr></td>
                                                                <td><nobr><?php echo $exp['identificationno']; ?></nobr></td>
																<td><nobr><?php echo $exp['itemCategory']; ?></nobr></td>
                                                                <td><nobr><?php echo $exp['itemDescription']; ?></nobr></td>
                                                                <td><nobr><?php echo $exp['assetsno']; ?></nobr></td>
                                                                <td><nobr><?php echo $exp['catalogueno']; ?></nobr></td>
                                                                <td><nobr><?php echo $exp['eqptSriNo']; ?></nobr></td>
                                                                <td><nobr><?php echo $exp['purchasedDate']; ?></nobr></td>
                                                                <td><nobr><?php echo $exp['receivedDate']; ?></nobr></td>
                                                                <td align="right"><nobr><?php echo number_format($exp['unitValue'], 2, '.', ','); ?></nobr></td>
                                                            </tr>
                                                            <?php $i++; 
															$totvalue = $totvalue + $exp['unitValue'];?>
                                                        <?php } ?> 
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
												  <td align="right"><?php echo number_format($totvalue, 2, '.', ','); ?></td>
												</tr>
											  </tfoot></table>
                                                        </div>
                                                        </fieldset>
                                                        </div>
                                                        </div>
                                                        </div>
                                                        </div>
                                                        </div>					
                                                        </div>								
 <div class="section_content">
            <div class="sct">
                <div class="sct_left">
                    <div class="sct_right">
                        <div class="sct_left">
                            <div class="sct_right">
                                   <div class="title_wrapper">
										<h2>Officer Equipment Details List</h2>
										<span class="title_wrapper_left"></span>
										<span class="title_wrapper_right"></span>
									</div>    
									<div class="table_wrapper_inner">
                                        <table id="abc" class="tablesorter" cellpadding="1" cellspacing="0" width="100%" border="1" BORDERCOLOR=skyblue style="font-size:11px;">
                                             <thead>
											 <tr>
                                            <th><nobr>S/N</nobr></th>
                                            <th><nobr>Identification No</nobr></th>
                                            <th><nobr>Category</nobr></th>
                                            <th><nobr>Description</nobr></th>
                                            <th><nobr>Asset No</nobr></th>
                                            <th><nobr>Catalogue No</nobr></th>
                                            <th><nobr>Serial No.</nobr></th>
                                            <th><nobr>DOP</nobr></th>
                                            <th><nobr>DOR</nobr></th>
                                            <th><nobr>Unit Value</nobr></th>
											</tr>
                                           </thead>
														<tbody>
                                                        <?php $i = 1; 
														$totvalue = 0;?>
                                                        <?php foreach ($Officeitems as $exp) { ?>																
                                                            <tr>
                                                                <td><nobr><?php echo $i; ?></nobr></td>
                                                                <td><nobr><?php echo $exp['identificationno']; ?></nobr></td>
																<td><nobr><?php echo $exp['itemCategory']; ?></nobr></td>
                                                                <td><nobr><?php echo $exp['itemDescription']; ?></nobr></td>
                                                                <td><nobr><?php echo $exp['assetsno']; ?></nobr></td>
                                                                <td><nobr><?php echo $exp['catalogueno']; ?></nobr></td>
                                                                <td><nobr><?php echo $exp['eqptSriNo']; ?></nobr></td>
                                                                <td><nobr><?php echo $exp['purchasedDate']; ?></nobr></td>
                                                                <td><nobr><?php echo $exp['receivedDate']; ?></nobr></td>
                                                                <td align="right"><nobr><?php echo number_format($exp['unitValue'], 2, '.', ','); ?></nobr></td>
                                                            </tr>
                                                            <?php $i++; 
															$totvalue = $totvalue + $exp['unitValue'];?>
                                                        <?php } ?> 
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
												  <td align="right"><?php echo number_format($totvalue, 2, '.', ','); ?></td>
												</tr>
											  </tfoot></table>
                                                        </div>
                                                        </fieldset>
                                                        </div>
                                                        </div>
                                                        </div>
                                                        </div>
                                                        </div>					
                                                        </div>									
 <div class="section_content">
            <div class="sct">
                <div class="sct_left">
                    <div class="sct_right">
                        <div class="sct_left">
                            <div class="sct_right">
                                   <div class="title_wrapper">
										<h2>Vehicle Details List</h2>
										<span class="title_wrapper_left"></span>
										<span class="title_wrapper_right"></span>
									</div>    
									<div class="table_wrapper_inner">
                                        <table id="abc" class="tablesorter" cellpadding="1" cellspacing="0" width="100%" border="1" BORDERCOLOR=skyblue style="font-size:11px;">
                                             <thead>
											 <tr>
                                            <th>S/N</th>
											<th nowrap="nowrap"><nobr>Assets Unit</nobr></th>
											<th nowrap="nowrap"><nobr>Vehicle Type</nobr></th>
                                            <th nowrap="nowrap"><nobr>Identification No</nobr></th>
                                            <th nowrap="nowrap"><nobr>Category</nobr></th>
                                            <th nowrap="nowrap"><nobr>Description</nobr></th>
											<th nowrap="nowrap"><nobr>Capacity</nobr></th>
                                            <th nowrap="nowrap"><nobr>Fuel</nobr></th>
                                            <th nowrap="nowrap"><nobr>Catalogue No</nobr></th>
                                            <th nowrap="nowrap"><nobr>Engine No</nobr></th>
                                            <th nowrap="nowrap"><nobr>Chassis No</nobr></th>
                                            <th nowrap="nowrap"><nobr>Brand</nobr></th>
                                            <th nowrap="nowrap"><nobr>Model</nobr></th>											
                                            <th nowrap="nowrap"><nobr>Army No</nobr></th>
                                            <th nowrap="nowrap"><nobr>DOP</nobr></th>
                                            <th nowrap="nowrap"><nobr>DOR</nobr></th>
                                            <th nowrap="nowrap"><nobr>Value</nobr></th>
											</tr>
                                           </thead>
														<tbody>
                                                        <?php $i = 1; 
														$totvalue = 0;?>
                                                        <?php foreach ($Vehicleitems as $exp) { ?>																
                                                            <tr>
                                                                <td><?php echo $i; ?></td>
																<td><nobr><?php echo $exp['assetunit']; ?></nobr></td>
																<td><nobr><?php echo $exp['mainCategory']; ?></nobr></td>
                                                                <td><nobr><?php echo $exp['identificationno']; ?></nobr></td>
                                                                <td><nobr><?php echo $exp['itemCategory']; ?></nobr></td>
                                                                <td><nobr><?php echo $exp['itemDescription']; ?></nobr></td>
																<td><nobr><?php echo $exp['make']; ?></nobr></td>
                                                                <td><nobr><?php echo $exp['fuel']; ?></nobr></td>
                                                                <td><nobr><?php echo $exp['catalogueno']; ?></nobr></td>
                                                                <td><nobr><?php echo $exp['engineno']; ?></nobr></td>
                                                                <td><nobr><?php echo $exp['chessisno']; ?></nobr></td>
																<td><nobr><?php echo $exp['brandName']; ?></nobr></td>
																<td><nobr><?php echo $exp['modelName']; ?></nobr></td>
                                                                <td><nobr><?php echo $exp['armyno']; ?></nobr></td>
                                                                <td><nobr><?php echo $exp['purchasedDate']; ?></nobr></td>
                                                                <td><nobr><?php echo $exp['receivedDate']; ?></nobr></td>
                                                                <td  align="right"><nobr><?php echo number_format($exp['unitValue'], 2, '.', ','); ?></nobr></td>
                                                            </tr>
                                                            <?php $i++; 
															$totvalue = $totvalue + $exp['unitValue'];?>
                                                        <?php } ?> 
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
												  <td align="right"><?php echo number_format($totvalue, 2, '.', ','); ?></td>
												</tr>
											  </tfoot></table>
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
//include('sidebar.php');
                                                        include '../view/footer.php';
                                                        ?>
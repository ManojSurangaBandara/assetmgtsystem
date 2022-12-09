<?php include 'header1.php'; ?>
<script>
	$(document).ready(function() {
							$('#assetscenter').change(function(){getAsstUnit($(this).val(), "");
																$('#sidebar1').empty();});
							$('#assetunit').change(function(){
							showSidebar( 25 );});
							function showSidebar( id )
									{
										 $.ajax({
											  type: "GET",
											  url: "index.php",
											  data: "action=showSidebar&id=" + id + "&assetscenter=" + $('#assetscenter').val() + "&assetunit=" + $('#assetunit').val(),
											  success: function(result){
														 $('#sidebar1').empty();	
														 var item = $.parseJSON(result);
														 var options = '';
														 $.each(item, function(key,value) {
  $("#sidebar1").append('<li id="' + value.id + '"><a href="#">' + value.identificationno + '</a></li>');
});
													   }
										 });
									}
					function getAsstUnit(assetscenter, assetunit)
						{
								var querystring = {
										center: assetscenter,
										action: 'findAssetsUnitsByCenter_Ajax'
									}
							$.get('index.php', querystring, processResponse);
							function processResponse(result) {					
							var numbers = $.parseJSON(result);
							var option = '<option value=""></option>';
							for (var i=0;i<numbers.length;i++){
							   option += '<option value="'+ numbers[i] + '">' + numbers[i] + '</option>';
							}
							$('#assetunit').html(option);
							$('#assetunit option[value="' + assetunit + '"]').attr('selected', 'selected');
													} // end processData
                };
				$('#sidebar1').delegate('li', 'click', function() {
									   var id=$(this).attr('id');								   
									   $.ajax({
											  type: "GET",
											  url: "index.php",
											  data: "action=toBeApproveList_Ajax&id=" + id,
											  success: function(result){
														 var item = $.parseJSON(result);
														 $('#title span h2').text(item.identificationno);
														// $('#submit').prop('value', 'Update Land Details');
														// setMessage(4);
														 $('#message').html('<li class="blue"><span class="ico"></span><strong class="system_title">Press "Approve Details" Button </strong></li>');
														$("#id").val(item.id);
														$("#assetscenter").val(item.assetscenter);
														$("#assetunit").val(item.assetunit);														
														// getAsstUnit(item.assetscenter, item.assetunit);
														$("#province").val(item.province);
														$("#district").val(item.district);
														$("#dsDivision").val(item.dsDivision);
														$("#gsDivision").val(item.gsDivision);														
														$('#category').val(item.category);														
														$('#assetsno').val(item.assetsno);
														$('#classificationno').val(item.classificationno);
														$('#identificationno').val(item.identificationno);
														$('#register').val(item.register);
														$('#landname').val(item.landname);
														$('#natureOwnership').val(item.natureOwnership);
														$('#ownership').val(item.ownership);
														$('#planno').val(item.planno);
														$('#deedno').val(item.deedno);
														$('#deeddate').val(item.deeddate);
														$('#landNature').val(item.landNature);
														$('#areaMeasure').val(item.areaMeasure);
														$('#area').val(item.area);
														$('#acre').val(item.acre);
														$('#rood').val(item.rood);
														$('#parch').val(item.parch);
														$('#estimatedValue').val(item.estimatedValue);
														$('#acquisitiondate').val(item.acquisitiondate);
														$('#remarks').val(item.remarks);												
														}
													   
										 });
									});
					function clearInput() {
														$('#title span h2').text("Select Land For Modification");
														$("#id").val("");
														//$("#assetscenter").val("");
														//$("#assetunit").val("");														
														$("#province").val("");
														$("#district").val("");
														$("#dsDivision").val("");
														$("#gsDivision").val("");														
														$('#category').val("");														
														$('#assetsno').val("");
														$('#classificationno').val("");
														$('#identificationno').val("");
														$('#register').val("");
														$('#landname').val("");
														$('#natureOwnership').val("");
														$('#ownership').val("");
														$('#planno').val("");
														$('#deedno').val("");
														$('#deeddate').val("");
														$('#landNature').val("");
														$('#areaMeasure').val("");
														$('#area').val("");
														$('#acre').val("");
														$('#rood').val("");
														$('#parch').val("");
														$('#estimatedValue').val("");
														$('#acquisitiondate').val("");
														$('#remarks').val("");		
								}								
								$("#submit").click(function (e) {
					               var querystring = {	
										id: $('#id').val(),										
										action: 'SelectModificationSave_ajax'
									}    
		$.get('index.php', querystring, processResponse);
							function processResponse(result) {						
							showSidebar( 25 );
													} // end processData	
			   e.preventDefault();
			   clearInput();
            }            
        );
									//alert();
		//showSidebar1( 2 );
}); // end ready
 </script>
<div id="page">
    <div class="inner">
        <div class="section">
            <div class="title_wrapper" id="title">
                <span><h2>Select Land For Modification</h2></span>
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
                                        <input type="hidden" name="action" value="Select_Items_For_Modifications" />
										<input type="hidden" name="id" id="id" value="" />
                                        <label  class="label"><?php echo $tList[0][$lang]?></label>
                                                            <div><select name="assetscenter" id="assetscenter">
                                                                <option value=""></option>
                                                                <?php foreach ($assetsCenters as $center) { ?>
                                                                    <option value="<?php echo $center->getName(); ?>" <?php if ($assetscenter == $center->getName()) echo "selected = 'selected'"; ?>>
                                                                        <?php echo $center->getName(); ?>
                                                                    </option>
                                                                <?php } ?>
                                                            </select></div>
                                                    <label  class="label"><?php echo $tList[1][$lang]?></label>                                                        
                                                            <div id="Unitdiv">
                                                                <select name="assetunit" id="assetunit">
                                                                    <option value=""></option>
                                                                    <?php foreach ($assetunits as $unit) { ?>
                                                                        <option value="<?php echo $unit->getName(); ?>" <?php if ($assetunit == $unit->getName()) echo "selected = 'selected'"; ?>>
                                                                            <?php echo $unit->getName(); ?>
                                                                        </option>
                                                                    <?php } ?>
                                                                </select>

                                                            <?php echo $fields->getField('assetunit')->getHTML(); ?><br /></td>
                                                        </div>                                                                                                          
									<?php 
									if ($displaytype == 1) {?>
									<div id="accordion">
									<h3>First Panel</h3>
									<div id="tabs-1"> 
									<?php } else if ($displaytype == 2) {?>
									<div id="tabs">
									<ul>
										<li><a href="#tabs-1">First Tab</a></li>
										<li><a href="#tabs-2">Second Tab</a></li>
										<li><a href="#tabs-3">Third Tab</a></li>
									</ul>
									<div id="tabs-1">
									<?php } ?>
									<label class="label"><?php echo $tList[2][$lang]?></label>
                                                            <div><input type="text" class="text" name="province"  id="province" value="<?php echo $province; ?>" style="width:200px; background-color:white; color: black" disabled/></div> 
                                                        <label class="label"><?php echo $tList[3][$lang]?></label>
                                                            <div><input type="text" class="text" name="district"  id="district" value="<?php echo $district; ?>" style="width:200px; background-color:white; color: black" disabled/></div> 
                                                        <label class="label"><?php echo $tList[4][$lang]?></label>
                                                        <div><input type="text" class="text" name="dsDivision"  id="dsDivision" value="<?php echo $dsDivision; ?>" style="width:200px; background-color:white; color: black" disabled/></div> 
                                                        <label class="label"><?php echo $tList[5][$lang]?></label>
                                                            <div><input type="text" class="text" name="gsDivision"  id="gsDivision" value="<?php echo $gsDivision; ?>" style="width:200px; background-color:white; color: black" disabled/></div> 
                                                        <label class="label"><?php echo $tList[6][$lang]?></label>
                                                            <div><input type="text" class="text" name="category"  id="category" value="<?php echo $category; ?>" style="width:300px; background-color:white; color: black" disabled/></div> 
                                                        <label class="label"><?php echo $tList[7][$lang]?></label>
                                                            <div><input type="text" class="text" name="assetsno"  id="assetsno" value="<?php echo $assetsno; ?>" style="width:50px; background-color:white; color: black" disabled/> 
                                                            <input type="text" class="text" name="classificationno"  id="classificationno" value="<?php echo $classificationno; ?>" style="width:100px; background-color:white; color: black" disabled/></div> 
									 <?php if ($displaytype == 1) {?>
										</div>
									<h3>Second Panel</h3>
											<div id="tabs-2">
										<?php } else if ($displaytype == 2) {?>
										</div>
									 <div id="tabs-2">
									 <?php } ?>         
													   <label class="label"><?php echo $tList[8][$lang]?></label>
                                                            <div><input type="text" class="text" name="natureOwnership"  id="natureOwnership" value="<?php echo $natureOwnership; ?>" style="width:200px; background-color:white; color: black" disabled/></div> 
                                                       <label class="label"><?php echo $tList[9][$lang]?></label>
                                                            <div><input type="text" class="text" name="ownership"  id="ownership" value="<?php echo $ownership; ?>" style="width:200px; background-color:white; color: black" disabled/></div> 
                                                        <label class="label"><?php echo $tList[22][$lang]?></label>                                                        
                                                            <div><input type="text" class="text" name="identificationno"  id="identificationno" value="<?php echo $identificationno; ?>" style="width:300px; background-color:white; color: black" disabled/></div> 
														<label class="label"><?php echo $tList[10][$lang]?></label>                                                    
                                                        <div><input type="text" class="text" name="register"  id="register" value="<?php echo $register; ?>" style="width:200px; background-color:white; color: black" disabled/></div> 
                                                    <label class="label"><?php echo $tList[11][$lang]?></label>
                                                            <div><input type="text" class="text" name="landname"  id="landname" value="<?php echo $landname; ?>" style="width:200px; background-color:white; color: black" disabled/></div> 
                                                        <label class="label"><?php echo $tList[12][$lang]?></label>
                                                        <div><input type="text" class="text" name="planno"  id="planno" value="<?php echo $planno; ?>" style="width:200px; background-color:white; color: black" disabled/></div> 
                                                        <label class="label"><?php echo $tList[13][$lang]?></label>
                                                        <div><input type="text" class="text" name="deedno"  id="deedno" value="<?php echo $deedno; ?>" style="width:200px; background-color:white; color: black" disabled/></div> 
                                                        <label class="label"><?php echo $tList[14][$lang]?></label>
                                                        <div><input type="text" class="text" name="deeddate"  id="deeddate" value="<?php echo $deeddate; ?>" style="width:200px; background-color:white; color: black" disabled/></div> 
                                         
									 <?php if ($displaytype == 1) {?>									
											</div>
									<h3>Third Panel</h3>
									<div id="tabs-3">
									<?php } else if ($displaytype == 2) {?>
											</div>
									 <div id="tabs-3">
									 <?php } ?>        
														<label class="label"><?php echo $tList[15][$lang]?></label>                                                        
                                                           <div><input type="text" class="text" name="landNature"  id="landNature" value="<?php echo $landNature; ?>" style="width:200px; background-color:white; color: black" disabled/></div> 
                                                        <label class="label"><?php echo $tList[16][$lang]?></label>                                                        
                                                            <div><input type="text" class="text" name="areaMeasure"  id="areaMeasure" value="<?php echo $areaMeasure; ?>" style="width:200px; background-color:white; color: black" disabled/></div> 
                                                        <label class="label"><?php echo $tList[17][$lang]?></label>                                                        
                                                            <div><input type="text" class="text" name="acre"  id="acre" value="<?php echo $acre; ?>" style="width:40px; background-color:white; color: black" disabled/>
                                                            <?php echo $fields->getField('acre')->getHTML(); ?>
                                                            <input type="text" class="text" name="rood"  id="rood" value="<?php echo $rood; ?>" style="width:40px; background-color:white; color: black" disabled/> 
                                                            <?php echo $fields->getField('rood')->getHTML(); ?>
                                                            <input type="text" class="text" name="parch"  id="parch" value="<?php echo $parch; ?>" style="width:40px; background-color:white; color: black" disabled/>
                                                            <?php echo $fields->getField('parch')->getHTML(); ?>                                                             
                                                            <input type="text" class="text" name="area" id="area" value="<?php echo $area; ?>" style="width:40px; background-color:white; color: black" disabled/> 
                                                            <?php echo $fields->getField('area')->getHTML(); ?> </div>
                                                        <label class="label"><?php echo $tList[18][$lang]?></label>
                                                        <div><input type="text" class="text" name="estimatedValue"  id="estimatedValue" value="<?php echo $estimatedValue; ?>" style="width:200px; background-color:white; color: black" disabled/></div> 
                                                        <label class="label"><?php echo $tList[20][$lang]?></label>
                                                    <div><input type="text" class="text" name="acquisitiondate"  id="acquisitiondate" value="<?php echo $acquisitiondate; ?>" style="width:200px; background-color:white; color: black" disabled/></div> 
                                                    <label class="label"><?php echo $tList[21][$lang]?></label>
                                                       <div><input type="text" class="text" name="remarks"  id="remarks" value="<?php echo $remarks; ?>" style="width:200px; background-color:white; color: black" disabled/></div>
														<?php if ($displaytype == 1) {?>
														</div>
														</div>
														<?php } else if ($displaytype == 2) {?>
														</div>	
														</div>
														<?php }?>
														
														
														 
														<div>															
													<input type="submit" name="submit" id="submit" value="Select for Modification">
												</div> 
									</form>
                                    <ul class="system_messages">
                                        <?php
                                        switch ($error) {
                                            case '0':
                                                ?>
                                                <li class="blue"><span class="ico"></span><strong class="system_title">Click "Select for Modification" Button</strong></li>
                                                <?php
                                                break;
                                            case '1':
                                                ?>
                                                <li class="green"><span class="ico"></span><strong class="system_title">Data Successfully Saved.</strong></li>
                                                <?php
                                                break;
                                            case '2':
                                                ?>
                                                <li class="red"><span class="ico"></span><strong class="system_title">Data Error. Please Check Data !</strong></li>
                                                <?php
                                                break;
                                            case '3':
                                                ?>
                                                <li class="yellow"><span class="ico"></span><strong class="system_title">Deed Details Already Entered !</strong></li>
                                                <?php
                                                break;
                                            case '5':
                                                ?>
                                                <li class="red"><span class="ico"></span><strong class="system_title">Error when Database Writing !</strong></li>
                                                <?php
                                                break;
                                            case '6':
                                                ?>
                                                <li class="green"><span class="ico"></span><strong class="system_title">Data Deleted</strong></li>
                                        <?php } ?>
                                    </ul>
                                    <div id="Itmdiv">
                                        <div class="table_wrapper">
                                            <div class="table_wrapper_inner">
                                              
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

    </div>
</div>
<?php
include('sidebar.php');
include '../view/footer.php';
?>











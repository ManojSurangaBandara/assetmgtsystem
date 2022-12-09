<?php
include '../view/header1.php';
?>
<div id="sec_menu">
    <?php include("sub_menu.tpl"); ?>
</div>
<div id="page">
    <div class="inner">
        <div class="section">
            <div class="title_wrapper">
                <h2><?php echo $title ?></h2>
                <span class="title_wrapper_left"></span>
                <span class="title_wrapper_right"></span>
            </div>
            <div class="section_content">
                <div class="sct">
                    <div class="sct_left">
                        <div class="sct_right">
                            <div class="sct_left">
                                <div class="sct_right">
                                    <ul class="system_messages">
                                        <?php
                                        switch ($error) {
                                            case '0':
                                                ?>
                                                <li class="blue"><span class="ico"></span><strong class="system_title">Enter Data and  press "Add Vehicle Details" Button</strong></li>
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
                                                <li class="yellow"><span class="ico"></span><strong class="system_title">Lot Number Already Entered !</strong></li>
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
                                    <form name="frm_land_add" method="post" id="frm_land_add" action="index.php" class="search_form general_form"> 
                                        <input type="hidden" name="action" value="<?php echo $returnaction; ?>" />
                                        <table width="100%" border="0">
											<td colspan="3">
                                                <table width="100%" border="0" class="listing form">
                                                    <tr>
                                                        <td width="30%"><label>Year : </label></td>
														<td width="70%"><input type="text" class="text" name="year"  id="year" value="<?php echo $Tender['year']; ?>" style="width:30px" readonly/>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label>Place : </label></td>
                                                            <td width="70%"><input type="text" class="text" name="place"  id="place" value="<?php echo $Tender['place']; ?>" style="width:200px" readonly/>
															</td>
                                                    </tr>
													<tr>
                                                        <td width="30%"><label>Type : </label></td>
                                                            <td width="70%"><input type="text" class="text" name="type"  id="type" value="<?php echo $type; ?>" style="width:200px" readonly/>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label>Tender Number : </label></td>
                                                        <td width="70%"><input type="text" class="text" name="tenderno"  id="tenderno" value="<?php echo $Tender['tenderno']; ?>" style="width:200px" readonly/>
														   </td>
                                                    </tr>
													<tr>
                                                        <td width="30%"><label>Lot Number : </label></td>
                                                        <td width="70%"><input type="number" class="text" name="lotno"  id="lotno" value="<?php echo $lotno; ?>" style="width:40px"/>
														   <?php echo $fields->getField('lotno')->getHTML(); ?>
														   </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label>Vehicle Number : </label></td>
                                                        <td width="70%">
                                                            <select name="armyno" onChange="getDistrictByProvince('index.php?action=findVehicleDetailsByid&id=' + this.value)">
                                                                <option value=""></option>
                                                                <?php foreach ($vehicles as $vehicle) { ?>
                                                                    <option value="<?php echo $vehicle['armyno']; ?>">
                                                                        <?php echo $vehicle['armyno']; ?>
                                                                    </option>
                                                                <?php } ?>
                                                            </select>
															<?php echo $fields->getField('armyno')->getHTML(); ?>
														</td>
                                                    </tr>
													<tr>
													<td width="30%"><label>Vehicle Details : </label></td>
													<td>
													<div id="Disdiv">
													</div>
													</td>
                                                    </tr>
													<tr>
                                                        <td width="30%"><label>Buyer NIC Number : </label></td>
                                                        <td width="70%">
                                                            <select name="buyernicno" onChange="getGeneratedCodeList('index.php?action=findBuyerDetailsByid&nicno=' + this.value)">
                                                                <option value=""></option>
                                                                <?php foreach ($Buyers as $Buyer) { ?>
                                                                    <option value="<?php echo $Buyer['nicno']; ?>">
                                                                        <?php echo $Buyer['nicno']; ?>
                                                                    </option>
                                                                <?php } ?>
                                                            </select>
															<?php echo $fields->getField('buyernicno')->getHTML(); ?>
														</td>
                                                    </tr>
													<tr>
													<td width="30%"><label>Buyers Details : </label></td>
													<td>
													<div id="Genediv">
													</div>
													</td>
                                                    </tr>
													<tr>
                                                        <td width="30%"><label>Estimate Value : </label></td>
                                                        <td width="70%"><input type="number" step="any" class="text" name="estimatevalue"  id="estimatevalue" required="required" style="width:100px"/></td>
                                                    </tr>
													<tr>
                                                        <td width="30%"><label>Tender Value : </label></td>
                                                        <td width="70%"><input type="number" step="any" class="text" name="tendervalue"  id="tendervalue" style="width:100px"/></td>
                                                    </tr>
													<tr>
                                                        <td width="30%"><label>Remarks : </label></td>
                                                        <td width="70%"><input type="text" class="text" name="remarks"  id="remarks" style="width:400px"/></td>
                                                    </tr>
													<tr>
                                                        <td><label> </label></td>
                                                        <td>
                                                            <div class="buttons">
                                                                <ul>
                                                                    <li><span class="button send_form_btn"><span><span>Save Vehicle Details</span></span><input name="" type="submit"/></span> </li>
                                                                </ul>       
                                                            </div>

                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                            
                                        </table>
                                    </form>
									<div class="table_wrapper">
													<div class="table_wrapper_inner">
														<table cellpadding="0" cellspacing="0" width="100%" >
														<tbody><tr>
															<th>&nbsp;</th>
															<th>Lot No.</th>
															<th>Vehicle No.</th>
															<th>Vehicle Description</th>
															<th>Estimate Amount</th>
															<th>Tender Amount</th>
															<th>Buyer Name</th>
															<th>&nbsp;</th>
														</tr>
														<?php $i = 1; ?>
														<?php foreach($exps as $exp) { ?>																
														<tr class=<?php if ($i % 2) {
																		echo "first";
																		} else {
																		echo "second";
																		}?>>
															<td><?php echo $i; ?></td>
															<td><?php echo $exp['lotno']; ?></td>
															<td><?php echo $exp['armyno']; ?></td>
															<td><?php echo $exp['itemDescription'];?></td>
															<td><?php echo $exp['estimatevalue']; ?></td>
															<td><?php echo $exp['tendervalue']; ?></td>
															<td><?php echo $exp['buyername']; ?></td>
															<td><form action="." method="post">
															<input type="hidden" name="action" value="delete_VehicleDetail" />
															<input type="hidden" name="id" value="<?php echo $exp['id']; ?>" />
															<input type="hidden" name="tenderno" value="<?php echo $exp['tenderno']; ?>" />
															<input name="submit" type="submit" value="Delete" onClick = "javascript: return confirm('Are you SURE you wish to Delete Item?');"/>
															</form></td> 
														</tr>
														<?php $i++; ?>
														<?php }  ?>
													  </tbody>
													  </table>
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











<?php include 'header1.php';?>
<div id="page">
    <div class="inner">
        <div class="section">
            <div class="title_wrapper">
                <h2>
                    ADD - Units
                </h2>
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
                                                <li class="blue"><span class="ico"></span><strong class="system_title">Enter Data and  press "Add Units" Button</strong></li>
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
                                                <li class="yellow"><span class="ico"></span><strong class="system_title">Assets Units/ ID Already Entered !</strong></li>
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
                                    <form name="frm_add" method="post" id="frm_add" action="index.php" class="search_form general_form"> 
                                        <input type="hidden" name="action" value="Add_Unit" />
                                        
                                        <table width="100%" border="0">
                                            <tr>
                                                        <td width="30%"><label>Assets Center :</label></td>

                                                        <td width="70%">
                                                            <select name="assetscenter" onChange="getrequestitem('index.php?action=findAssetsUnitsByCenter&center=' + this.value)">
                                                                <option value=""></option>
                                                                <?php foreach ($assetsCenters as $center) { ?>
                                                                    <option value="<?php echo $center->getName(); ?>" <?php if ($assetscenter == $center->getName()) echo "selected = 'selected'"; ?>>
                                                                        <?php echo $center->getName(); ?>
                                                                    </option>
                                                                <?php } ?>
                                                            </select>
                                                            <?php echo $fields->getField('assetscenter')->getHTML(); ?><br /></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label>Assets Unit :</label></td>

                                                        <td width="70%">
                                                            <input type="text" class="text" name="unitName"  id="unitName" value="<?php echo $unitName; ?>" style="width:200px"/>

                                                            <?php echo $fields->getField('unitName')->getHTML(); ?><br /></td>
                                                    </tr>
													 <tr>
                                                        <td width="30%"><label>Unit ID :</label></td>

                                                        <td width="70%">
                                                            <input type="text" class="text" name="centreID"  id="centreID" value="<?php echo $centreID; ?>" style="width:200px"/>

                                                            <?php echo $fields->getField('centreID')->getHTML(); ?><br /></td>
                                                    </tr>
 													 <tr>
                                                        <td width="30%"><label>Unit Type :</label></td>

                                                        <td width="70%">
                                                            <input type="number" class="text" name="unit_type"  id="unit_type" value="<?php if ($_SESSION['SESS_LEVEL'] == 12) { echo "1"; } else { echo $unit_type;} ?>" style="width:40px" min="0" max="1" <?php if ($_SESSION['SESS_LEVEL'] == 12) { echo "readonly"; } ?>/>
															වාසම සඳහා පමණක් ඇති ඒකක සඳහා 1 ඇතුල් කරන්න.
															<?php echo $fields->getField('unit_type')->getHTML(); ?><br /></td>
                                                    </tr>                                                   
                                                    <tr>
                                                        <td><label> </label></td>
                                                        <td>
                                                            <div class="buttons">
                                                                <ul>
                                                                    <li><span class="button send_form_btn"><span><span><?php echo "Add Unit";?></span></span><input name="" type="submit"/></span> </li>
                                                                </ul>       
                                                            </div>

                                                        </td>
                                                    </tr>
                                            
                                            </td>
                                            </tr>
                                        </table>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
			<div id="Itmdiv">
												<div class="table_wrapper">
													<div class="table_wrapper_inner">
														<table cellpadding="0" cellspacing="0" width="100%" >
														<tbody><tr>
															
															<th>S No.</th>
															<th>Unit Type</th>
															<th>Unit Name</th>
															<th>Unit ID</th>
															<th>S Order</th>
															<th>Active</th>
														</tr>
														<?php $i = 1; ?>
														<?php foreach($exps as $exp) { ?>																
														<tr class=<?php if ($i % 2) {
																		echo "first";
																		} else {
																		echo "second";
																		}?>>
															<td><?php echo $i; ?></td>
															<td><?php echo $exp['unit_type']; ?></td>
															<td><?php echo $exp['unitName']; ?></td>
															<td><?php echo $exp['centreID']; ?></td>
															<td>
																<form name="add_form" id="add_form" class="add_form" action="." method="post">
																	<input type="hidden" name="action" id="action" value="Add_Units" />									
																	<input type="hidden" name="id" id="id" value="<?php echo $exp['SN']; ?>"/>
																	<input type="hidden" name="center" id="center" value="<?php echo $exp['centreName']; ?>"/>
																	<input type="number" name="sorder" id="sorder" style="text-align:right;" value="<?php echo $exp['sorder']; ?>">
																	<input name="submit" type="submit" value="Save"/>
																</form>
																</td>
															<td><?php echo $exp['Active']; ?></td>
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

<?php
include('sidebar.php');
include '../view/footer.php';
?>











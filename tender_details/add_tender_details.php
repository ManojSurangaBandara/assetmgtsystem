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
                                                <li class="blue"><span class="ico"></span><strong class="system_title">Enter Data and  press "Add Tender Details" Button</strong></li>
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
                                                <li class="yellow"><span class="ico"></span><strong class="system_title">Details Already Entered !</strong></li>
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
														<td width="70%"><input type="text" class="text" name="year"  id="year" value="<?php echo $currentYear; ?>" style="width:30px"/>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label>Place : </label></td>

                                                        <td width="70%">
                                                            <select name="place">
																<option value="1SLAOC" <?php if ($tplace == '1SLAOC') echo "selected = 'selected'"; ?>>1SLAOC</option>
																<option value="2SLAOC" <?php if ($tplace == '2SLAOC') echo "selected = 'selected'"; ?>>2SLAOC</option>
																<option value="3SLAOC" <?php if ($tplace == '3SLAOC') echo "selected = 'selected'"; ?>>3SLAOC</option>
																<option value="5SLAOC" <?php if ($tplace == '5SLAOC') echo "selected = 'selected'"; ?>>5SLAOC</option>
																<option value="6SLAOC" <?php if ($tplace == '6SLAOC') echo "selected = 'selected'"; ?>>6SLAOC</option>
																<option value="7SLAOC" <?php if ($tplace == '7SLAOC') echo "selected = 'selected'"; ?>>7SLAOC</option>
																<option value="4SLE" <?php if ($tplace == '4SLE') echo "selected = 'selected'"; ?>>4SLE</option>
																<option value="SLEME" <?php if ($tplace == 'SLEME') echo "selected = 'selected'"; ?>>SLEME</option>
                                                            </select>
															</td>
                                                    </tr>
													<tr>
                                                        <td width="30%"><label>Type : </label></td>

                                                        <td width="70%">
                                                            <select name="type">
                                                                <option value="V" <?php if ($type == "V") echo "selected = 'selected'"; ?>>Vehicle</option>
																<option value="G" <?php if ($type == "G") echo "selected = 'selected'"; ?> >General Goods</option>
                                                            </select>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label>Tender Number : </label></td>
                                                        <td width="70%"><input type="text" class="text" name="tenderno"  id="tenderno" value="<?php echo $tenderno; ?>" style="width:200px"/>
                                                           (T/Year/Place/Type/Sno)
														   </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label>Chairman - Officer No. & Name : </label></td>
                                                        <td width="70%"><input type="text" class="text" name="chairmanno"  id="chairmanno" value="<?php echo $chairmanno; ?>" style="width:100px"/>
														<input type="text" class="text" name="chairmanname"  id="chairmanname" value="<?php echo $chairmanname; ?>" style="width:300px"/></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label>Member 1 - Officer No. & Name : </label></td>
                                                        <td width="70%"><input type="text" class="text" name="member1no"  id="member1no" value="<?php echo $member1no; ?>" style="width:100px"/>
														<input type="text" class="text" name="member1name"  id="member1name" value="<?php echo $member1name; ?>" style="width:300px"/></td>
                                                    </tr>
													<tr>
                                                        <td width="30%"><label>Member 2 - Officer No. & Name : </label></td>
                                                        <td width="70%"><input type="text" class="text" name="member2no"  id="member2no" value="<?php echo $member2no; ?>" style="width:100px"/>
														<input type="text" class="text" name="member2name"  id="member2name" value="<?php echo $member2name; ?>" style="width:300px"/></td>
                                                    </tr>
													<tr>
                                                        <td width="30%"><label>Member 3 - Officer No. & Name : </label></td>
                                                        <td width="70%"><input type="text" class="text" name="member3no"  id="member3no" value="<?php echo $member3no; ?>" style="width:100px"/>
														<input type="text" class="text" name="member3name"  id="member3name" value="<?php echo $member3name; ?>" style="width:300px"/></td>
                                                    </tr>
													<tr>
                                                        <td width="30%"><label>Member 4 - Officer No. & Name : </label></td>
                                                        <td width="70%"><input type="text" class="text" name="member4no"  id="member4no" value="<?php echo $member4no; ?>" style="width:100px"/>
														<input type="text" class="text" name="member4name"  id="member4name" value="<?php echo $member4name; ?>" style="width:300px"/></td>
                                                    </tr>
													<tr>
                                                        <td width="30%"><label>Remarks : </label></td>
                                                        <td width="70%"><input type="text" class="text" name="remarks"  id="remarks" value="<?php echo $remarks; ?>" style="width:410px"/>
														</td>
                                                    </tr>
                                                    <tr>
                                                        <td><label> </label></td>
                                                        <td>
                                                            <div class="buttons">
                                                                <ul>
                                                                    <li><span class="button send_form_btn"><span><span>Add Tender Details</span></span><input name="" type="submit"/></span> </li>
                                                                </ul>       
                                                            </div>

                                                        </td>
                                                    </tr>
                                                </table>
												</td>
                                        </table>
                                    </form>
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











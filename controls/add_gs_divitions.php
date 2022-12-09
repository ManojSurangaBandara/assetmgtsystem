<?php include 'header1.php';?>
<div id="page">
    <div class="inner">
        <div class="section">
            <div class="title_wrapper">
                <h2>
                    ADD - GS Divisions
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
                                        <input type="hidden" name="action" value="Add_GS_Divition" />
                                        
                                        <table width="100%" border="0">
                                           
<tr>
                                                        <td width="30%"><label>Province :</label></td>

                                                        <td width="70%">
                                                            <select name="province" onChange="getDistrictByProvince('index.php?action=findDistrictByProvinceGS&province=' + this.value)">
                                                                <option value=""></option>
                                                                <?php foreach ($provinces as $prov) { ?>
                                                                    <option value="<?php echo $prov->getName(); ?>" <?php if ($province == $prov->getName()) echo "selected = 'selected'"; ?>>
                                                                        <?php echo $prov->getName(); ?>
                                                                    </option>
                                                                <?php } ?>
                                                            </select>
                                                    </tr>
													
                                                    <tr>
                                                        <td width="30%"><label>District :</label></td>
                                                        <td width="70%">
                                                            <div id="Disdiv">
                                                                <select name="district" onChange="getDSByDistrict('index.php?action=findDSByDistrict&district=' + this.value)">
                                                                    <option value=""></option>
                                                                    <?php foreach ($districts as $dist) { ?>
                                                                        <option value="<?php echo $dist->getName(); ?>" <?php if ($district == $dist->getName()) echo "selected = 'selected'"; ?>>
                                                                            <?php echo $dist->getName(); ?>
                                                                        </option>
                                                                    <?php } ?>
                                                                </select>
                                                            <?php echo $fields->getField('district')->getHTML(); ?><br /></td>
                                                        </div>
                                                    </tr>
													
													<tr>
                                                        <td width="30%"><label>DS Division :</label></td>
                                                        <td  width="70%">
                                                            <div id="DSdiv">
                                                                <select name="dsDivision" onChange="getGSByDS('index.php?action=findGSByDS&dsDivision=' + this.value)">
                                                                    <option value=""></option>
                                                                    <?php foreach ($dsdivisions as $dsdi) { ?>
                                                                        <option value="<?php echo $dsdi->getName(); ?>" <?php if ($dsDivision == $dsdi->getName()) echo "selected = 'selected'"; ?>>
                                                                            <?php echo $dsdi->getName(); ?>
                                                                        </option>
                                                                    <?php } ?>
                                                                </select>

                                                            <?php echo $fields->getField('dsDivision')->getHTML(); ?><br /></td>
                                                        </div>
                                                        </td> 
                                                    </tr>	
													<tr>
                                                        <td width="30%"><label>GS Division :</label></td>
                                                        <td  width="70%">
                                                            
                                                                <input type="text" class="text" name="gsDivision"  id="gsDivision" value="<?php echo $gsDivision; ?>" style="width:200px;"/>

                                                            <?php echo $fields->getField('gsDivision')->getHTML(); ?><br /></td>
                                                        
                                                        </td> 
                                                    </tr>	
													
													<tr>
                                                        <td width="30%"><label>GS Division Code :</label></td>
                                                        <td  width="70%">
                                                            
                                                                <input type="text" class="text" name="GN_Code"  id="GN_Code" value="<?php echo $GN_Code; ?>" style="width:200px;"/>
                                                        
                                                        </td> 
                                                    </tr>
													
                                                   
													
                                                    
                                                    <tr>
                                                        <td><label> </label></td>
                                                        <td>
                                                            <div class="buttons">
                                                                <ul>
                                                                    <li><span class="button send_form_btn"><span><span><?php echo "Add GS Division";?></span></span><input name="" type="submit"/></span> </li>
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
			<div id="GSdiv">
												<div class="table_wrapper">
													<div class="table_wrapper_inner">
														<table cellpadding="0" cellspacing="0" width="100%" >
														<tbody><tr>
															
															<th>S No.</th>
															<th>DS Division</th>
															<th>GS Division</th>
															<th>GN Code</th>
															<th>Active</th>
														</tr>
														<?php $i = 1; ?>
														<?php foreach($gsdivisions as $exp) { ?>																
														<tr class=<?php if ($i % 2) {
																		echo "first";
																		} else {
																		echo "second";
																		}?>>
															<td><?php echo $i; ?></td>
															<td><?php echo $exp['DSDivision']; ?></td>
															<td><?php echo $exp['str_GS_Division']; ?></td>
															<td><?php echo $exp['GN_Code']; ?></td>
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











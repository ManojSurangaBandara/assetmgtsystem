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
                <h2>
                    ADD - Buyer Details
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
                                                <li class="blue"><span class="ico"></span><strong class="system_title">Enter Data and  press "Add Details" Button</strong></li>
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
                                                <li class="yellow"><span class="ico"></span><strong class="system_title">NIC Number Already Entered !</strong></li>
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
                                        <input type="hidden" name="action" value="Add_BuyerDetail" />
                                        <input type="hidden" name="id" value="<?php echo $id; ?>" />
                                        <table width="100%" border="0">
                                            <td colspan="3">
                                                <table width="100%" border="0" class="listing form">
                                                    <tr>
                                                        <td width="30%"><label>NIC Number :</label></td>

                                                        <td width="70%">
                                                            <input type="text" class="text" name="nicno"  id="nicno" value="<?php echo $nicno; ?>" style="width:300px"/>

                                                            <?php echo $fields->getField('nicno')->getHTML(); ?><br /></td>
                                                    </tr>
													<tr>
                                                        <td width="30%"><label>Name :</label></td>

                                                        <td width="70%">
                                                            <input type="text" class="text" name="name"  id="name" value="<?php echo $name; ?>" style="width:300px"/>

                                                            <?php echo $fields->getField('name')->getHTML(); ?><br /></td>
                                                    </tr>
													                                                    <tr>
                                                        <td width="30%"><label>Address :</label></td>

                                                        <td width="70%">
                                                            <input type="text" class="text" name="address"  id="address" value="<?php echo $address; ?>" style="width:400px"/>      
                                                    </tr>
													 <tr>
                                                        <td width="30%"><label>Telephone :</label></td>

                                                        <td width="70%">
                                                            <input type="text" class="text" name="telephone"  id="telephone" value="<?php echo $telephone; ?>" style="width:300px"/>
         
                                                    </tr>
													
													<tr>
                                                        <td width="30%"><label>E-Mail Address :</label></td>

                                                        <td width="70%">
                                                            <input type="text" class="text" name="email"  id="email" value="<?php echo $email; ?>" style="width:300px"/>

                                                            
                                                    </tr>
                                                    
                                                    <tr>
                                                        <td><label> </label></td>
                                                        <td>
                                                            <div class="buttons">
                                                                <ul>
                                                                    <li><span class="button send_form_btn"><span><span>
																	<?php if ( $id >0) {
																	echo "Edit Buyer Details";
																	} else {
																	echo "Add Buyer Details";
																	}?>
																	</span></span><input name="" type="submit"/></span> </li>
                                                                </ul>       
                                                            </div>

                                                        </td>
                                                    </tr>
                                                </table>
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
															<th>&nbsp;</th>
															<th>NIC No.</th>
															<th>Name</th>
															<th>Address</th>
															<th>Telephone</th>
															<th>E-Mail</th>
														</tr>
														<?php $i = 1; ?>
														<?php foreach($exps as $exp) { ?>																
														<tr class=<?php if ($i % 2) {
																		echo "first";
																		} else {
																		echo "second";
																		}?>>
															<td><?php echo $i; ?></td>
															<td><?php echo $exp['nicno']; ?></td>
															<td><?php echo $exp['name']; ?></td>
															<td><?php echo $exp['address']; ?></td>
															<td><?php echo $exp['telephone']; ?></td>
															<td><?php echo $exp['email']; ?></td>
															<td><form action="." method="post">
															<input type="hidden" name="action" value="delete_BuyerDetail" />									
															<input type="hidden" name="id" value="<?php echo $exp['id']; ?>"/>
															<input name="submit" type="submit" value="Delete" onClick = "javascript: return confirm('Are you SURE you wish to Delete this Buyer?');"/>
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

<?php
include('sidebar.php');
include '../view/footer.php';
?>











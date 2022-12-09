<?php include 'header1.php';?>
<div id="page">
    <div class="inner">
        <div class="section">
            <div class="title_wrapper">
                <h2>
                    ADD - Building Categories
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
                                                <li class="yellow"><span class="ico"></span><strong class="system_title">Assets Building Category Already Entered !</strong></li>
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
                                        <input type="hidden" name="action" value="Add_Building_Category" />
                                        
                                        <table width="100%" border="0">
                                            <td colspan="3">
                                                <table width="100%" border="0" class="listing form">
                                                    <tr>
                                                        <td width="30%"><label>Building Category :</label></td>

                                                        <td width="70%">
                                                            <input type="text" class="text" name="categoryName"  id="categoryName" value="<?php echo $categoryName; ?>" style="width:300px"/>

                                                            <?php echo $fields->getField('categoryName')->getHTML(); ?><br /></td>
                                                    </tr>
													                                                    <tr>
                                                        <td width="30%"><label>Description :</label></td>

                                                        <td width="70%">
                                                            <input type="text" class="text" name="description"  id="description" value="<?php echo $description; ?>" style="width:400px"/>  
                                                    </tr>
													 <tr>
                                                        <td width="30%"><label>Vote Head :</label></td>

                                                        <td width="70%">
                                                            <input type="text" class="text" name="vote"  id="vote" value="<?php echo $vote; ?>" style="width:300px"/>  
                                                    </tr>
													<tr>
                                                        <td width="30%"><label>Classification of Asset :</label></td>

                                                        <td width="70%">
                                                            <input type="text" class="text" name="classification"  id="classification" value="<?php echo $classification; ?>" style="width:300px"/>         
                                                    </tr>
                                                    													<tr>
                                                        <td width="30%"><label>Asset No :</label></td>

                                                        <td width="70%">
                                                            <input type="text" class="text" name="assetno"  id="assetno" value="<?php echo $assetno; ?>" style="width:300px"/>         
                                                    </tr>
																										<tr>
                                                        <td width="30%"><label>Catalogue No :</label></td>

                                                        <td width="70%">
                                                            <input type="text" class="text" name="catalogueno"  id="catalogueno" value="<?php echo $catalogueno; ?>" style="width:300px"/>         
                                                    </tr>
													
													
                                                    <tr>
                                                        <td><label> </label></td>
                                                        <td>
                                                            <div class="buttons">
                                                                <ul>
                                                                    <li><span class="button send_form_btn"><span><span><?php echo "Add Building Category Details";?></span></span><input name="" type="submit"/></span> </li>
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
															<th>SN</th>
															<th>Category</th>
															<th>Description</th>
															<th>Vote Head</th>
															<th>Classification</th>
															<th>Asset No</th>
															<th>Catalogue No</th>
														</tr>
														<?php $i = 1; ?>
														<?php foreach($exps as $exp) { ?>																
														<tr class=<?php if ($i % 2) {
																		echo "first";
																		} else {
																		echo "second";
																		}?>>
															<td><?php echo $i; ?></td>
															<td><?php echo $exp['categoryName']; ?></td>
															<td><?php echo $exp['description']; ?></td>
															<td><?php echo $exp['vote']; ?></td>
															<td><?php echo $exp['classification']; ?></td>
															<td><?php echo $exp['assetno']; ?></td>
															<td><?php echo $exp['catalogueno']; ?></td>
															<td><form action="." method="post">
															<input type="hidden" name="action" value="Delete_Building_Category" />
															<input type="hidden" name="id" value="<?php echo $exp['id']; ?>"/>
															<input type="hidden" name="categoryName" value="<?php echo $exp['categoryName']; ?>"/>
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

<?php
include('sidebar.php');
include '../view/footer.php';
?>











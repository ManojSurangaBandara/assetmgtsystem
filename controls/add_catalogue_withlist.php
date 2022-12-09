<?php include 'header1.php';?>
<div id="page">

            <div class="title_wrapper">
                <h2>
                    ADD - Catalogue Numbers
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
								<script>	
								$(document).ready(function () {
								$('#list tr').dblclick(function(){
									$("html, body").animate({ scrollTop: 0 }, "slow");
									var id = $(this).attr('id');
									var querystring = {
													id: id,
													action: 'get_catlogDetail_Ajax'
												}
												$.get('index.php', querystring, processResponse);
												function processResponse(result) {
												var obj1 = $.parseJSON(result);
												$('#description').val(obj1.itemDescription);
												$('#make').val(obj1.make);
												$('#modle').val(obj1.modle);
												$('#voteHead').val(obj1.voteHead);
												$('#newAssestno').val(obj1.newAssestno);
												$('#assetsno').val(obj1.assetsno);
												$('#catalogueno').val(obj1.catalogueno);
												$("#add").val(obj1.id);
												$("#submit").prop('value', 'Update Catalogue Details');		
												$('#message').html('<li class="blue"><span class="ico"></span><strong class="system_title">Enter Data and  press "Update Catalogue Details" Button</strong></li>');
												}
									});
								});
								</script>
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
                                                <li class="yellow"><span class="ico"></span><strong class="system_title">Assets Catalogue Number Already Entered !</strong></li>
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
                                        <input type="hidden" name="action" value="Add_Detail" />
                                        <input type="hidden" name="add" id="add" value="0" />
                                        <table width="100%" border="0">
                                            <td colspan="3">
                                                <table width="100%" border="0" class="listing form">
                                                    <tr>
                                                        <td width="30%"><label>Classification :</label></td>

                                                        <td width="70%">
                                                            <select name="classification" id="classification" onChange="getAssetsUnitByCenter('index.php?action=findMianCategory&classification=' + this.value)">
                                                                <option value=""></option>
                                                                <option value="1" <?php if ($classification == 1) echo "selected = 'selected'"; ?>>OFFICE EQUIPMENTS</option>
                                                                <option value="2" <?php if ($classification == 2) echo "selected = 'selected'"; ?>>PLANT & MACHINERY</option>
                                                                <option value="3" <?php if ($classification == 3) echo "selected = 'selected'"; ?>>VEHICLES</option>
                                                            </select>

                                                            <?php echo $fields->getField('classification')->getHTML(); ?><br /></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label>Main Category :</label></td>
                                                        <td width="70%">
                                                            <div id="Unitdiv">
                                                                <select name="mainCategory" id="mainCategory" onChange="getDistrictByProvince('index.php?action=findItemCategory&mainCategory=' + this.value)">
                                                                    <option value=""></option>
                                                                    <?php foreach ($maincategorys as $maincate) { ?>
                                                                        <option value="<?php echo $maincate['mainCategory']; ?>" <?php if ($mainCategory == $maincate['mainCategory']) echo "selected = 'selected'"; ?>>
                                                                            <?php echo $maincate['mainCategory']; ?>
                                                                        </option>
                                                                    <?php } ?>
                                                                </select>

                                                            <?php echo $fields->getField('mainCategory')->getHTML(); ?><br /></td>
                                                        </div>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label>Item Category :</label></td>
                                                        <td width="70%">
                                                            <div id="Disdiv">
                                                            <select name="itemCategory" id="itemCategory">
                                                                <option value=""></option>
                                                                <?php foreach ($itemCategorys as $itemCate) { ?>
                                                                    <option value="<?php echo $itemCate['itemCategory']; ?>" <?php if ($itemCategory == $itemCate['itemCategory']) echo "selected = 'selected'"; ?>>
                                                                        <?php echo $itemCate['itemCategory']; ?>
                                                                    </option>
                                                                <?php } ?>
                                                            </select>
                                                            <?php echo $fields->getField('itemCategory')->getHTML(); ?><br /></td>
                                                    </div>
                                                         </tr>
														 <tr>
                                                        <td><label> </label></td>
                                                        <td>
                                                            <div class="buttons">
                                                                <ul>
                                                                    <li><span class="button send_form_btn"><span><span><?php echo "Search Details";?></span></span><input name="search" type="submit"/></span> </li>
                                                                </ul>       
                                                            </div>

                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label>Description :</label></td>
                                                        <td width="70%"><input type="text" class="text" name="description"  id="description" value="<?php echo $description; ?>" style="width:400px"/>
                                                            <?php echo $fields->getField('description')->getHTML(); ?><br /></td>
                                                    </tr>

                                                    <tr>
                                                        <td width="30%"><label>Make :</label></td>
                                                        <td width="70%"><input type="text" class="text" name="make"  id="make" value="<?php echo $make; ?>" style="width:200px"/>
                                                            <?php echo $fields->getField('make')->getHTML(); ?><br /></td>
                                                    </tr>


                                                    <tr>
                                                        <td width="30%"><label>Model :</label></td>
                                                        <td width="70%"><input type="text" class="text" name="modle"  id="modle" value="<?php echo $modle; ?>" style="width:200px"/>
                                                            <?php echo $fields->getField('modle')->getHTML(); ?><br /></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label>Vote Head :</label></td>
                                                        <td width="70%"><input type="text" class="text" name="voteHead"  id="voteHead" value="222" style="width:200px"/>
                                                            <?php echo $fields->getField('voteHead')->getHTML(); ?><br /></td>
                                                    </tr>


                                                    <tr>
                                                        <td width="30%"><label>New Classification of Asset :</label></td>
                                                        <td width="70%"><input type="text" class="text" name="newAssestno"  id="newAssestno" value="<?php echo $newAssestno; ?>" style="width:200px"/>
                                                            <?php echo $fields->getField('newAssestno')->getHTML(); ?><br /></td>
                                                    </tr>

                                                    <tr>
                                                        <td width="30%"><label>Present Asset No :</label></td>
                                                        <td width="70%"><input type="text" class="text" name="assetsno"  id="assetsno" value="<?php echo $assetsno; ?>" style="width:200px;"/>
                                                            <?php echo $fields->getField('assetsno')->getHTML(); ?><br /></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label>Catalogue Number :</label></td>
                                                        <td width="70%"><input type="text" class="text" name="catalogueno"  id="catalogueno" value="<?php echo $catalogueno; ?>" style="width:200px;"/>
                                                            <?php echo $fields->getField('catalogueno')->getHTML(); ?><br /></td>
                                                    </tr>
                                                    <tr>
                                                        <td><label> </label></td>
                                                        <td>
                                                            <div class="buttons">
                                                                <ul>
                                                                    <li><span class="button send_form_btn"><span><span><?php echo "Add Catalogue Details";?></span></span><input name="submit" id="submit" type="submit"/></span> </li>
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
        </div>
        <div class="section_content">
            <div class="sct">
                <div class="sct_left">
                    <div class="sct_right">
                        <div class="sct_left">
                            <div class="sct_right">
                                <fieldset>
                                    <div class="table_wrapper_inner">
                                        <table id="list" cellpadding="1" cellspacing="0" width="100%" border="1" BORDERCOLOR=skyblue style="font-size:11px;">

                                            <tbody>
                                            <col width="10">
                                            <col width="185">
                                            <th>S/N</th>
                                            <th><a>Main Category</a></th>
                                            <th><a>Item Category</a></th>
                                            <th><a>Description</a></th>
                                            <th><a>Make</a></th>
                                            <th><a>Model</a></th>
                                            <th><a>Vote Head</a></th>
                                            <th><a>New Asset No</a></th>
                                            <th><a>Assets No</a></th>
                                            <th><a>Catalogue No<a></th>
                                                        <?php $i = 1; ?>
                                                        <?php foreach ($items as $exp) { ?>																
                                                            <tr id="<?php echo $exp['id']; ?>">
                                                                <td><?php echo $i; ?></td>
                                                                <td><?php echo $exp['mainCategory']; ?></td>
                                                                <td><?php echo $exp['itemCategory']; ?></td>
                                                                <td><?php echo $exp['itemDescription']; ?></td>
                                                                <td><?php echo $exp['make']; ?></td>
                                                                <td><?php echo $exp['modle']; ?></td>
                                                                <td><?php echo $exp['voteHead']; ?></td>
                                                                <td><?php echo $exp['newAssestno']; ?></td>
                                                                <td><?php echo $exp['assetsno']; ?></td>
                                                                <td><?php echo $exp['catalogueno']; ?></td>
																<td><form action="." method="post">
															<input type="hidden" name="action" value="delete_catelog_Item" />
															<input type="hidden" name="id" value="<?php echo $exp['id']; ?>"/>
															<input type="hidden" name="mainCategory" value="<?php echo $exp['mainCategory']; ?>"/>
															<input type="hidden" name="itemCategory" value="<?php echo $exp['itemCategory']; ?>"/>
															<input type="hidden" name="classification" value="<?php echo $exp['type']; ?>"/>
															<input name="submit" type="submit" value="Delete" onClick = "javascript: return confirm('Are you SURE you wish to Delete Item?');"/>
															</form></td>
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


<?php

include '../view/footer.php';
?>











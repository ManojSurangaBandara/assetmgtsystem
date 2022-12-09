<?php include 'header1.php';?>
<div id="page">
    <div class="inner">
        <div class="section">
            <div class="title_wrapper">
                <h2>
                    ADD - Board Members
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
                                                <li class="blue"><span class="ico"></span><strong class="system_title">Enter Data and  press "Add Member Details" Button</strong></li>
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
                                        <input type="hidden" name="action" value="Add_BoardMember" />
                                        
                                        <table width="100%" border="0">
                                            <td colspan="3">
                                                <table width="100%" border="0" class="listing form">
                                                    <tr>
                                                        <td width="30%"><label>Assets Center :	</label></td>

                                                        <td width="70%">
                                                            <?php echo $assetscenter; ?>
															</td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label>Assets Unit :</label></td>
                                                        <td width="70%">
                                                            <?php echo $assetunit; ?>
															</td>
                                                    </tr>
													<tr>
													<td>
													</td>
													</tr>
                                                    <tr>
                                                        <td width="30%"><label>Board President </label></td>
                                                        <td width="70%">
                                                            </td>
                                                         </tr>
                                                    <tr>
                                                        <td width="30%"><label>Name :</label></td>
                                                        <td width="70%"><input type="text" class="text" name="boardMemberName1"  id="boardMemberName1" value="<?php echo $boardMemberName1; ?>" style="width:300px"/>
                                                    </tr>

                                                    <tr>
                                                        <td width="30%"><label>Rank :</label></td>
                                  <td width="70%"><input type="text" class="text" name="boardMemberRank1"  id="boardMemberRank1" value="<?php echo $boardMemberRank1; ?>" style="width:200px"/>
                                                    </tr>


                                                    <tr>
                                                        <td width="30%"><label>Number :</label></td>
                                                        <td width="70%"><input type="text" class="text" name="boardMemberNumber1"  id="boardMemberNumber1" value="<?php echo $boardMemberNumber1; ?>" style="width:200px"/>
                                                            <?php echo $fields->getField('modle')->getHTML(); ?><br /></td>
                                                    </tr>
													<tr>
                                                        <td width="30%"><label>E-Mail Address :</label></td>
                                                        <td width="70%"><input type="text" class="text" name="email1"  id="email1" value="<?php echo $email1; ?>" style="width:200px"/>
                                                    </tr>
													<tr>
													<td>
													</td>
													</tr>
                                                    <tr>
                                                        <td width="30%"><label>Board Member - 1 </label></td>
                                                        <td width="70%">
                                                            </td>
                                                         </tr>
                                                    <tr>
                                                        <td width="30%"><label>Name :</label></td>
                                                        <td width="70%"><input type="text" class="text" name="boardMemberName2"  id="boardMemberName2" value="<?php echo $boardMemberName2; ?>" style="width:300px"/>
                                                    </tr>

                                                    <tr>
                                                        <td width="30%"><label>Rank :</label></td>
                                  <td width="70%"><input type="text" class="text" name="boardMemberRank2"  id="boardMemberRank2" value="<?php echo $boardMemberRank2; ?>" style="width:200px"/>
                                                    </tr>


                                                    <tr>
                                                        <td width="30%"><label>Number :</label></td>
                                                        <td width="70%"><input type="text" class="text" name="boardMemberNumber2"  id="boardMemberNumber2" value="<?php echo $boardMemberNumber2; ?>" style="width:200px"/>
                                                    </tr>
													<tr>
                                                        <td width="30%"><label>E-Mail Address :</label></td>
                                                        <td width="70%"><input type="text" class="text" name="email2"  id="email2" value="<?php echo $email2; ?>" style="width:200px"/>
                                                    </tr>
													<tr>
													<td>
													</td>
													</tr>
                                                    <tr>
                                                        <td width="30%"><label>Board Member - 2 </label></td>
                                                        <td width="70%">
                                                            </td>
                                                         </tr>
                                                    <tr>
                                                        <td width="30%"><label>Name :</label></td>
                                                        <td width="70%"><input type="text" class="text" name="boardMemberName3"  id="boardMemberName3" value="<?php echo $boardMemberName3; ?>" style="width:300px"/>
                                                    </tr>

                                                    <tr>
                                                        <td width="30%"><label>Rank :</label></td>
                                  <td width="70%"><input type="text" class="text" name="boardMemberRank3"  id="boardMemberRank3" value="<?php echo $boardMemberRank3; ?>" style="width:200px"/>
                                                    </tr>


                                                    <tr>
                                                        <td width="30%"><label>Number :</label></td>
                                                        <td width="70%"><input type="text" class="text" name="boardMemberNumber3"  id="boardMemberNumber3" value="<?php echo $boardMemberNumber3; ?>" style="width:200px"/>
                                       
                                                    </tr>
													<tr>
                                                        <td width="30%"><label>E-Mail Address :</label></td>
                                                        <td width="70%"><input type="text" class="text" name="email3"  id="email3" value="<?php echo $email3; ?>" style="width:200px"/>
                                                    </tr>
													<tr>
                                                        <td><label> </label></td>
                                                        <td>
                                                            <div class="buttons">
                                                                <ul>
                                                                    <li><span class="button send_form_btn"><span><span><?php echo "Add Member Details";?></span></span><input name="" type="submit"/></span> </li>
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

    </div>
</div>

<?php
include('sidebar.php');
include '../view/footer.php';
?>











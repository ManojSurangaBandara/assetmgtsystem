<?php include 'header1.php'; ?>
<div id="page">
    <div class="inner">
        <div class="section">
            <div class="title_wrapper">
                <h2>
                    Change Password
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
                                                <li class="red"><span class="ico"></span><strong class="system_title" style="font-size:20px";>ඔබ විසින් ලබාදුන් නව මුරපදය පෙර භාවිතා කර ඇත. වෙනත් මුර පදයක් ඇතුලත් කර උත්සහ කරන්න.</strong></li>
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
                                    <form name="frm_add" method="post" id="frm_add" action="index.php" class="search_form general_form" onSubmit="return validatePassword()"> 
                                        <input type="hidden" name="action" value="Change_Password" />

                                        <table width="100%" border="0">
                                            <td colspan="3">
                                                <table width="100%" border="0" class="listing form">
                                                    <tr>
                                                        <td width="30%"><label>Assets Center :</label></td>

                                                        <td width="70%">
                                                            <?php echo $assetscenter; ?>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label>Assets Unit :</label></td>
                                                        <td width="70%">
														<?php echo $assetunit; ?>
                                                    </tr>
													<tr>
                                                        <td width="30%"><label>Login Account :</label></td>
                                                        <td width="70%">
														<?php echo $_SESSION['SESS_LOGIN']; ?>
                                                    </tr>
													
													<tr>
                                                        <td width="30%"><label>Current Password :	</label></td>
                                                        <td width="70%"><input type="password" name="currentPassword" class="txtField"/><span id="currentPassword"  class="required"></span>
                                                         <?php echo $fields->getField('currentPassword')->getHTML(); ?><br />
														 </td>
                                                    </tr>
													<tr>
														<td><label>New Password</label></td>
														<td><input type="password" name="newPassword" class="txtField"/><span id="newPassword" class="required"></span>
														<?php echo $fields->getField('newPassword')->getHTML(); ?><br /></td>
														</tr>
														<td><label>Confirm Password</label></td>
														<td><input type="password" name="confirmPassword" class="txtField"/><span id="confirmPassword" class="required"></span>
														<?php echo $fields->getField('confirmPassword')->getHTML(); ?><br /></td>
														</tr>
                                                    <tr>
                                                        <td><label> </label></td>
                                                        <td>
                                                            <div class="buttons">
                                                                <ul>
                                                                    <li><span class="button send_form_btn"><span><span><?php echo "Change Password"; ?></span></span><input name="" type="submit"/></span> </li>
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











<?php
include '../view/header1.php';
?>
<div id="sec_menu">
    <?php include("sub_menu.tpl"); ?>
</div>
<div id="page">
			<p>&nbsp;</p>
				<div class="inner">
					<div class="section">
						<div class="title_wrapper">
							<h2>Add Login User</h2>
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
                                                <li class="blue"><span class="ico"></span><strong class="system_title">Enter Data and  press "Add Login User" Button</strong></li>
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
                                        <input type="hidden" name="action" value="register-exec" />
                                        
                                        <table width="100%" border="0">
                                            <td colspan="3">
                                                <table width="100%" border="0" class="listing form">
                                                    <tr>
                                                        <td width="30%"><label>Assets Center :</label></td>

                                                        <td width="70%">
                                                            <select name="assetscenter" onChange="getAssetsUnitByCenter('index.php?action=findAssetsUnitsByCenter&center=' + this.value)">
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
                                                            <div id="Unitdiv">
                                                                <select name="assetunit" onChange="getPresentUnitByUnit('index.php?action=findPresentUnitByUnit&unit=' + this.value)">
                                                                    <option value=""></option>
                                                                    <?php foreach ($assetunits as $unit) { ?>
                                                                        <option value="<?php echo $unit->getName(); ?>" <?php if ($assetunit == $unit->getName()) echo "selected = 'selected'"; ?>>
                                                                            <?php echo $unit->getName(); ?>
                                                                        </option>
                                                                    <?php } ?>
                                                                </select>

                                                            <?php echo $fields->getField('assetunit')->getHTML(); ?><br /></td>
                                                        </div>
                                                    </tr>
														<tr>
                                                        <td><label> </label></td>
                                                        <td>
                                                            <div class="buttons">
                                                                <ul>
                                                                    <li><span class="button send_form_btn"><span><span><?php echo "Search Users";?></span></span><input name="search" type="submit"/></span> </li>
                                                                </ul>       
                                                            </div>

                                                        </td>
                                                    </tr>
													<tr>
                                                        <td width="30%"><label>Full Name :</label></td>
                                                        <td width="70%"><input type="text" class="text" name="firstname"  id="firstname" value="<?php echo $firstname; ?>" style="width:200px;"/>
                                                            <?php echo $fields->getField('firstname')->getHTML(); ?><br /></td>
                                                    </tr>

                                                    <tr>
                                                        <td width="30%"><label>Section :</label></td>
                                                        <td width="70%"><input type="text" class="text" name="lastname"  id="lastname" value="<?php echo $lastname; ?>" style="width:200px;"/>
                                                            <?php echo $fields->getField('lastname')->getHTML(); ?><br /></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label>Login Name :</label></td>
                                                        <td width="70%"><input type="text" class="text" name="login"  id="login" value="<?php echo $login; ?>" style="width:200px;"/>
                                                            <?php echo $fields->getField('login')->getHTML(); ?><br /></td>
                                                    </tr>
													
													<tr>
                                                        <td width="30%"><label>Password :</label></td>
                                                        <td width="70%"><input type="password" class="text" name="passwd"  id="passwd" value="<?php echo $passwd; ?>" style="width:100px;"/>
                                                            <?php echo $fields->getField('passwd')->getHTML(); ?><br /></td>
                                                    </tr>
													<tr>
                                                        <td width="30%"><label>Confirm Password :</label></td>
                                                        <td width="70%"><input type="password" class="text" name="cpassword"  id="cpassword" value="<?php echo $cpassword; ?>" style="width:100px;"/>
                                                            <?php echo $fields->getField('cpassword')->getHTML(); ?><br /></td>
                                                    </tr>
													<tr>
                                                        <td width="30%"><label>User Level :</label></td>
                                                        <td width="70%"><input type="text" class="text" name="level"  id="level" value="<?php echo $level; ?>" style="width:30px; text-align: right;" onkeypress="return isNumberKey(event)"/>
                                                            <?php echo $fields->getField('level')->getHTML(); ?><br /></td>
                                                    </tr>
					
													
                                                    
                                                    <tr>
                                                        <td><label> </label></td>
                                                        <td>
                                                            <div class="buttons">
                                                                <ul>
                                                                    <li><span class="button send_form_btn"><span><span><?php echo "Add Login User";?></span></span><input name="" type="submit"/></span> </li>
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
            <div class="section table_section">
                <div class="title_wrapper">
                    <h2>Users List</h2>
                    <span class="title_wrapper_left"></span>
                    <span class="title_wrapper_right"></span>
                </div>
                <div class="section_content">
                    <div class="sct">
                        <div class="sct_left">
                            <div class="sct_right">
                                <div class="sct_left">
                                    <div class="sct_right">
                                        <form action="#">
                                            <fieldset>
                                                <div class="table_wrapper">
                                                    <div class="table_wrapper_inner">
                                                        <table cellpadding="0" cellspacing="0" width="100%">
                                                            <tbody><tr>
                                                                    <th>&nbsp;</th>                                                                    
                                                                    <th>Member Name</th>
                                                                    <th>Assets Center</th>
                                                                    <th>Assets Unit</th>
                                                                    <th>Login Name</th>
                                                                    <th>Level</th>
                                                                </tr>
                                                                <?php $i = 1; ?>
                                                                <?php foreach ($exps as $exp) { ?>																
                                                                    <tr class=<?php
                                                                    if ($i % 2) {
                                                                        echo "first";
                                                                    } else {
                                                                        echo "second";
                                                                    }
                                                                    ?>>
                                                                        <td><?php echo $i; ?></td>                                                                       
                                                                        <td><?php echo $exp['firstname']; ?></td>
                                                                        <td><?php echo $exp['centreName']; ?></td>
                                                                        <td ><?php echo $exp['place']; ?></td>
                                                                        <td ><?php echo $exp['login']; ?></td>
                                                                        <td ><?php echo $exp['level']; ?></td>
                                                                    </tr>
                                                                    <?php $i++; ?>
                                                                <?php } ?>
                                                            </tbody></table>
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </form>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <span class="scb"><span class="scb_left"></span><span class="scb_right"></span></span>						
                </div>
            </div>
					</div>
					
				</div>
			</div>

<?php
include('sidebar.php');
include '../view/footer.php';
?>











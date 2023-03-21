<?php
include '../view/header1.php';
?>
<div id="sec_menu">
    <?php include("sub_menu.tpl"); ?>
</div>
<script>	
$(document).ready(function () {
$("#decative").click(function(){
    var querystring = {
			action: 'decative_accunt'
		}
		$.get('index.php', querystring, processResponse);
	 function processResponse(result) {
		// alert(result);
		}
	return false
});
$("#pw_update").click(function(){
    var querystring = {
			action: 'pw_update'
		}
		$.get('index.php', querystring, processResponse);
	 function processResponse(result) {
		 alert(result);
		}
	return false
});
}); 
</script>
<div id="page">

            <p>&nbsp;</p>
			<form name="frm_land_add" method="post" id="frm_land_add" action="index.php" class="search_form general_form"> 
                                        <input type="hidden" name="action" value="Select_User_List" />
                                        <table width="100%" border="0">
                                            <td colspan="3">
                                                <table width="100%" border="0" class="listing form">
                                                    <tr>
                                                        <td width="30%"><label>Assets Centre : </label></td>

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
                                                        <td width="30%"><label>Assets Units</label></td>
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
                                                        <tr>
                                                        <td width="30%"><label></label></td>
                                                        <td width="70%"></td>
                                                    </tr>

                                                    <tr>
                                                        <td><label> </label></td>
                                                        <td>
                                                            <div class="buttons">
                                                                <ul>
                                                                    <li><span class="button send_form_btn"><span><span>Search</span></span><input name="" type="submit"/></span> </li>
                                                                </ul>       
                                                            </div>

                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                            </tr>
                                        </table>
                                    </form>
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
                                        <!-- <form action="#"> -->
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
																	<th>Expiry Date</th>
																	<th>Faliure Attepts</th>
																	<th>E-Mail Address</th>
																	<th>Active</th>
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
                                                                        <td ><?php if($exp['level'] == 15) {
																					echo $exp['place']."- 2";
																		} else if ($exp['level'] == 25) {
																					echo $exp['place']."- 2";
																		} else { echo $exp['level'];} ?></td>
																		<td><?php echo date('Y-m-d',strtotime('+30 days',strtotime($exp['pw_update']))) . PHP_EOL; ?></td>
                                                                        <td ><?php echo $exp['fail_attempts']; ?></td>
                                                                        <td ><?php echo $exp['user_email']; ?></td>
																		<td ><?php if($exp['deactive'] == 0) {
																					echo "Yes";
																		} else { echo "No";} ?></td>
                                                                    </tr>
                                                                    <?php $i++; ?>
                                                                <?php } ?>
                                                            </tbody></table>
                                                    </div>
                                                </div>
                                            </fieldset>
                                        <!-- </form> -->


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
							<input class = "savebttn" id = "decative" name="submit" type="submit" value="Deactivate Default Passward Accounts"/>
							<input class = "savebttn" id = "pw_update" name="submit" type="submit" value="Change Password Update Date"/>
                    <span class="scb"><span class="scb_left"></span><span class="scb_right"></span></span>						
                </div>
            </div>
            <div class="section table_section">
            </div>

    </div>
<?php
//include('sidebar.php');
include '../view/footer.php';
?>
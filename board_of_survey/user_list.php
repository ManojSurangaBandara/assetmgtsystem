<?php include 'header1.php';?> 
<div id="page">
            <div class="section table_section">
                <div class="title_wrapper">
                    <h2>Board of Survey - Users List</h2>
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
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
						<!--	<input class = "savebttn" id = "decative" name="submit" type="submit" value="Deactivate Default Passward Accounts"/>
							<input class = "savebttn" id = "pw_update" name="submit" type="submit" value="Change Password Update Date"/> -->
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
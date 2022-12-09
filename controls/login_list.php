<?php include 'header1.php'; ?>
<div id="page">

            <div class="section table_section">
			        <form action="." method="post" id="search_Expendable__form"  class="search_form general_form">
            <input type="hidden" name="action" value="logging_list"/>
            <table width="100%" border="0">
                <tr>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td>
                        <b>Logged Account:</b>
                    </td>

                    <td>
                        <div id="Itmdiv">
                            <input type="text" class="text" name="loginname"  id="loginname" value="<?php echo $loginname; ?>" style="width:200px;" readonly/>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td><b>Date :</b></td> <td> <b>From :</b>
                        <input type='text' class="text" name="inputField1" value="<?php echo $inputField1; ?>" id="inputField1" style="width:90px;"/>
                        <b>To :</b>
                        <input type='text' class="text" name="inputField2" value="<?php echo $inputField2; ?>" id="inputField2" style="width:90px;"/></td>
                </tr>
                <tr>
                <td> </td>
                <td> </td>
                <td>  
                    <input type="submit" value="Search" />
                </td>
                <td>
				<!-- <input type="checkbox" name="ExpToExcel" value="1" /> Export to Excel 
                    <input type="checkbox" name="ExpToPdf" value="1" />Export to PDF </td> -->
                </tr>
            </table>
        </form>
                <div class="title_wrapper">
                    <h2>Logging List</h2>
                    <span class="title_wrapper_left"></span>
                    <span class="title_wrapper_right"></span>
                </div>
                <div class="section_content">
                    <div class="sct">
                        <div class="sct_left">
                            <div class="sct_right">
                                <div class="sct_left">
                                    <div class="sct_right">

                                                    <div class="table_wrapper_inner">
                                                        <table cellpadding="1" cellspacing="0" width="100%" border="1" BORDERCOLOR=skyblue style="font-size:11px;">
                                                            <tbody><tr>
                                                                    <th>&nbsp;</th>
                                                                    <th>Assets Centre</th>
                                                                    <th>Assets Unit</th>
                                                                    <th>MAC Address</th>
                                                                    <th>Login Name</th>
                                                                    <th>Password</th>
																	<th>Logged Date/Time</th>
                                                                    <th>Status</th>
                                                                </tr>
                                                                <?php $i = 1; ?>
                                                                <?php foreach ($exps as $exp) { ?>																
                                                                    <tr bgcolor=<?php
                                                            switch ($exp['result']) {
                                                               // case '1':
                                                                //    echo "#00FF00";
                                                                //    break;
                                                                case '0':
                                                                    echo "#00BFFF";
                                                                    break;
                                                            }
																	?>>
                                                                        <td><?php echo $i; ?></td>
                                                                        <td><?php echo $exp['assetscenter']; ?></td>
                                                                        <td><?php echo $exp['assetunit']; ?></td>
                                                                        <td><?php echo $exp['macaddress']; ?></td>
                                                                        <td ><?php echo $exp['loginname']; ?></td>
                                                                        <td ><?php echo $exp['password']; ?></td>
																		<td ><?php echo $exp['sysDate']; ?></td>
                                                                        <td ><?php echo (1 == $exp['result']) ? 'Success' : 'Fail'; ?></td>
                                                                    </tr>
                                                                    <?php $i++; ?>
                                                                <?php } ?>
                                                            </tbody></table>
                                                    </div>

                                        


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
<?php
include 'header1.php';
?>
<div id="page">
    <div class="inner">
        <div class="section">
            <div class="title_wrapper">
                <h2><?php echo $title[$lang]." - ".$identificationno; ?></h2>
                <span class="title_wrapper_left"></span>
                <span class="title_wrapper_right"></span>
            </div>
            <div class="section_content">
                <div class="sct">
                    <div class="sct_left">
                        <div class="sct_right">
                            <div class="sct_left">
                                <div class="sct_right">
									 <?php if ($id > 0) { ?>
                                    <ul class="system_messages">
                                        <?php
                                        switch ($error) {
                                            case '0':
                                                ?>
                                                <li class="blue"><span class="ico"></span><strong class="system_title">Choose File and Click Upload Button</strong></li>
                                                <?php
                                                break;
                                            case '1':
                                                ?>
                                                <li class="green"><span class="ico"></span><strong class="system_title">File Successfully Uploaded.</strong></li>
                                                <?php
                                                break;
                                            case '2':
                                                ?>
                                                <li class="red"><span class="ico"></span><strong class="system_title">Error. Please Check File !</strong></li>
                                                <?php
                                                break;
                                            case '3':
                                                ?>
                                                <li class="red"><span class="ico"></span><strong class="system_title">Only pdf files are allowed. !</strong></li>
                                                <?php
                                                break;
                                            case '4':
                                                ?>
                                                <li class="red"><span class="ico"></span><strong class="system_title">Sorry, file already exists. !</strong></li>
                                                <?php
                                                break;
											 case '6':
                                                ?>
                                                <li class="red"><span class="ico"></span><strong class="system_title">Sorry, only pdf files are allowed. !</strong></li>
                                                <?php
                                                break;
                                            case '5':
                                                ?>
                                                <li class="red"><span class="ico"></span><strong class="system_title">Sorry, your file is too large.</strong></li>
                                        <?php } ?>
                                    </ul>
									<?php if ($vreport_path != ""){?>
									<object data="<?php echo $vreport_path; ?>" type="application/pdf" width="100%" height="1200"></object>
                                    <?php } else {?>
									<form name="frm_land_add" method="post" id="frm_land_add" action="index.php" class="search_form general_form" enctype="multipart/form-data"> 
                                        <input type="hidden" name="action" value="upload_vreport_save" />
                                        <input type="hidden" name="id" value="<?php echo $id; ?>" />
										<input type="hidden" name="identificationno" value="<?php echo $identificationno; ?>" />
                                        <table width="100%" border="0">
                                            <td colspan="3">
                                                <table width="100%" border="0" class="listing form">                                                    
													 <tr>
                                                        <td width="30%"><label>Valuation Report :</label></td>
                                                        <td width="70%"><input type="file" name="Filename"> 
                                                    </tr>                                                    
                                                    <tr>
                                                        <td><label> </label></td>
                                                        <td>
                                                            <div class="buttons">
                                                                <ul>
                                                                    <li><span class="button send_form_btn"><span><span><?php if($id==0){echo "Upload Valuation Report";} else {echo "Upload Valuation Report";} ?></span></span><input name="" type="submit"/></span> </li>
																</ul>       
															</div>

                                                        </td>
                                                    </tr> 
                                                </table>
                                            </td>
                                            </tr>
                                        </table>
                                    </form>
									</br>
									<?php } ?>
										  <?php if($vreport_path != "" && $_SESSION['SESS_LEVEL'] == 1) { ?>
										 <form name="frm_land_add1" method="post" id="frm_land_add1" action="index.php" class="search_form general_form" enctype="multipart/form-data"> 
                                        <input type="hidden" name="action" value="upload_vreport" />
										<input type="hidden" name="id" value="<?php echo $id; ?>" />
										<input type="hidden" name="identificationno" value="<?php echo $identificationno; ?>" />
                                       	<div class="buttons">       
											<span class="button red_btn"><span><span>Delete Valuation Report</span></span><input name="del" id="del" type="submit" onClick = "javascript: return confirm('Are you SURE you wish to Delete this Valuation Report?');"/></span> 
										</div>
 										<?php }?>
									</form>
									<?php } ?>
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











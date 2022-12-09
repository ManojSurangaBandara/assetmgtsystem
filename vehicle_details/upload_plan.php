<?php include 'header1.php'; ?>
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
                                                <li class="red"><span class="ico"></span><strong class="system_title">Only jpg files are allowed. !</strong></li>
                                                <?php
                                                break;
                                            case '4':
                                                ?>
                                                <li class="red"><span class="ico"></span><strong class="system_title">Sorry, file already exists. !</strong></li>
                                                <?php
                                                break;
											 case '6':
                                                ?>
                                                <li class="red"><span class="ico"></span><strong class="system_title">Sorry, only JPG, JPEG, PNG & GIF files are allowed. !</strong></li>
                                                <?php
                                                break;
                                            case '5':
                                                ?>
                                                <li class="red"><span class="ico"></span><strong class="system_title">Sorry, your file is too large.</strong></li>
                                        <?php } ?>
                                    </ul>
									<img src="<?php echo $picpath; ?>" width="100%" height="auto" />
                                    <form name="frm_land_add" method="post" id="frm_land_add" action="index.php" class="search_form general_form" enctype="multipart/form-data"> 
                                        <input type="hidden" name="action" value="upload" />
                                        <input type="hidden" name="id" value="<?php echo $id; ?>" />
										<input type="hidden" name="identificationno" value="<?php echo $identificationno; ?>" />
                                        <table width="100%" border="0">
                                            <td colspan="3">
                                                <table width="100%" border="0" class="listing form">                                                    
													 <tr>
                                                        <td width="30%"><label>Vehicle Picture :</label></td>
                                                        <td width="70%"><input type="file" name="Filename"> 
                                                    </tr>                                                    
                                                    <tr>
                                                        <td><label> </label></td>
                                                        <td>
                                                            <div class="buttons">
                                                                <ul>
                                                                    <li><span class="button send_form_btn"><span><span><?php if($id==0){echo "Upload Vehicle Photo";} else {echo "Upload Vehicle Photo";} ?></span></span><input name="" type="submit"/></span> </li>
                                                                </ul>       
                                                            </div>

                                                        </td>
                                                    </tr>                                                         
                                                </table>
                                            </td>
                                            </tr>
                                        </table>
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











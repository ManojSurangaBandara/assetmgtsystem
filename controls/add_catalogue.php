<?php include 'header1.php';?>
<div id="page">
    <div class="inner">
        <div class="section">
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
                                        
                                        <table width="100%" border="0">
                                            <td colspan="3">
                                                <table width="100%" border="0" class="listing form">
                                                    <tr>
                                                        <td width="30%"><label>Classification :</label></td>

                                                        <td width="70%">
                                                            <select name="classification" onChange="getAssetsUnitByCenter('index.php?action=findMianCategory&classification=' + this.value)">
                                                                <option value=""></option>
                                                                <option value="1">OFFICE EQUIPMENTS</option>
                                                                <option value="2">PLANT & MACHINERY</option>
                                                                <option value="3">VEHICLES</option>
                                                            </select>

                                                            <?php echo $fields->getField('classification')->getHTML(); ?><br /></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label>Main Category :</label></td>
                                                        <td width="70%">
                                                            <div id="Unitdiv">
                                                                <select name="mainCategory"  onChange="getDistrictByProvince('index.php?action=findItemCategory&mainCategory=' + this.value)">
                                                                    <option value=""></option>
                                                                    <?php foreach ($maincategorys as $maincate) { ?>
                                                                        <option value="<?php echo $maincate['mainCategory']; ?>">
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
                                                            <select name="itemCategory">
                                                                <option value=""></option>
                                                                <?php foreach ($itemCategorys as $itemCate) { ?>
                                                                    <option value="<?php echo $itemCate['itemCategory']; ?>">
                                                                        <?php echo $itemCate['itemCategory']; ?>
                                                                    </option>
                                                                <?php } ?>
                                                            </select>
                                                            <?php echo $fields->getField('itemCategory')->getHTML(); ?><br /></td>
                                                    </div>
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
                                                        <td width="30%"><label>Modle :</label></td>
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
                                                                    <li><span class="button send_form_btn"><span><span><?php echo "Add Catalogue Details";?></span></span><input name="" type="submit"/></span> </li>
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











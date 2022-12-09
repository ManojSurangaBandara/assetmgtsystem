<?php
include 'header1.php';
?>
<div id="page">
    <div class="inner">
        <div class="section">
            <div class="title_wrapper">
                <h2>Select Items For Transfer </h2>
                <span class="title_wrapper_left"></span>
                <span class="title_wrapper_right"></span>
            </div>
            <div class="section_content">
                <div class="sct">
                    <div class="sct_left">
                        <div class="sct_right">
                            <div class="sct_left">
                                <div class="sct_right">
                                    <form name="frm_land_add" method="post" id="frm_land_add" action="index.php" class="search_form general_form"> 
                                        <input type="hidden" name="action" value="Select_Items_For_Transfer" />
                                        
                                        <table width="100%" border="0">
                                            <td colspan="3">
                                                <table width="100%" border="0" class="listing form">
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[0][$lang]?></label></td>

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
                                                        <td width="30%"><label><?php echo $tList[1][$lang]?></label></td>
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
                                                        <td width="30%"><label><?php echo $tList[2][$lang]?></label></td>

                                                        <td width="70%">
                                                            <select name="mainCategory" onChange="getDistrictByProvince('index.php?action=findCategoryByMainCategory&mainCategory=' + this.value)">
                                                                <option value=""></option>
                                                                <?php foreach ($mainCategorys as $mainCate) { ?>
                                                                    <option value="<?php echo $mainCate->getName(); ?>" <?php if ($mainCategory == $mainCate->getName()) echo "selected = 'selected'"; ?>>
                                                                        <?php echo $mainCate->getName(); ?>
                                                                    </option>
                                                                <?php } ?>
                                                            </select>

                                                            <?php echo $fields->getField('mainCategory')->getHTML(); ?><br /></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[3][$lang]?></label></td>
                                                        <td width="70%">
                                                            <div id="Disdiv">
                                                                <select name="itemCategory" onChange="getDSByDistrict('index.php?action=findDescriptionByCategory&itemCategory=' + this.value)">
                                                                    <option value=""></option>
                                                                    <?php foreach ($itemCategorys as $itemCate) { ?>
                                                                        <option value="<?php echo $itemCate->getName(); ?>" <?php if ($itemCategory == $itemCate->getName()) echo "selected = 'selected'"; ?>>
                                                                            <?php echo $itemCate->getName(); ?>
                                                                        </option>
                                                                    <?php } ?>
                                                                </select>

                                                            <?php echo $fields->getField('itemCategory')->getHTML(); ?><br /></td>
                                                        </div>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[4][$lang]?></label></td>
                                                        <td  width="70%">
                                                            <div id="DSdiv">
                                                                <select name="itemDescription" onChange="getGSByDS('index.php?action=findCataloguenoByDescription&itemDescription=' + this.value)">
                                                                    <option value=""></option>
                                                                    <?php foreach ($itemDescriptions as $itemDesc) { ?>
                                                                        <option value="<?php echo $itemDesc->getName(); ?>" <?php if ($itemDescription == $itemDesc->getName()) echo "selected = 'selected'"; ?>>
                                                                            <?php echo $itemDesc->getName(); ?>
                                                                        </option>
                                                                    <?php } ?>
                                                                </select>

                                                            <?php echo $fields->getField('itemDescription')->getHTML(); ?><br /></td>
                                                        </div>
                                                        </td> 
                                                    </tr>														  
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[5][$lang]?></label></td>
                                                        <td width="70%">
                                                            <div id="GSdiv">
                                                                <select name="catalogueno" onChange="getrequestitem('index.php?action=findAssetsnoByCatalogueno&catalogueno=' + this.value)">
                                                                    <option value=""></option>
                                                                    <?php foreach ($cataloguenos as $cata) { ?>
                                                                        <option value="<?php echo $cata->getName(); ?>" <?php if ($catalogueno == $cata->getName()) echo "selected = 'selected'"; ?>>
                                                                            <?php echo $cata->getName(); ?>
                                                                        </option>
                                                                    <?php } ?>
                                                                </select>

                                                                <?php echo $fields->getField('catalogueno')->getHTML(); ?><br />
                                                        </td>

                                                        </div>
                                                    </tr>
                                                    
                                                    <tr>
                                                        
                                                            <td width="30%"><label><?php echo $tList[6][$lang]?></label></td>
                                                        <td width="70%">
                                                            <div id="Itmdiv">
                                                            <input type="text" class="text" name="assetsno" id="assetsno" value="<?php echo $assetsnos->getId(); ?>" style="width:50px"/>
                                                            <?php echo $fields->getField('assetsno')->getHTML(); ?>
                                                            <input type="text" class="text" name="newAssestno"  id="newAssestno" value="<?php echo $assetsnos->getName(); ?>" style="width:100px"/>
                                                            <?php echo $fields->getField('newAssestno')->getHTML(); ?><br />
                                                            </div>  
                                                            </td>
                                                          
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[30][$lang]?></label></td>
                                                        <td width="70%">
                                                                <select name="searchby">
                                                                    <option value="Serial Number"  <?php if ($searchby == "Serial Number") echo "selected = 'selected'"; ?>>Serial Number</option>
                                                                    <option value="Ledger Number" <?php if ($searchby == "Ledger Number") echo "selected = 'selected'"; ?>>Ledger Number</option>
                                                                    <option value="Identification Number" <?php if ($searchby == "Identification Number") echo "selected = 'selected'"; ?>>Identification Number</option>
                                                                    <option value="List All Items" <?php if ($searchby == "List All Items") echo "selected = 'selected'"; ?>>List All Items</option>
                                                                </select>

                                                                <?php echo $fields->getField('searchby')->getHTML(); ?>
                                                                <input type="text" class="text" name="search"  id="search" value="<?php echo $search; ?>" style="width:200px"/>
                                                            <?php echo $fields->getField('search')->getHTML(); ?><br />
                                                        </td>
                                                        <tr>
                                                        <td width="30%"><label></label></td>
                                                        <td width="70%"></td>
                                                    </tr>
                                                    <div id="PreLocdiv">
                                                        
                                                        </div>
                                                    <tr>
                                                        <td><label> </label></td>
                                                        <td>
                                                            <div class="buttons">
                                                                <ul>
                                                                    <li><span class="button send_form_btn"><span><span>Search Transfer Item Details</span></span><input name="" type="submit"/></span> </li>
                                                                </ul>       
                                                            </div>

                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                            </tr>
                                        </table>
                                    </form>
                                    <ul class="system_messages">
                                        <?php
                                        switch ($error) {
                                            case '0':
                                                ?>
                                                <li class="blue"><span class="ico"></span><strong class="system_title">Enter Details and  press "Search Transfer Item Details" Button</strong></li>
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
                                                <li class="yellow"><span class="ico"></span><strong class="system_title">Deed Details Already Entered !</strong></li>
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
                                    <div id="Itmdiv">
                                        <div class="table_wrapper">
                                            <div class="table_wrapper_inner">
                                              
                                            </div>
                                        </div>
                                    </div>
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











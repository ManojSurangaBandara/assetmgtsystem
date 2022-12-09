<div id="DSdiv">
    <?php if ($itemCategory == 'MEDICAL ITEMS') { ?>
	<datalist id="searchs" value="<?php echo $search; ?>">
                                <?php foreach ($itemDescriptions as $itemDesc) { ?>
            <option value="<?php echo $itemDesc->getName(); ?>">
                <?php echo $itemDesc->getName(); ?>
            </option>
        <?php } ?>
                         <!--       <?php foreach ($searchText as $itemCate) { ?>
                                    <option value="<?php echo $itemCate; ?>">
                                        <?php echo $itemCate; ?>
                                    </option>
                                <?php } ?>
								-->
                            </datalist>
                            <input type="text" class="text" name="itemDescription"  id="itemDescription" style="width:400px" list="searchs" value="<?php echo $itemDescription; ?>" onChange="getGSByDS('index.php?action=findCataloguenoByDescription&mainCategory=<?php echo $mainCategory;?>&itemCategory=<?php echo $itemCategory;?>&itemDescription=' + this.value)"/>
	
	<?php } else { ?>
	<select name="itemDescription" id="itemDescription" onChange="getGSByDS('index.php?action=findCataloguenoByDescription&mainCategory=<?php echo $mainCategory;?>&itemCategory=<?php echo $itemCategory;?>&itemDescription=' + this.value)">
        <option value=""></option>
        <?php foreach ($itemDescriptions as $itemDesc) { ?>
            <option value="<?php echo $itemDesc->getName(); ?>" <?php if ($itemDescription == $itemDesc->getName()) echo "selected = 'selected'"; ?>>
                <?php echo $itemDesc->getName(); ?>
            </option>
        <?php } ?>
    </select>
	<?php } ?>	
    <?php echo $fields->getField('itemDescription')->getHTML(); ?><br /></td>
</div>
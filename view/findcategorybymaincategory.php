<div id="Disdiv">
    <select name="itemCategory" id="itemCategory" onChange="getDSByDistrict('index.php?action=findDescriptionByCategory&mainCategory=<?php echo $mainCategory;?>&itemCategory=' + this.value)">
        <option value=""></option>
        <?php foreach ($itemCategorys as $itemCate) { ?>
            <option value="<?php echo $itemCate->getName(); ?>" <?php if ($itemCategory == $itemCate->getName()) echo "selected = 'selected'"; ?>>
                <?php echo $itemCate->getName(); ?>
            </option>
        <?php } ?>
    </select>

    <?php echo $fields->getField('itemCategory')->getHTML(); ?><br /></td>
</div>
<div id="Unitdiv">
    <select name="assetunit"  onChange="getPresentUnitByUnit('index.php?action=findPresentUnitByUnit&unit=' + this.value)">
        <option value=""></option>
        <?php foreach ($assetunits as $unit) { ?>
            <option value="<?php echo $unit->getName(); ?>" <?php if ($assetunit == $unit->getName()) echo "selected = 'selected'"; ?>>
                <?php echo $unit->getName(); ?>
            </option>
        <?php } ?>
    </select>

    <?php echo $fields->getField('assetunit')->getHTML(); ?><br /></td>
</div>
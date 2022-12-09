<div id="PreLocdiv">
    <select name="presentLocation" >
        <option value=""></option>
        <?php foreach ($assetunits as $unit) { ?>
            <option value="<?php echo $unit->getName(); ?>" <?php if ($assetsUnit == $unit->getName()) echo "selected = 'selected'"; ?>>
                <?php echo $unit->getName(); ?>
            </option>
        <?php } ?>
    </select>

    <?php echo $fields->getField('presentLocation')->getHTML(); ?><br /></td>
</div>
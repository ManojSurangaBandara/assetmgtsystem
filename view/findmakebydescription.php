<div id="Makediv">
    <select name="$make" onChange="getModelByMake('index.php?action=findModelByMake&make=' + this.value)">
        <option value=""></option>
        <?php foreach ($makes as $mak) { ?>
            <option value="<?php echo $mak->getName(); ?>" <?php if ($make == $mak->getName()) echo "selected = 'selected'"; ?>>
                <?php echo $mak->getName(); ?>
            </option>
        <?php } ?>
    </select>

    <?php echo $fields->getField('make')->getHTML(); ?><br /></td>
</div>
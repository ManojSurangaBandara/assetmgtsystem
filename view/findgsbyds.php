<div id="GSdiv">
    <select name="gsDivision">
        <option value=""></option>
        <?php foreach ($gsdivisions as $gsdi) { ?>
            <option value="<?php echo $gsdi->getName(); ?>">
                <?php echo $gsdi->getName(); ?>
            </option>
        <?php } ?>
    </select>

    <?php echo $fields->getField('gsDivision')->getHTML(); ?><br /></td>
</td>
</div>
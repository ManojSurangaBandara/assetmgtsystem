<div id="Disdiv">
    <select name="district" onChange="getDSByDistrict('index.php?action=findDSByDistrict&district=' + this.value)">
        <option value=""></option>
        <?php foreach ($districts as $dist) { ?>
            <option value="<?php echo $dist->getName(); ?>">
                <?php echo $dist->getName(); ?>
            </option>
        <?php } ?>
    </select>
    <?php echo $fields->getField('district')->getHTML(); ?><br /></td>
</div>
<div id="DSdiv">
    <select name="dsDivision" onChange="getGSByDS('index.php?action=findGSByDS&dsDivision=' + this.value)">
        <option value=""></option>
        <?php foreach ($dsdivisions as $dsdi) { ?>
            <option value="<?php echo $dsdi->getName(); ?>">
                <?php echo $dsdi->getName(); ?>
            </option>
        <?php } ?>
    </select>

    <?php echo $fields->getField('dsDivision')->getHTML(); ?><br /></td>
</div>
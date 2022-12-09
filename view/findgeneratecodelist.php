<div id="Genediv">
    <select name="identificationno" size=<?php echo ($qty > 10 ? 10 : $qty); ?> multiple>
        <?php 
        $identificationnos = implode(";", $idList);
        for ($x=0; $x<$qty; $x++) {?>
            <option value="<?php echo $idList[$x]; ?>"><?php echo $idList[$x]; ?>
        <?php } ?>
    </select>
    <input type="hidden" name="identificationnos" id="identificationnos" value="<?php echo $identificationnos; ?>"/>
    <?php echo $fields->getField('identificationnos')->getHTML(); ?><br />
</div>
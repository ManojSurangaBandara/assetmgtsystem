<div id="Areadiv">
    <?php if ($areaMeasure == 'IMPERIAL UNITS') { ?> 
        <input type="number" class="text" name="acre"  id="acre" min="0" value="<?php echo $acre; ?>" style="width:60px; text-align: right;" onkeypress="return isNumberKey(event)"/>
        <?php echo $fields->getField('acre')->getHTML(); ?>
        <input type="number" class="text" name="rood" id="rood" min="0" max="3" value="<?php echo $rood; ?>" style="width:60px; text-align: right;" onkeypress="return isNumberKey(event)"/>
        <?php echo $fields->getField('rood')->getHTML(); ?>
        <input type="text" class="text" name="parch"  id="parch" value="<?php echo $parch; ?>" style="width:60px; text-align: right;" onkeypress="return isNumberKey(event)"/>
        <?php echo $fields->getField('parch')->getHTML(); ?> 
        <input type="hidden" name="area" id="area" value="<?php echo $area; ?>"/>
    <?php } elseif ($areaMeasure == 'METRIC UNITS') { ?>
        <input type="text" class="text" name="area"  id="area" value="<?php echo $area; ?>" style="width:100px; text-align: right;" onkeypress="return isNumberKey(event)"/>   
        <?php echo $fields->getField('area')->getHTML(); ?><br />
    <input type="hidden" class="text" name="acre"  id="acre" value="<?php echo $acre; ?>"/>
    <input type="hidden" class="text" name="rood"  id="rood" value="<?php echo $rood; ?>"/>
    <input type="hidden" class="text" name="parch"  id="parch" value="<?php echo $parch; ?>"/>
            <?php } else { ?>
        <input type="text" class="text" name="area"  id="area" value="<?php echo $area; ?>" style="width:75px; text-align: right;" onkeypress="return isNumberKey(event)"/>
    <input type="hidden" class="text" name="acre"  id="acre" value="<?php echo $acre; ?>"/>
    <input type="hidden" class="text" name="rood"  id="rood" value="<?php echo $rood; ?>"/>
    <input type="hidden" class="text" name="parch"  id="parch" value="<?php echo $parch; ?>"/>
            <?php } ?>
</div> 


<div id="Areadiv">
    <?php if ($areaMeasure == 'IMPERIAL UNITS') { ?> 
        <input type="text" class="text" name="feets"  id="feets" value="<?php if (isset($feets)) {echo $feets;} ?>" style="width:75px; text-align: right;" onkeypress="return isNumberKey(event)"/>
        <?php echo $fields->getField('feets')->getHTML(); ?>
        <input type="hidden" name="area" id="area" value="<?php if (isset($area)) {echo $area;} ?>"/>
    <?php } elseif ($areaMeasure == 'METRIC UNITS') { ?>
        <input type="text" class="text" name="area"  id="area" value="<?php if (isset($area)) {echo $area;} ?>" style="width:75px; text-align: right;" onkeypress="return isNumberKey(event)"/>   
        <?php echo $fields->getField('area')->getHTML(); ?><br />
        <input type="hidden" class="text" name="feets"  id="feets" value="<?php if (isset($feets)) {echo $feets;} ?>"/>
    <?php } else { ?>
        <input type="text" class="text" name="area"  id="area" value="<?php if (isset($area)) {echo $area;} ?>" style="width:75px; text-align: right;" onkeypress="return isNumberKey(event)"/>
        <input type="hidden" class="text" name="feets"  id="feets" value="<?php if (isset($feets)) {echo $feets;} ?>"/>
    <?php } ?>
</div> 


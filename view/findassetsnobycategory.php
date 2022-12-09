
<div id="Itmdiv">
    <input type="text" class="text" name="assetsno"  id="assetsno" value="<?php echo $assetsnos->getId(); ?>" style="width:50px; background-color:white; color: black" disabled/>
    <input type="hidden" name="assetsno" value="<?php echo $assetsnos->getId(); ?>"/>
        <?php echo $fields->getField('assetsno')->getHTML(); ?>
    <input type="text" class="text" name="classificationno"  id="classificationno" value="<?php echo $assetsnos->getName(); ?>" style="width:100px; background-color:white; color: black" disabled/>
    <input type="hidden" name="classificationno" value="<?php echo $assetsnos->getName(); ?>"/>
        <?php echo $fields->getField('classificationno')->getHTML(); ?>
    <br />
</td>
</div>
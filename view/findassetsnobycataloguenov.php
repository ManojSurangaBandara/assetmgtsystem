<div id="Itmdiv">
   
    <input hidden type="text" class="text" name="make"  id="make" value="<?php echo $assetsnos->getMake(); ?>" style="width:100px; background-color:white; color: black" disabled/>
    <input type="hidden" name="make" value="<?php echo $assetsnos->getMake(); ?>"/>
    
    <input hidden type="text" class="text" name="modle"  id="modle" value="<?php echo $assetsnos->getModle(); ?>" style="width:150px; background-color:white; color: black" disabled/>
    <input type="hidden" name="modle" value="<?php echo $assetsnos->getModle(); ?>"/>
   
    <input type="text" class="text" name="assetsno"  id="assetsno" value="<?php echo $assetsnos->getId(); ?>" style="width:50px; background-color:white; color: black" disabled/>
    <input type="hidden" name="assetsno" value="<?php echo $assetsnos->getId(); ?>"/>
   
    <input type="text" class="text" name="newAssestno"  id="newAssestno" value="<?php echo $assetsnos->getName(); ?>" style="width:100px; background-color:white; color: black" disabled/>
    <input type="hidden" name="newAssestno" value="<?php echo $assetsnos->getName(); ?>"/>
    
</div> 
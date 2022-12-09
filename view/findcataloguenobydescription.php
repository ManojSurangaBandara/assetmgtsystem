<div id="GSdiv">
    <select name="catalogueno" id="catalogueno" onChange="getrequestitem('index.php?action=findAssetsnoByCatalogueno&mainCategory=<?php echo $mainCategory;?>&itemCategory=<?php echo $itemCategory;?>&catalogueno=' + this.value)">
        <option value=""></option>
        <?php foreach ($cataloguenos as $cata) { ?>
            <option value="<?php echo $cata->getName(); ?>" <?php if ($catalogueno == $cata->getName()) echo "selected = 'selected'"; ?>>
                <?php echo $cata->getName(); ?>
            </option>
        <?php } ?>
    </select>

    <?php echo $fields->getField('catalogueno')->getHTML(); ?><br />
</td>

</div>
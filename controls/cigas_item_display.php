<?php
include '../view/header1.php';
?>
<div id="sec_menu">
    <form action = "index.php" method = "post">
        <input type="hidden" name="action" value="cigas_item_display" />
		<input type="submit" name="exp" value="Convert to CSV" />
		<input type="submit" name="exp_dot" value="Convert to CSV With Dot" />
    </form>
	<?php // include("sub_menu.tpl"); ?>
</div>
<div id="page">
        <div class="section">
            <div class="title_wrapper">
                <h2>
                    Units
                </h2>
                <span class="title_wrapper_left"></span>
                <span class="title_wrapper_right"></span>
            </div>
			<div id="Itmdiv">
		<div class="table_wrapper">
			<div class="table_wrapper_inner">
			    <div id="wrap">
					<div id="table-container">
				<table id="maintable" class="tablesorter" cellpadding="0" cellspacing="0" width="100%" >			
				<thead>
				<tr>
					<th>S No.</th>
					<th>Category_Code</th>
					<th>Item_Code</th>
					<th>Sub_Item_Code</th>
					<th>Description</th>
					<th>Is_Active</th>
				</tr>
				</thead>
				<tbody>
				<?php $i = 1; ?>
				<?php foreach($exps as $exp) { ?>																
				<tr class=<?php if ($i % 2) {
								echo "first";
								} else {
								echo "second";
								}?>>
					<td><?php echo $i; ?></td>
					<td><?php echo substr($exp['newAssestno'],0,5); ?></td>
					<td><?php echo $exp['newAssestno']; ?></td>
					<td><?php echo $exp['cigas_assetno']; ?></td>
					<td><?php echo $exp['itemCategory']." - ".$exp['itemDescription']; ?></td>
					<td><?php echo "Yes"; ?></td>
				</tr>
				<?php $i++; ?>
				<?php }  ?>
			  </tbody>
			  </table>
			  <div></div>
			  </div>
                                        </div>
			  </div>
			  </div>
		</div>
        </div>


</div>
<?php
//include('sidebar.php');
include '../view/footer.php';
?>











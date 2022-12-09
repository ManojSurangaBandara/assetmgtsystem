<?php
include '../view/header1.php';
?>
<style>
a.paging:link, a:visited {
    background-color: #5CB3FF;
    color: white;
    padding: 4px 5px;
    text-align: center;	
    text-decoration: none;
    display: inline-block;
}


a.paging:hover, a:active {
    background-color: #157DEC;
}
</style>
<div id="sec_menu">
<?php
echo "<a href='index.php?action=cigas_officeequipments_display&csv=csv&page1=$page1' class='paging'>Convert to CSV</a>";
echo "<a href='index.php?action=cigas_officeequipments_display&csv_all=csv_all&page1=$page1' class='paging'>Convert All to CSV</a>";
echo "<a href='index.php?action=cigas_officeequipments_display&exp_dot=exp_dot&page1=$page1' class='paging'>Convert to CSV With Dot</a>";
 ?>  
</div>
<script>	
$(document).ready(function() {
		$('table').tablesorter({
			widgets        : ['stickyHeaders']
		});	
});
</script>
<div id="page">
        <div class="section">
            <div class="title_wrapper">
                <h2>
                    Office Equipments
                </h2>
                <span class="title_wrapper_left"></span>
                <span class="title_wrapper_right"></span>
            </div>
<?php
echo "<a href='index.php?action=cigas_officeequipments_display&page1=1' class='paging'>First Page</a>";
for ($j=1; $j<=$total_pages; $j++) {
	echo "<a href='index.php?action=cigas_officeequipments_display&page1=$j' class='paging'>$j</a>";
};
echo "<a href='index.php?action=cigas_officeequipments_display&page1=$total_pages'  class='paging'>Last Page</a>";
?>
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
					<th>Identification_no</th>
					<th>Old_no</th>
					<th>Location_code</th>
					<th>date</th>
					<th>Suppler_code</th>
					<th>Description</th>
					<th>Value</th>
					<th>Pass_journel</th>
					<th>Sno</th>
				</tr>
				</thead>
				<tbody>
				<?php //$i = 1; ?>
				<?php foreach($exps as $exp) { ?>																
				<tr class=<?php if ($i % 2) {
								echo "first";
								} else {
								echo "second";
								}?>>
					<td><nobr><?php echo $i; ?></nobr></td>
					<td><nobr><?php echo substr($exp['newAssestno'],0,5); ?></nobr></td>
					<td><nobr><?php echo $exp['newAssestno']; ?></nobr></td>
					<td><nobr><?php echo $exp['cigas_assetno']; ?></nobr></td>
					<td><nobr><?php echo $exp['cigas_idno']; ?></nobr></td>
					<td></td>
					<td><nobr><?php
					$cigas_name = AssetsUnitDB::get_cigas_name($exp['assetunit']);
					echo ($cigas_name == ''? $exp['assetunit'] : $cigas_name); 
					?></nobr></td>
					<?php 
					$date = $exp['purchasedDate'];
					$date_array = explode("-",$date); // split the array
							$var_year = (int)$date_array[0]; //day seqment
							$var_month = (int)$date_array[1]; //month segment
							$var_day = (int)$date_array[2]; //year segment
							$new_date_format = "$var_day/$var_month/$var_year"; // join them together ?>
					<td><nobr><?php echo $new_date_format; ?></nobr></td>
					<td>OPN</td>
					<td><nobr><?php echo $exp['itemCategory']." - ".$exp['itemDescription']; ?></nobr></td>
					<td><nobr><?php echo $exp['unitValue']; ?></nobr></td>
					<td></td>
					<td><nobr><?php echo $i; ?></nobr></td>
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











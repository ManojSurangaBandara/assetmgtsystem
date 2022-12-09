<?php
include '../view/header1.php';
?>
<script>	
$(document).ready(function () {
$(".savebttn").click(function(){
	var id = $(this).attr('id');    
    var province = $('#province_'+id).val();
    var querystring = {
			id: id,
			province: province,
			action: 'add_province_code'
		}
		$.get('index.php', querystring, processResponse);
	 function processResponse(result) {
			if (result != 1){
				alert("Error in Data Input.");
			}
		}
	return false
});
}); 
</script>
<div id="sec_menu">
    <form action = "index.php" method = "post">
        <input type="hidden" name="action" value="cigas_units_display" />
		<input type="submit" name="exp" value="Convert to CSV" />
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
					<th>Location</th>
					<th>Description</th>
					<th>Is_Active</th>
					<th>Address</th>
					<th>Province</th>
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
					<td><?php echo $exp['unitName']; ?></td>
					<td><?php echo $exp['unitName']; ?></td>
					<td><?php echo "Yes"; ?></td>
					<?php $row = unitdetailsDB::getDetailsByUnit($exp['unitName']); ?>
					<td><?php echo $row['address']; ?></td>
					<form name="add_form" id="add_form" class="add_form" action="." method="post">	
					<td><input type="hidden" name="id" id="id" value="<?php echo $exp['SN']; ?>"/>
						<td>
							<select name="province_<?php echo $exp['SN']; ?>" id="province_<?php echo $exp['SN']; ?>">
								<option value=""></option>
								<?php foreach ($provinces as $prov) { ?>
									<option value="<?php echo $prov['province_code']; ?>" <?php if ($exp['province_code'] == $prov['province_code']) echo "selected = 'selected'"; ?>>
										<?php echo $prov['province_name']; ?>
									</option>
								<?php } ?>
						</td>
						<td><input class = "savebttn" id = "<?php echo $exp['SN']; ?>" name="submit" type="submit" value="Save"/>
					</form>
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











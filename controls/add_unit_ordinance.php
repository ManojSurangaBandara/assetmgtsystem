<?php include 'header1.php'; ?>
<script>	
$(document).ready(function () {
$(".savebttn").click(function(){
	var id = $(this).attr('id');    
    var unit = $('#unitName_'+id).val();
    var ordinance = $('#ordinance_'+id).val();
    var querystring = {
			id: id,
			unit: unit,
			ordinance: ordinance,
			action: 'add_unit_ordinance_record'
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
<div id="page">
    <div class="inner">
        <div class="section">
            <div class="title_wrapper">
                <h2>
                    Add Unit ordinance Places
                </h2>
                <span class="title_wrapper_left"></span>
                <span class="title_wrapper_right"></span>
            </div>
			<div id="Itmdiv">
		<div class="table_wrapper">
			<div class="table_wrapper_inner">
				<table cellpadding="0" cellspacing="0" width="100%" >
				<tr>
					<th>S No.</th>
					<th>Unit</th>
					<th>Unit Name in Sinhala</th>
					<th>Ordinance</th>
				</tr><tbody>
				<?php $i = 1; ?>
				<?php foreach($exps as $exp) { ?>																
				<tr class=<?php if ($i % 2) {
								echo "first";
								} else {
								echo "second";
								}?>>
					<td><?php echo $i; ?></td>
                    
                    <form name="add_form" id="add_form" class="add_form" action="." method="post">	
					<td><input type="text" name="unitName_<?php echo $exp['SN']; ?>" id="unitName_<?php echo $exp['SN']; ?>" value="<?php echo $exp['unitName']; ?>" disabled></td>									
						<input type="hidden" name="id" id="id" value="<?php echo $exp['SN']; ?>"/>
						<td><?php echo $exp['unitNameSinhalaFull']; ?></td>
						<td><select name="ordinance_<?php echo $exp['SN']; ?>"  id ="ordinance_<?php echo $exp['SN']; ?>" class="categ">
						<option value=""></option>
						<?php foreach ($ordinances as $ordinance) { ?>
						<option value="<?php echo $ordinance['code']; ?>" <?php if ($exp['ordinance'] == $ordinance['code']) echo "selected = 'selected'"; ?>>
						<?php echo $ordinance['code']; ?>
						</option>
								<?php } ?>
						</select></td>
						
						<td><input class = "savebttn" id = "<?php echo $exp['SN']; ?>" name="submit" type="submit" value="Save"/>
					</form>
                        </td>                        
				</tr>
				<?php $i++; ?>
				<?php }  ?>
			  </tbody>
			  </table>
			  </div>
			  </div>
		</div>
        </div>

    </div>
</div>

<?php
include('sidebar.php');
include '../view/footer.php';
?>











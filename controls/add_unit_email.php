<?php include 'header1.php';?>
<script>	
$(document).ready(function () {
$(".savebttn").click(function(){
	var id = $(this).attr('id');    
    var unit = $('#unitName_'+id).val();
    var email = $('#email_'+id).val();
    var querystring = {
			id: id,
			unit: unit,
			email: email,
			action: 'add_unit_email_record'
		}
		$.get('index.php', querystring, processResponse);
	 function processResponse(result) {
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
                    Add Unit E-Mail Address
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
					<th>E-Mail Address</th>
					<th></th>
					<th>Unit Crest</th>
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
						<td><input type="text" name="email_<?php echo $exp['SN']; ?>" id="email_<?php echo $exp['SN']; ?>" value="<?php echo $exp['email']; ?>"></td>
						<td><input class = "savebttn" id = "<?php echo $exp['SN']; ?>" name="submit" type="submit" value="Save"/>
					</form>
                    </td>
                    <?php $details = unitdetailsDB::getDetailsByUnit($exp['unitName']); ?>
					<td><img src="<?php echo $details['crest']; ?>" width="30" height="30" /></td>
					<form name="frm_land_add" method="post" id="frm_land_add" action="index.php" class="search_form general_form" enctype="multipart/form-data">	
					<input type="hidden" name="action" value="add_unit_email" />                                      
                        <input type="hidden" name="unit" id="unit" value="<?php echo $exp['unitName']; ?>" /> 
						<td><input type="file" name="Filename"></td>
						<td><input name="" type="submit"/>
                    </td> 
					</form>                        
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











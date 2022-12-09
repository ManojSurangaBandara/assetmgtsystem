<?php
include '../view/header1.php';
?>
<div id="sec_menu">
    <?php include("sub_menu.tpl"); ?>
</div>
<script>	
$(document).ready(function () {
$(".savebttn").click(function(){
	var id = $(this).attr('id');    
    var unit = $('#unitName_'+id).val();
    var controller = $('#controller_'+id).val();
	var user_email = $('#user_email_'+id).val();
    var querystring = {
			id: id,
			unit: unit,
			controller: controller,
			user_email: user_email,
			action: 'add_dam_controller_record'
		}
		$.get('index.php', querystring, processResponse);
	 function processResponse(result) {
			if (result != 1){
				//alert("Error in Data Input.");
			}
		}
	return false
});
$("#copy_btn").click( function() {
	  var querystring = {     
			action: 'copy_dam_controller'
		     }      
		$.get('index.php', querystring, processResponse);
		function processResponse(result) {
		alert(result);
		} 
	return false		
     });
$("#copy_btn_email").click( function() {
	  var querystring = {     
			action: 'copy_email_from_unit'
		     }      
		$.get('index.php', querystring, processResponse);
		function processResponse(result) {
		alert(result);
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
					<th>DAM Controller</th>
					<th>E-Mail Address</th>
					<th>Save Btn</th>
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
						<td><select name="controller_<?php echo $exp['SN']; ?>"  id ="controller_<?php echo $exp['SN']; ?>" class="categ">
						<option value=""></option>
						<?php foreach ($controllers as $controller) { ?>
						<option value="<?php echo $controller['login']; ?>" <?php if ($exp['dam_controller'] == $controller['login']) echo "selected = 'selected'"; ?>>
						<?php echo $controller['login']; ?>
						</option>
								<?php } ?>
						</select></td>
						<?php 
						$user_email = MembersDB::get_user_email($exp['unitName']);
						?>
						<td><input type="text" name="user_email_<?php echo $exp['SN']; ?>" id="user_email_<?php echo $exp['SN']; ?>" value="<?php echo $user_email; ?>"></td>
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
        <input id="copy_btn" type="button" value="Copy DAM Controllers to Asset Tables" style="color: white; background-color: red;"/>
		<input id="copy_btn_email" type="button" value="Copy E-mail Addresses from Unit Table" style="color: white; background-color: red;"/>
    </div>
</div>

<?php
include('sidebar.php');
include '../view/footer.php';
?>











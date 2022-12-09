<?php include 'header2.php';?>
<script>	
$(document).ready(function () {
$(".savebttn").click(function(){
	var id = $(this).attr('id');    
	if ($('#error_display_'+id).is(":checked")) {
        error_display = 1;
    } else {
        error_display = 0;
    }
    var error_codes = $('#error_codes_'+id).val();
    var querystring = {
			id: id,
			error_display: error_display,
			error_codes: error_codes,
			action: 'inform_errors_records'
		}
		$.get('index.php', querystring, processResponse);
	 function processResponse(result) {
		//alert(result);
		}
	return false
});
$("#sendbttn").click(function(){
	//window.open('mailto:test@example.com'); 
    //  alert();
    var id = $(this).attr('id');    
	if ($('#error_display_'+id).is(":checked")) {
        error_display = 1;
    } else {
        error_display = 0;
    }
    var error_codes = $('#error_codes_'+id).val();
    var querystring = {
			id: id,
			error_display: error_display,
			error_codes: error_codes,
			action: 'send_mail'
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
                    Inform Errors to Units
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
					<th>Display
                    <input type=button onClick=window.open("display_errorcode.php","Ratting","width=800,height=500,left=50,top=50,toolbar=0,status=0,"); value="Error Codes"></th>
                    <th>Dis.</th>
				</tr><tbody>
				<?php 
                    $emailString ="";
                    $SelemailString ="";
                    $ErroremailString ="";
                    $i = 1; ?>
				<?php foreach($exps as $exp) { ?>																
				<tr class=<?php if ($i % 2) {
								echo "first";
								} else {
								echo "second";
								}?>>
					<td><?php echo $i; ?></td>
					<td><?php echo $exp['unitName']; ?></td>
					<td>
					<form name="add_form" id="add_form" class="add_form" action="." method="post">									
						<input type="hidden" name="id" id="id" value="<?php echo $exp['SN']; ?>"/>
						<input type="checkbox" name="error_display_<?php echo $exp['SN']; ?>" id="error_display_<?php echo $exp['SN']; ?>" value="1" <?php if($exp['error_display']==1) echo "checked=checked"; ?>>
						<input type="text" name="error_codes_<?php echo $exp['SN']; ?>" id="error_codes_<?php echo $exp['SN']; ?>" value="<?php echo $exp['error_codes']; ?>">
						<input class = "savebttn" id = "<?php echo $exp['SN']; ?>" name="submit" type="submit" value="Save"/>
					</form>
                        </td>
                        <td><?php echo ($exp['errordisplay'] == 1) ? 'Yes' : 'No';?></td>
                        <td><a href="index.php?action=add_unit_error&unit=<?php echo $exp['unitName']; ?>"><?php echo empty($exp['errortitle']) ? "Add Errors" : substr($exp['errortitle'], 0, 40); ?></a></td>
                        <td><?php echo $exp['email']; ?></td>
                        <td>
                        <a href="mailto:<?php echo $exp['email']; ?>?subject=වකඅම - ජාලගත පරිගණක වැඩසටහන - හඳුනාගත් වැරදි පිළිබඳව දැනුවත් කිරීම.&body=ඔබ ඒකකය විසින් ස්ථාවර වත්කම් ජාලගත පරිගණක වැඩසටහන වෙත ඇතුලත් කර ඇති විස්තර වැරදි/අසම්පූර්ණ බවට හදුනාගෙන ඇත. එහෙයින් http://armynet.army.lk/assetmgtsystem/ වෙත ගොස් හැකි ඉක්මණින් නිවැරදි කර වකඅම වෙත දැනුම් දෙන්න.(This is an automatically generated E-Mail by AMS)"><button type="button">Send E-Mail</button></a>
					</td>
				</tr>
				<?php 
                    if (!filter_var($exp['email'], FILTER_VALIDATE_EMAIL) === false) {
                       $emailString = $emailString . $exp['email'].';'; 
                        if ($exp['error_display']==1 || $exp['errordisplay'] == 1) {
                            $SelemailString = $SelemailString . $exp['email'].';';
                        }
                    } else {
                       $ErroremailString = $ErroremailString .' | '. $exp['unitName'];
                    }                     
                $i++; ?>
				<?php }  ?>
			  </tbody>
			  </table>
			  </div>
			  </div>
		</div>
            <div class="title_wrapper">
                <h2>
                    Correct All E-Mail Address String 
                </h2>
                <span class="title_wrapper_left"></span>
                <span class="title_wrapper_right"></span>
            </div>
            <div><textarea rows="15" style="min-width: 100%"><?php echo $emailString; ?></textarea></div>
                <div class="title_wrapper">
                <h2>
                    Only Select E-Mail Address String 
                </h2>
                <span class="title_wrapper_left"></span>
                <span class="title_wrapper_right"></span>
            </div>
            <div><textarea rows="15" style="min-width: 100%"><?php echo $SelemailString; ?></textarea></div>
            <div class="title_wrapper">
                <h2>
                    Error E-Mail Address String 
                </h2>
                <span class="title_wrapper_left"></span>
                <span class="title_wrapper_right"></span>
            </div>
            <div><textarea rows="15" style="min-width: 100%"><?php echo $ErroremailString; ?></textarea></div>
        </div>
    </div>
</div>

<?php
include('sidebar.php');
include '../view/footer.php';
?>











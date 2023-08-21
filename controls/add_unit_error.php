<?php include 'header2.php';?>
	<script>
	$(function(){
	$("#submit").click(function(){
        saveData();
	return false
});
function saveData()
		{
	var unit = $('#unit').val();
    if ($('#errordisplay').is(":checked")) {
        var errordisplay = 1;
    } else {
        var errordisplay = 0;
    }
    var errortitle = $('#errortitle').val();
	var errordetails = $('#errordetails').val();
	var querystring = {
			unit: unit,
            errordisplay: errordisplay,
			errortitle: errortitle,
			errordetails: errordetails,
			action: 'add_unit_error_record'
		}
		$.get('index.php', querystring, processResponse);
	 function processResponse(result) {
		//alert(result);
		}
	return false
		};
	});
	</script>
<div id="page">
    <div class="inner">
        <div class="section">
            <div class="title_wrapper">
                <h2>
                    ADD - Unit Errors
                </h2>
                <span class="title_wrapper_left"></span>
                <span class="title_wrapper_right"></span>
            </div>
            <div class="section_content">
                <div class="sct">
                    <div class="sct_left">
                        <div class="sct_right">
                            <div class="sct_left">
                                <div class="sct_right">								
								<div id="confirm" title="Confirm Destruction"></div>
                                    <ul id="message" class="system_messages">
                                        <li class="blue"><span class="ico"></span><strong class="system_title">Enter Data and  press "Add Details" Button</strong></li>
                                    </ul>
                                    <form name="add_form" method="post" id="add_form" action="index.php" class="add_form"> 
                                        <div><label for="brand" class="label">Assets Unit :</label><input type="text" class="text" name="unit"  id="unit" value ="<?php echo $unit; ?>" style="width:300px" readonly/></div>
                                        <div><label for="brand" class="label">Error Display :</label><input type="checkbox" name="errordisplay" id="errordisplay" value="1" <?php if($errordisplay==1) echo "checked=checked"; ?>></div>
										<div><label for="errortitle" class="label">Error Title :</label><input type="text" class="text" name="errortitle"  id="errortitle" value ="<?php echo $errortitle; ?>" style="width:300px"/></div>
                                        <div><label for="errordetails" class="label">Error Details :</label><textarea rows="15" cols="80" name="errordetails"  id="errordetails"><?php echo $errordetails; ?></textarea></div>
										<div><input type="submit" name="submit" id="submit" value="Add Error Details"></div>
                                        <a href="mailto:<?php echo $email; ?>?subject=වකඅම - ජාලගත පරිගණක වැඩසටහන - හඳුනාගත් වැරදි පිළිබඳව දැනුවත් කිරීම.&body=ඔබ ඒකකය විසින් ස්ථාවර වත්කම් ජාලගත පරිගණක වැඩසටහන වෙත ඇතුලත් කර ඇති විස්තර වැරදි/අසම්පූර්ණ බවට හදුනාගෙන ඇත. එහෙයින් https://armyapps.army.lk/assetmgtsystem/ වෙත ගොස් හැකි ඉක්මණින් නිවැරදි කර වකඅම වෙත දැනුම් දෙන්න. (This is an automatically generated E-Mail by AMS)"><button type="button">Send E-Mail</button></a>
                                    </form> 
						   </div>
                        </div>
                    </div>
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











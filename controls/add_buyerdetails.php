<?php
include '../view/header1.php';
?>
<div id="sec_menu">
    <?php include("sub_menu.tpl"); ?>
</div>
<script>
$(document).ready(function () {
 $(".text").keypress(function (event) {
	if (event.keyCode == 13) {
		textboxes = $("input.text");
		debugger;
		currentBoxNumber = textboxes.index(this);
		if (currentBoxNumber < 4) {
			nextBox = textboxes[currentBoxNumber + 1]
			nextBox.focus();
			nextBox.select();
		} else {
			$("#submit").focus();
		}
		event.preventDefault();
		return false
	}
});
$('#nicno').blur(function() {
  var nicno = $('#nicno').val();
  	var querystring = {
			nicno: nicno,
			action: 'get_buyerdetails_nicno'
		}
  		$.get('index.php', querystring, processResponse);
	 function processResponse(result) {
           // var numbers = $.parseJSON(result);
           const obj = JSON.parse(result);
		   alert(JSON.stringify(obj));
			$('#name').val(obj.name);
           // $('#classificationno').val(numbers[1]);
		}
});   
/* $("#frm_add").validate({
	rules: {
		"nicno": {
			required: true
		},
		"name": {
			required: true
		}
	},
	submitHandler: function () {
		$(':text:first').focus();
		var formData = $("#frm_add").serialize();
		$.post('index.php', formData, processData).error(errorResponse);
		function processData(data) {
			if (data == '1' || data == '2') {
				setMessage(data);
				$("#id").val("0");
				$("#submit").prop('value', 'Add Details');
				$('#update').hide();
				showSidebar(0);
				if ($('#clearform').is(":checked"))
					{
					  clearForm();
					}
				
			} else if (data == '3') {
				setMessage(data);						
			} else {
				setMessage(data);
			}
		} // end processData
		function errorResponse() {
			//setMessage(6);
		}
		return false;
	}
}); */



});	
</script>	
<div id="page">
    <div class="inner">
        <div class="section">
            <div class="title_wrapper">
                <h2>
                    ADD - Buyer Details
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
                                    <ul class="system_messages">
                                        <?php
                                        switch ($error) {
                                            case '0':
                                                ?>
                                                <li class="blue"><span class="ico"></span><strong class="system_title">Enter Data and  press "Add Details" Button</strong></li>
                                                <?php
                                                break;
                                            case '1':
                                                ?>
                                                <li class="green"><span class="ico"></span><strong class="system_title">Data Successfully Saved.</strong></li>
                                                <?php
                                                break;
                                            case '2':
                                                ?>
                                                <li class="red"><span class="ico"></span><strong class="system_title">Data Error. Please Check Data !</strong></li>
                                                <?php
                                                break;
                                            case '3':
                                                ?>
                                                <li class="yellow"><span class="ico"></span><strong class="system_title">NIC Number Already Entered !</strong></li>
                                                <?php
                                                break;
                                            case '5':
                                                ?>
                                                <li class="red"><span class="ico"></span><strong class="system_title">Error when Database Writing !</strong></li>
                                                <?php
                                                break;
                                            case '6':
                                                ?>
                                                <li class="green"><span class="ico"></span><strong class="system_title">Data Deleted</strong></li>
                                        <?php } ?>
                                    </ul>
                                    <form name="frm_add" method="post" id="frm_add" action="index.php" class="search_form general_form"> 
                                        <input type="hidden" name="action" value="Add_BuyerDetail" />
                                        
                                        <table width="100%" border="0">
                                            <td colspan="3">
                                                <table width="100%" border="0" class="listing form">
                                                    <tr>
                                                        <td width="30%"><label>NIC Number :</label></td>

                                                        <td width="70%">
                                                            <input type="text" class="text" name="nicno"  id="nicno" value="<?php echo $nicno; ?>" style="width:300px"/>

                                                            <?php echo $fields->getField('instName')->getHTML(); ?><br /></td>
                                                    </tr>
													<tr>
                                                        <td width="30%"><label>Name :</label></td>

                                                        <td width="70%">
                                                            <input type="text" class="text" name="name"  id="name" value="<?php echo $name; ?>" style="width:300px"/>

                                                            <?php echo $fields->getField('instName')->getHTML(); ?><br /></td>
                                                    </tr>
													                                                    <tr>
                                                        <td width="30%"><label>Address :</label></td>

                                                        <td width="70%">
                                                            <input type="text" class="text" name="address"  id="address" value="<?php echo $address; ?>" style="width:400px"/>

                                                            
                                                    </tr>
													 <tr>
                                                        <td width="30%"><label>Telephone :</label></td>

                                                        <td width="70%">
                                                            <input type="text" class="text" name="telephone"  id="telephone" value="<?php echo $telephone; ?>" style="width:300px"/>

                                                            
                                                    </tr>
													
													<tr>
                                                        <td width="30%"><label>E-Mail Address :</label></td>

                                                        <td width="70%">
                                                            <input type="text" class="text" name="email"  id="email" value="<?php echo $email; ?>" style="width:300px"/>

                                                            
                                                    </tr>
                                                    
                                                    <tr>
                                                        <td><label> </label></td>
                                                        <td>
                                                            <div class="buttons">
                                                             
                                                                  <span class="button send_form_btn"><span><span><?php echo "Add Buyer Details";?></span></span><input name="" type="submit"/></span> 
                                                                   
                                                            </div>

                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                            </tr>
                                        </table>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
			<div id="Itmdiv">
												<div class="table_wrapper">
													<div class="table_wrapper_inner">
														<table cellpadding="0" cellspacing="0" width="100%" >
														<tbody><tr>
															<th>&nbsp;</th>
															<th>NIC No.</th>
															<th>Name</th>
															<th>Address</th>
															<th>Telephone</th>
															<th>E-Mail</th>
														</tr>
														<?php $i = 1; ?>
														<?php foreach($content as $c) { ?>																
														<tr class=<?php if ($i % 2) {
																		echo "first";
																		} else {
																		echo "second";
																		}?>>
															<td><?php echo $i; ?></td>
															<td><?php echo $c->_get('nicno'); ?></td>
															<td><?php echo $c->_get('name'); ?></td>
															<td><?php echo $c->_get('address'); ?></td>
															<td><?php echo $c->_get('telephone'); ?></td>
															<td><?php echo $c->_get('email'); ?></td>
 															<!-- <td><?php echo $i; ?></td>
															<td><?php echo $exp['nicno']; ?></td>
															<td><?php echo $exp['name']; ?></td>
															<td><?php echo $exp['address']; ?></td>
															<td><?php echo $exp['telephone']; ?></td>
															<td><?php echo $exp['email']; ?></td> -->
															<td><form action="." method="post">
															<input type="hidden" name="action" value="delete_BuyerDetail" />									
															<input type="hidden" name="id" value="<?php echo $c->_get('id'); ?>"/>
															<input name="submit" type="submit" value="Delete" onClick = "javascript: return confirm('Are you SURE you wish to Delete this Institute?');"/>
															</form></td> 
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











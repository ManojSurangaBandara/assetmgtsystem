<?php
include '../view/header2.php';
?>
<div id="sec_menu">
    <?php include("sub_menu.tpl"); ?>
</div>
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
								<script>	
								$(document).ready(function () {
								var nicnoTags = ["<?php echo  implode('","',$nicnos); ?>"];
								$( "#nicno" ).autocomplete({
									source: nicnoTags
								});
								$(':text:first').focus();
								$("#add").val("1");
								$( "#nicno" ).blur(function() {
									var querystring = {
													id: $( "#nicno" ).val(),
													action: 'get_BuyerDetail_Ajax'
												}
												$.get('index.php', querystring, processResponse);
										function processResponse(result) {
												var obj1 = $.parseJSON(result);
												if ($('#nicno').val() == obj1.nicno) {											
													$('#name').val(obj1.name);
													$('#address').val(obj1.address);
													$('#telephone').val(obj1.telephone);
													$('#email').val(obj1.email);
													$("#submit").prop('value', 'Update Buyer Details');
													$("#add").val("0");
													$('#message').html('<li class="blue"><span class="ico"></span><strong class="system_title">Enter Data and  press "Update Buyer Details" Button</strong></li>');
												} else {
													$('#name').val("");
													$('#address').val("");
													$('#telephone').val("");
													$('#email').val("");
													$("#add").val("1");
													$("#submit").prop('value', 'Add Buyer Details');
												}
												}		
								});
								//validation rules
								$("#add_form").validate({
									rules: {
										"nicno": {
											required: true
										},  
										"name": {
											required: true
										},
										"address": {
											required: true
										},  
										"email": {
											email: true
										}
									},
									//perform an AJAX post to ajax.php
									submitHandler: function() {
										var formData = $("#add_form").serialize();
										$.post('index.php', formData, processData).error(errorResponse);
										function processData(data) {
											if (data=='1') {
												$('#message').html('<li class="green"><span class="ico"></span><strong class="system_title">Data Successfully Saved.</strong></li>');
												abc ='<tr id="' + $('#nicno').val() + '"><td>' + "New" + '</td><td>' + $('#nicno').val() + '</td><td>' + $('#name').val() +'</td><td>' + $('#address').val() +'</td><td>' + $('#telephone').val() +'</td><td>' + $('#email').val() +'</td><td><input type="button" value="Delete" id="' + $('#nicno').val() + '"></td></tr>';
												$('#buyerTable tr:first').after(abc);
											} else if (data=='2') { 
												$('#' + $('#nicno').val()).remove();
												$('#message').html('<li class="green"><span class="ico"></span><strong class="system_title">Data Successfully Updated.</strong></li>');
												abc ='<tr><td>' + "New" + '</td><td>' + $('#nicno').val() + '</td><td>' + $('#name').val() +'</td><td>' + $('#address').val() +'</td><td>' + $('#telephone').val() +'</td><td>' + $('#email').val() +'</td><td><input type="button" value="Delete" id="' + $('#nicno').val() + '"></td></tr>';
												$('#buyerTable tr:first').after(abc);
												$("#add").val("1");
												$("#submit").prop('value', 'Add Buyer Details');
											} else if (data=='3') { 
												$('#message').html('<li class="red"><span class="ico"></span><strong class="system_title">NIC Number Already Entered</strong></li>');
											} else {
												$('#message').html('<li class="red"><span class="ico"></span><strong class="system_title">' + data + ' Data Error. Please Check Data !</strong></li>');
											}
											} // end processData
										function errorResponse() {
											$('#message').html('<li class="red"><span class="ico"></span><strong class="system_title">Error when Database Writing !</strong></li>');
											}
										return false;
									}
								});
								
								$('table').on('click', 'input[type="button"]', function(e){
								$("#confirm").html("<p>Are you sure you want to Delete this record?</p>");
								var id=this.id;												
								$("#confirm").dialog({
								resizable: false,
								modal: true,
								height: 150,
								width: 400,
								buttons: {
								"Confirm": function () {
									$(this).dialog('close');
									var querystring = {
													id: id,
													action: 'delete_BuyerDetail_Ajax'
												}
												$.get('index.php', querystring, processResponse);
												function processResponse(data) {
													if (data=='1') {
														$('#message').html('<li class="green"><span class="ico"></span><strong class="system_title">Data Successfully Deleted.</strong></li>');
														$('#' + id).closest('tr').remove();
													} else {
														$('#message').html('<li class="red"><span class="ico"></span><strong class="system_title">Data Error. Please Check Data !</strong></li>');
													}
													} // end processData
												
												},
								"Cancel": function () {
									$(this).dialog('close');
									}
								}
								});
								});
								$('#nicno').focus(function() {
                                    $('#message').html('<li class="blue"><span class="ico"></span><strong class="system_title">Enter Data and  press "Add Details" Button</strong></li>'); 
                                });
								$('tr').dblclick(function(){
									$("html, body").animate({ scrollTop: 0 }, "slow");
									var id = $(this).attr('id');
									var querystring = {
													id: id,
													action: 'get_BuyerDetail_Ajax'
												}
												$.get('index.php', querystring, processResponse);
												function processResponse(result) {
												var obj1 = $.parseJSON(result);
												$('#nicno').val(obj1.nicno);
												$('#name').val(obj1.name);
												$('#address').val(obj1.address);
												$('#telephone').val(obj1.telephone);
												$('#email').val(obj1.email);
												//$('#submit').hide();
												//$('#update').show();
												$("#submit").prop('value', 'Update Buyer Details');
												$("#add").val("0");
												$('#message').html('<li class="blue"><span class="ico"></span><strong class="system_title">Enter Data and  press "Update Buyer Details" Button</strong></li>');
												}																
								});
									$(document).on("keypress", ".text", function(e) {
									 if (e.which == 13) {
										return false; // prevent the button click from happening
									 }
								});
								});
								</script>
								<div id="confirm" title="Confirm Destruction"></div>
                                    <ul id="message" class="system_messages">
                                        <li class="blue"><span class="ico"></span><strong class="system_title">Enter Data and  press "Add Details" Button</strong></li>
                                    </ul>
                                    <form name="add_form" method="post" id="add_form" action="index.php" class="add_form"> 
                                        <input type="hidden" name="action" value="Add_BuyerDetail_Ajax" />
										<input type="hidden" name="add" id="add" value="1" />
                                        <div><label for="nicno" class="label">NIC Number :</label><input type="text" class="text" name="nicno"  id="nicno" style="width:300px"/></div>
										<div><label for="name" class="label">Name :</label><input type="text" class="text" name="name"  id="name" style="width:300px"/></div>
										<div><label for="address" class="label">Address :</label><input type="text" class="text" name="address"  id="address" style="width:400px"/></div>
										<div><label for="telephone" class="label">Telephone :</label><input type="text" class="text" name="telephone"  id="telephone" style="width:300px"/></div>
										<div><label for="email" class="label">E-Mail Address :</label><input type="text" class="email" name="email"  id="email" style="width:300px"/></div>
										<div><input type="submit" name="submit" id="submit" value="Add Buyer Details"></div>											 
                                    </form>                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
			<div id="Itmdiv">
												<div class="table_wrapper">
													<div class="table_wrapper_inner">
														<table id = "buyerTable" cellpadding="0" cellspacing="0" width="100%" >
														<tbody><tr>
															<th>&nbsp;</th>
															<th>NIC No.</th>
															<th>Name</th>
															<th>Address</th>
															<th>Telephone</th>
															<th>E-Mail</th>
														</tr>
														<?php $i = 1; ?>
														<?php foreach($exps as $exp) { ?>																
														<tr id="<?php echo $exp['nicno']; ?>" class=<?php if ($i % 2) {
																		echo "first";
																		} else {
																		echo "second";
																		}?>>
															<td><?php echo $i; ?></td>
															<td><?php echo $exp['nicno']; ?></td>
															<td><?php echo $exp['name']; ?></td>
															<td><?php echo $exp['address']; ?></td>
															<td><?php echo $exp['telephone']; ?></td>
															<td><?php echo $exp['email']; ?></td>
															<td><input type="button" value="Delete" id="<?php echo $exp['nicno']; ?>"></td>
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
</div>
<?php
include('sidebar.php');
include '../view/footer.php';
?>











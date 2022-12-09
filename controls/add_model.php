<?php include 'header6.php';?>
<div id="page">
    <div class="inner">
        <div class="section">
            <div class="title_wrapper">
                <h2>
                    ADD - Vehicle Models
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
									$("#add_form").validate({
									rules: {
										"brand": {
											required: true
										},  
										"model": {
											required: true										
										}
									},
									//perform an AJAX post to ajax.php
									submitHandler: function() {
										$(':text:first').focus();
										var formData = $("#add_form").serialize();
										$.post('index.php', formData, processData).error(errorResponse);
										function processData(data) {
											if (data=='1') {
												$('#message').html('<li class="green"><span class="ico"></span><strong class="system_title">Data Successfully Saved.</strong></li>');
												abc ='<tr id="' + $('#code').val() + '"><td>' + "New" + '</td><td>' + $('#brand').val() + '</td><td>' + $('#model').val() +'</td><td>' + $('#details').val() +'</td></tr>';
												$('#buyerTable tr:first').after(abc);
											} else if (data=='2') { 
												$('#' + $('#id').val()).remove();
												$('#message').html('<li class="green"><span class="ico"></span><strong class="system_title">Data Successfully Updated.</strong></li>');
												abc ='<tr id="' + $('#code').val() + '"><td>' + "New" + '</td><td>' + $('#brand').val() + '</td><td>' + $('#model').val() +'</td><td>' + $('#details').val() +'</td></tr>';
												$('#buyerTable tr:first').after(abc);
												$("#id").val("0");
												$("#submit").prop('value', 'Add Details');
												$('#update').hide();
											} else if (data=='3') { 
												$('#message').html('<li class="red"><span class="ico"></span><strong class="system_title">Vehicle Modle Already Entered</strong></li>');
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
								$('#model').focus(function() {
                                    $('#message').html('<li class="blue"><span class="ico"></span><strong class="system_title">Enter Data and  press "Add Details" Button</strong></li>'); 
                                });
								$('#buyerTable').delegate('tr', 'dblclick', function() {
									var id = $(this).attr('id');
									$('#id').val(id);
									$('#update').show();
									i = 0;
									$(this).closest('tr').find('td').each(function() {
										i++;
										var data = $(this).text(); // this will be the text of each <td>
										if (i == 2) {
											$('#brand').val(data);
										} else if (i == 3) {
											$('#model').val(data);
										} else if (i == 4) {
											$('#details').val(data);
										}
									});
									
								});

								$("#update").click(
								function(e) {
								if ($('#id').val() != 0) {
									$("#confirm").html("<p>Are you sure you want to Delete this record? " + $('#name').val() + "</p>");
									var id=$('#id').val();												
									$("#confirm").dialog({
									resizable: false,
									modal: true,
									height: 150,
									width: 400,								
									buttons: {
									"Confirm": function () {
										var querystring = {
														id: id,
														action: 'delete_model_details'
													}
													$.get('index.php', querystring, processResponse);
													function processResponse(data) {
														if (data=='1') {
															$('#message').html('<li class="green"><span class="ico"></span><strong class="system_title">Data Successfully Deleted.</strong></li>');
															$('#' + id).closest('tr').remove();
															$("#id").val("0");
															$("#submit").prop('value', 'Add Details');
															$('#update').hide();
														} else {
															$('#message').html('<li class="red"><span class="ico"></span><strong class="system_title">Data Error. Please Check Data !</strong></li>');
														}
														} // end processData													
													$("html, body").animate({scrollTop: 0}, "slow");
													$(this).dialog('close');
													},
									"Cancel": function () {
										$(this).dialog('close');
										}
									} 
									});
									e.preventDefault();
									
								} });
								$('#update').hide();
								$(".text").keypress(function(event) {
									if(event.keyCode == 13) { 
									textboxes = $("input.text");
									debugger;
									currentBoxNumber = textboxes.index(this);
									if (currentBoxNumber < 1) {
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
								$('#brand').change(function() {
									        var querystring = {
											brand: $(this).val(),
											action: 'findmodelBybrand'
										}
										$.get('index.php', querystring, processResponse);
										function processResponse(result) {
											var obj1 = $.parseJSON(result);
											//var options = '';
												var abc = '';
												$("#buyerTable").find("tr:gt(0)").remove();
												for (var i = 0; i < obj1.length; i++) {
													abc ='<tr id="' + obj1[i].id +'"><td>' + (i+1) + '</td><td>' + obj1[i].brand + '</td><td>' + obj1[i].model +'</td><td>' + obj1[i].details +'</td></tr>';
													$('#buyerTable tr:last').after(abc);
												}											
										} // end processData
								});
								}); 
								</script>
								<div id="confirm" title="Confirm Destruction"></div>
                                    <ul id="message" class="system_messages">
                                        <li class="blue"><span class="ico"></span><strong class="system_title">Enter Data and  press "Add Details" Button</strong></li>
                                    </ul>
                                    <form name="add_form" method="post" id="add_form" action="index.php" class="add_form"> 
                                        <input type="hidden" name="action" value="add_model_record" />
										<input type="hidden" name="id" id="id" value="0" />
                                        <div><label for="brand" class="label">Vehicle Brand :</label>
										<select name="brand" id="brand">
                                                                <option value=""></option>
                                                                <?php foreach ($brands as $cat) { ?>
                                                                    <option value="<?php echo $cat['brand']; ?>">
                                                                        <?php echo $cat['brand']; ?>
                                                                    </option>
                                                                <?php } ?>
                                                            </select></div>
										<div><label for="model" class="label">Vehicle Modle :</label><input type="text" class="text" name="model"  id="model" style="width:300px"/></div>
										<div><label for="details" class="label">Details :</label><input type="text" class="text" name="details"  id="details" style="width:300px"/></div>
										<div><input type="submit" name="submit" id="submit" value="Add Details"></div>
										<div><input type="submit" name="submit" id="update" value="Delete Details"></div>										
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
															<th>Brand</th>
															<th>Model</th>
															<th>Details</th>															
														</tr>
														<?php $i = 1; ?>
														<?php foreach($exps as $exp) { ?>																
														<tr id="<?php echo $exp['id']; ?>" class=<?php if ($i % 2) {
																		echo "first";
																		} else {
																		echo "second";
																		}?>>
															<td><?php echo $i; ?></td>
															<td><?php echo $exp['brand']; ?></td>
															<td><?php echo $exp['model']; ?></td>
															<td><?php echo $exp['details']; ?></td>															
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











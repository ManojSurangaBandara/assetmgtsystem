<?php
include '../view/header6.php';
?>
<div id="sec_menu">
    <?php include("sub_menu.tpl"); ?>
</div>
<div id="page">
    <div class="inner">
        <div class="section">
            <div class="title_wrapper">
                <h2>
                    ADD - ORBAT - SF
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
										"sf": {
											required: true
										}
									},
									//perform an AJAX post to ajax.php
									submitHandler: function() {
										var formData = $("#add_form").serialize();
										$.post('index.php', formData, processData).error(errorResponse);
										function processData(data) {
											if (data=='1') {
												$('#message').html('<li class="green"><span class="ico"></span><strong class="system_title">Data Successfully Saved.</strong></li>');
												abc ='<tr id="' + $('#sf').val() + '"><td>' + "New" + '</td><td>' + $('#sf').val() + '</td></tr>';
												$('#buyerTable tr:first').after(abc);
											} else if (data=='3') { 
												$('#message').html('<li class="red"><span class="ico"></span><strong class="system_title">Code Number Already Entered</strong></li>');
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
								$('#sf').focus(function() {
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
											$('#code').val(data);
										} else if (i == 3) {
											$('#level').val(data);
										}
									});
									
								});

								$("#update").click(
								function(e) {
									$("#confirm").html("<p>Are you sure you want to Delete this record? " + $('#code').val() + "</p>");
									var code=$('#code').val();												
									$("#confirm").dialog({
									resizable: false,
									modal: true,
									height: 150,
									width: 400,								
									buttons: {
									"Confirm": function () {
										var querystring = {
														code: code,
														action: 'delete_sf_details'
													}
													$.get('index.php', querystring, processResponse);
													function processResponse(data) {
														if (data=='1') {
															$('#message').html('<li class="green"><span class="ico"></span><strong class="system_title">Data Successfully Deleted.</strong></li>');
															$('#' + id).remove();
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
									
								});
		function getTableData_sf() {
        var querystring = {
            action: 'getLastCountID_Ajax'
        }
        $.get('index.php', querystring, processResponse);
        function processResponse(result) {
            var numbers = $.parseJSON(result);
            var option = '<option></option>';
            for (var i = 0; i < numbers.length; i++) {
                option += '<option value="' + numbers[i] + '">' + numbers[i] + '</option>';
            }
            $('#gsDivision').html(option);
            $('#gsDivision option[value="' + gs + '"]').attr('selected', 'selected');
        } // end processData
    };
								$('#update').hide();
								$(".text").keypress(function(event) {
									if(event.keyCode == 13) { 
										$("#submit").focus();
										event.preventDefault();
										return false 
									}
								});
								}); 
								</script>
								<div id="confirm" title="Confirm Destruction"></div>
                                    <ul id="message" class="system_messages">
                                        <li class="blue"><span class="ico"></span><strong class="system_title">Enter Data and  press "Add Details" Button</strong></li>
                                    </ul>
                                    <form name="add_form" method="post" id="add_form" action="index.php" class="add_form"> 
                                        <input type="hidden" name="action" value="add_sf_record" />
										<input type="hidden" name="id" id="id" value="0" />
                                        <div><label for="sf" class="label">SF :</label><input type="text" class="text" name="code"  id="code" style="width:250px"/></div>
										<div><label for="level" class="label">Level :</label><input type="text" class="text" name="level"  id="level" style="width:50px"/></div>
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
															<th>Sno</th>
															<th>SF</th>
															<th>Level</th>
														</tr>
														<?php $i = 1; ?>
														<?php foreach($exps as $exp) { ?>																
														<tr id="<?php echo $exp['id']; ?>">
															<td><?php echo $i; ?></td>
															<td><?php echo $exp['code']; ?></td>
															<td><?php echo $exp['level']; ?></td>
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











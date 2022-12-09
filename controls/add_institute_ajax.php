<?php
include '../view/header1.php';
?>
<div id="sec_menu">
    <?php include("sub_menu.tpl"); ?>
</div>
<div id="page">
    <div class="inner">
        <div class="section">
            <div class="title_wrapper">
                <h2>
                    ADD - Institutes
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
											function showComment(){											
												$.ajax({url:"index.php",data:"action=showcomment",success:function(result){
												var obj1 = $.parseJSON(result);
												var options = '';
												var abc = '';
												for (var i = 0; i < obj1.length; i++) {
													abc ='<tr><td>' + (i+1) + '</td><td>' + obj1[i].instName + '</td><td>' + obj1[i].instAddress +'</td><td>' + obj1[i].instTele +'</td><td>' + obj1[i].instEmail +'</td><td><input type="button" value="Delete" id="' + obj1[i].id + '"></td></tr>';
													$('#newtable tr:last').after(abc);
												}
												}});
											}
											/*function delItem(id){
												var querystring = {
													id: id,
													action: 'delcomment'
												}
												$.get('index.php', querystring, processResponse);
												function processResponse(data) {
													if (data=='1') {
														$('#message').html('<li class="green"><span class="ico"></span><strong class="system_title">Data Successfully Deleted.</strong></li>');
													} else {
														$('#message').html('<li class="red"><span class="ico"></span><strong class="system_title">Data sss Error. Please Check Data !</strong></li>');
													}
													showComment();
													} // end processData
											} */
											showComment();		
											$(document).ready(function () {
										/*	  $('#confirm').dialog({
  modal: true,
  autoOpen: false,
  buttons: {
  "Confirm" : function() {

  $(this).dialog('close');
},
"Cancel": function() {
$(this).dialog('close');
}
}
}); */

												$('table').on('click', 'input[type="button"]', function(e){
												    $("#confirm").html("<p>Are you sure you want to Delete this record?</p>");
												var id=this.id;												
												$("#confirm").dialog({
        resizable: false,
        modal: true,
        height: 250,
        width: 400,
        buttons: {
            "Confirm": function () {
                $(this).dialog('close');
				var querystring = {
													id: id,
													action: 'delcomment'
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
											
											$(':text:first').focus();
											//validation rules
											$("#add_form").validate({
												rules: {
													"instName": {
														required: true
													},  
													"instAddress": {
														required: true
													},
													"instEmail": {
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
														} else {
															$('#message').html('<li class="red"><span class="ico"></span><strong class="system_title">Data Error. Please Check Data !</strong></li>');
														}
														$("#delTable").find("tr:gt(0)").remove();
														showComment();
													} // end processData
													function errorResponse() {
														$('#message').html('<li class="red"><span class="ico"></span><strong class="system_title">Error when Database Writing !</strong></li>');
														}
													return false;
												}
											});
											$('#instName').focus(function() {
                                               $('#message').html('<li class="blue"><span class="ico"></span><strong class="system_title">Enter Data and  press "Add Details" Button</strong></li>'); 
                                            });		
										});
										</script>
										<div id="confirm" title="Confirm Destruction"></div>
										   <ul id="message" class="system_messages">
												<li class="blue"><span class="ico"></span><strong class="system_title">Enter Data and  press "Add Details" Button</strong></li>
											</ul>
									<p></p>
										   <form name="add_form" id="add_form" class="add_form"> 
                                                <input type="hidden" name="action" value="addcomment" />
                                                 <div>  
                                                    <label for="name" class="label">Name :</label>
                                                    <input type="text" name="instName"  id="instName"  class="required" title="Please type your name." style="width:300px" placeholder="Institute name" required/>
                                                 </div>
												<div> 												  
													<label for="instAddress" class="label">Address :</label>
													<input type="text" class="required" name="instAddress"  id="instAddress" style="width:300px" placeholder="Institute Address" required/>
												</div>
												<div> 
													<label for="instTele" class="label">Telephone :</label>
													<input type="text" class="text" name="instTele"  id="instTele" style="width:300px" placeholder="Telephone Number"/>
												</div>
												<div> 
													<label for="instEmail" class="label">E-Mail Address :</label>
													<input type="email" name="instEmail"  id="instEmail" style="width:300px" placeholder="Email Address"/>
											   </div>
											   <div>
													<input type="submit" name="submit" id="submit" value="Add Institute Details">
												</div> 
											</form>	
											<div class="table_wrapper" id="newtable">
												<div class="table_wrapper_inner">
													<table id = "delTable" cellpadding="0" cellspacing="0" width="100%" >
														<tbody><tr>
															<th>&nbsp;</th>
															<th>Name</th>
															<th>Address</th>
															<th>Telephone</th>
															<th>E-Mail</th>
														</tr>
													  </tbody>
													</table>
												</div>
											</div>
											
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

<?php
include '../view/header1.php';
?>
<div id="sec_menu">
    <?php include("sub_menu.tpl"); ?>
</div>
<script>
    $(document).ready(function () {
       $('.date').datepicker({dateFormat: 'yy-mm-dd',
        maxDate: '0',
		changeMonth : true,
        changeYear: true});

	$('#classification').change(function() {
        $('#type').val($(this).val());
		var querystring = {
            classification: $(this).val(),
            action: 'findmainCategory'
        }
        $.get('index.php', querystring, processResponse);
        function processResponse(result) {
			var numbers = $.parseJSON(result);
            var option = '<option></option>';
            for (var i = 0; i < numbers.length; i++) {
                option += '<option value="' + numbers[i] + '">' + numbers[i] + '</option>';
            }
            $('#mainCategory').html(option);
        } // end processData
    });

	$('#mainCategory').change(function() {
		var querystring = {
            type:$('#type').val(),
			mainCategory: $(this).val(),
            action: 'finditemCategory'
        }
        $.get('index.php', querystring, processResponse);
        function processResponse(result) {
			var numbers = $.parseJSON(result);
            var option = '<option></option>';
            for (var i = 0; i < numbers.length; i++) {
                option += '<option value="' + numbers[i] + '">' + numbers[i] + '</option>';
            }
            $('#itemCategory').html(option);
        } // end processData
    });	

	$('#itemCategory').change(function() {
		var querystring = {
            type:$('#type').val(),
			mainCategory:$('#mainCategory').val(),
			itemCategory: $(this).val(),
            action: 'finditemDescription'
        }
        $.get('index.php', querystring, processResponse);
        function processResponse(result) {
			var numbers = $.parseJSON(result);
            var option = '<option></option>';
            for (var i = 0; i < numbers.length; i++) {
                option += '<option value="' + numbers[i] + '">' + numbers[i] + '</option>';
            }
            $('#itemDescription').html(option);
        } // end processData
    });	
	
	$('#itemDescription').change(function() {
		var querystring = {
            type:$('#type').val(),
			mainCategory:$('#mainCategory').val(),
			itemCategory:$('#itemCategory').val(),
			itemDescription: $(this).val(),
            action: 'findcatalogueno'
        }
        $.get('index.php', querystring, processResponse);
        function processResponse(result) {
			var numbers = $.parseJSON(result);
            var option = '<option></option>';
            for (var i = 0; i < numbers.length; i++) {
                option += '<option value="' + numbers[i] + '">' + numbers[i] + '</option>';
            }
            $('#catalogueno').html(option);
        } // end processData
    });
	
		$('#catalogueno').change(function() {
		var querystring = {
            type:$('#type').val(),
			catalogueno: $(this).val(),
            action: 'findassetsno'
        }
        $.get('index.php', querystring, processResponse);
        function processResponse(result) {
			var numbers = $.parseJSON(result);
            $('#assetsno').val(numbers[0]);
			$('#newAssestno').val(numbers[1]);
        } // end processData
    });
	
		$("#add_form").validate({
            submitHandler: function () {
                var formData = $("#add_form").serialize();
				$.post('index.php', formData, processData).error(errorResponse);
                function processData(data) {
					if (data == '1') {
                        setMessage(data);
						populatetable($('#fileno').val());
                    } else if (data == '3') {
                        setMessage(data);						
                    } else {
                        setMessage(data);
                    }
                } // end processData
                function errorResponse() {
                    setMessage(6);
                }
                return false;
            }
        });

	    function showSidebar(id) {
         var querystring = {
            id: id,
            action: 'showSidebar'
        }
		$.get('index.php', querystring, processResponse);
		function processResponse(result) {
				$('#sidebar1').empty();
                var item = $.parseJSON(result);
                var options = '';
                $.each(item, function(key, value) {
                    $("#sidebar1").append('<li id="' + value.id + '"><a href="#">' + value.fileno + '</a></li>');
                });
        } // end processData
    }	
	
    $('#sidebar1').delegate('li', 'click', function() {
        $("html, body").animate({scrollTop: 0}, "slow");
		var id = $(this).attr('id');
		var text = $(this).text();
				$('#fileno').val(text);
				$('#id').val(id);
				$('#fileno1').text(text);
				populatetable(text);
/* 		var querystring = {
                id: id,
                action: 'getDetailsById'
            }
            $.get('index.php', querystring, processResponse);
            function processResponse(result) {
				var obj1 = $.parseJSON(result);
				$('#fileno').val(obj1.fileno);
				$('#id').val(obj1.id);
				$('#fileno1').text(obj1.fileno);
				setMessage(4);
             } */
    });	

	
function populatetable(fileno)
        {
            var querystring = {
                fileno: fileno,
				action: 'get_file_table'
            }
            $.get('index.php', querystring, processResponse);
            function processResponse(result) {
				var data = $.parseJSON(result);
				$('#buyerTable tr').not(':first').remove();
                var i = 1;
                $.each(data, function (key, value) {
                    html = '<tr id="' + value.id + '"><td>' + i +
                            '</td><td>' + value.itemDescription +
                            '</td><td>' + value.catalogueno +
                            '</td><td>' + value.eqptSriNo +
							'</td><td>' + value.identificationno +
							'</td><td>' + value.value +
                            '</td><td><input type="button" class="delbtn" value="Delete" id="' + value.id + '"></td></tr>';
                    $('#buyerTable tr:last').after(html);
                    i++;
                });
            }
        }
 	
$(document).on("click", ".delbtn", function() {
					var id = $(this).attr('id');
					if (id != 0) {
                        $("#confirm").html("<p>Are you sure, You want to Delete this record?</p>");
						$("#confirm").dialog({
                            buttons: {
                                "Confirm": function () {
                                    var querystring = {
                                        id: id,
                                        action: 'delete_file_table'
                                    }
                                    $.get('index.php', querystring, processResponse);
                                    function processResponse(data) {
										if (data == '1') {
											populatetable($('#fileno').val());
                                        }
                                    } // end processData													
                                    $(this).dialog('close');
                                },
                                "Cancel": function () {
                                    $(this).dialog('close');
                                }
                            }
                        });
                        return false;
                    }
                });
	
        function setMessage(err)
        {
            switch (parseInt(err)) {
                case 0:
					$('#message').html('<li class="blue"><span class="ico"></span><strong class="system_title">Enter Data and  press "Add Details" Button</strong></li>');
					break;
				case 1:
                    $('#message').html('<li class="green"><span class="ico"></span><strong class="system_title">Data Successfully Saved.</strong></li>');
                    break;
                case 2:
                    $('#message').html('<li class="green"><span class="ico"></span><strong class="system_title">Data Successfully Updated.</strong></li>');
                    break;
                case 3:
                    $('#message').html('<li class="red"><span class="ico"></span><strong class="system_title">Data Error. Please Check Data !</strong></li>');
                    break;
                case 4:
                    $('#message').html('<li class="blue"><span class="ico"></span><strong class="system_title">Modify Data and Press Update Details Button.</strong></li>');
                    break;
                case 5:
                    $('#message').html('<li class="red"><span class="ico"></span><strong class="system_title">Data Error. Please Check Data !</strong></li>');
                    break;
                case 6:
                    $('#message').html('<li class="red"><span class="ico"></span><strong class="system_title">Error when Database Writing !</strong></li>');
                    break;
				case 7:
                    $('#message').html('<li class="green"><span class="ico"></span><strong class="system_title">Data Successfully Deleted.</strong></li>');
                    break;
				case 8:
                    $('#message').html('<li class="red"><span class="ico"></span><strong class="system_title">Data Error. Please Check Data !</strong></li>');
                    break;
				default:
					$('#message').html('<li class="red"><span class="ico"></span><strong class="system_title">Error when Database Writing !</strong></li>');
            }
        }
		showSidebar(0);
		setMessage(0);
    });
function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode != 46 &&(charCode < 48 || charCode > 57)))
        return false;
    return true;
}
</script>
<style>
form#add_form .label{
	display: block;
	clear: left;
	float: left;
	width: 350px;
	text-align: right;
	padding: 7px 15px 0 0;	
	font-weight: bold;
	color: darkblue;
	font-size: 17px;
}
input { font-size: 16px; }
</style>
<div id="page">
    <div class="inner">
		        <div class="section">
            <div class="title_wrapper">
                <h2>
					කපාහරින ලද විස්තර ලයිස්තුව  : - <span id="fileno1"></span>
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
                                    <div id="confirm" title="Confirm Delete"></div>
                                    <ul id="message" class="system_messages">                                        
                                    </ul>
                                    <form name="add_form" method="post" id="add_form" action="index.php" class="add_form"> 
                                        <input type="hidden" name="action" value="add_loss_damage_details" />
										<input type="hidden" name="fileno" id="fileno" value="" />
										<input type="hidden" name="type" id="type" value="0" />
                                        <input type="hidden" name="id" id="id" value="0" /> 
                                        <div><label for="name" class="label">වත්කම් වර්ගීකරණය  :</label>
										<select name="classification" id="classification">
												<option value=""></option>
                                                <option value="1">Office Equipments</option>
												<option value="2">Plant & Machinery</option>
												<option value="3">Vehicles</option>
                                            </select></div> 
										<div><label for="name" class="label">ප්‍රධාන ප්‍රවර්ගය  :</label>
										<select name="mainCategory" id="mainCategory">
                                                <option value=""></option>
                                        </select>
										</div> 
										<div><label for="name" class="label">භාන්ඩයේ ප්‍රවර්ගය :</label>
										<select name="itemCategory" id="itemCategory">
                                                <option value=""></option>
                                        </select>
										</div>
										<div><label for="name" class="label">භාන්ඩයේ විස්තරය :</label>
										<select name="itemDescription" id="itemDescription">
                                                <option value=""></option>
                                        </select>
										</div>
										<div><label for="name" class="label">නාමාවලි අංකය :</label>
										<select name="catalogueno" id="catalogueno">
                                                <option value=""></option>
                                        </select>
										</div>
										<div><label for="name" class="label">වත්කම් / වර්ගීකරණ අංක :</label><input type="text" class="text" name="assetsno"  id="assetsno" style="width:100px"/><input type="text" class="text" name="newAssestno"  id="newAssestno" style="width:100px"/></div>
										<div><label for="name" class="label">භාණ්ඩයේ අනුක්‍රමික අංකය :</label><input type="text" class="text" name="eqptSriNo"  id="eqptSriNo" style="width:400px"/></div>
										<div><label for="name" class="label">වත්කම් හදුනාගැනීමේ අංකය :</label><input type="text" class="text" name="identificationno"  id="identificationno" style="width:400px"/></div>
										<div><label for="name" class="label">කපාහරින වටිනාකම :</label><input type="text" class="text" name="value"  id="value" style="width:150px; text-align:right;" onkeypress="return isNumberKey(event)"/></div>
										<div><input type="submit" name="submit" id="submit" value="Add Details"></div> 			
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
                                        <th>භාන්ඩයේ විස්තරය</th>
                                        <th>නාමාවලි අංකය</th>
                                        <th>භාණ්ඩයේ අනුක්‍රමික අංකය</th>
                                        <th>වත්කම් හදුනාගැනීමේ අංකය</th>
                                        <th>කපාහරින වටිනාකම</th>
                                        <th></th>											
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
<?php
include('sidebar.php');
include '../view/footer.php';
?>











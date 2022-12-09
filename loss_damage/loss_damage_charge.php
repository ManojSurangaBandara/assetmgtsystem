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

		$("#add_form").validate({
            submitHandler: function () {
                var formData = $("#add_form").serialize();
				$.post('index.php', formData, processData).error(errorResponse);
                function processData(data) {
                    if (data == '1') {
                        setMessage(data);
                        populatetable($('#fileno').val());
                        clearForm()
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
                clearForm()
    });	

	
function populatetable(fileno)
        {
            var querystring = {
                fileno: fileno,
				action: 'get_file_table_charge'
            }
            $.get('index.php', querystring, processResponse);
            function processResponse(result) {
				var data = $.parseJSON(result);
				$('#buyerTable tr').not(':first').remove();
                var i = 1;
                $.each(data, function (key, value) {
                    html = '<tr id="' + value.id + '"><td>' + i +
                            '</td><td>' + value.number +
                            '</td><td>' + value.rank +
                            '</td><td>' + value.name +
							'</td><td>' + value.unit +
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
                                        action: 'delete_file_table_charge'
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
function clearForm(){
    $('#number').val("");
    $('#rank').val("");
    $('#name').val("");
    $('#unit').val("");
    $('#value').val("");
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
.delbtn {
  background-color: #f44336; 
  color: white;
  padding: 5px 5px;
  text-align: center;
  text-decoration: none;
  font-size: 16px;
}
#buyerTable tr td { font-size: 16px; }
#buyerTable tr th { font-size: 18px; }
</style>
<div id="page">
    <div class="inner">
		        <div class="section">
            <div class="title_wrapper">
                <h2>
                අයකිරීම් පිළිබඳ විස්තර  : - <span id="fileno1"></span>
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
                                        <input type="hidden" name="action" value="add_loss_damage_charge_details" />
										<input type="hidden" name="fileno" id="fileno" value="" />
										<input type="hidden" name="type" id="type" value="0" />
                                        <input type="hidden" name="id" id="id" value="0" /> 
										<div><label for="name" class="label">රෙජිමේන්තු අංකය :</label><input type="text" class="text" name="number"  id="number" style="width:100px"/></div>
										<div><label for="name" class="label">නිලය :</label><input type="text" class="text" name="rank"  id="rank" style="width:100px"/></div>
										<div><label for="name" class="label">නම:</label><input type="text" class="text" name="name"  id="name" style="width:400px"/></div>
                                        <div><label for="name" class="label">ඒකකය:</label><input type="text" class="text" name="unit"  id="unit" style="width:400px"/></div>
                                        <div><label for="name" class="label">අයකරනලද වටිනාකම :</label><input type="text" class="text" name="value"  id="value" style="width:150px; text-align:right;" onkeypress="return isNumberKey(event)"/></div>
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
                                        <th>රෙජිමේන්තු අංකය</th>
                                        <th>නිලය</th>
                                        <th>නම</th>
                                        <th>ඒකකය</th>
                                        <th>අයකරනලද වටිනාකම</th>
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
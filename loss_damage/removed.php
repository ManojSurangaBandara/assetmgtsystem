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
		var querystring = {
                id: id,
                action: 'getDetailsById'
            }
            $.get('index.php', querystring, processResponse);
            function processResponse(result) {
				var obj1 = $.parseJSON(result);
				$('#fileno').text(obj1.fileno);
				$('#removeddate').val(obj1.removeddate == '0000-00-00' ? "" : obj1.removeddate);
				$('#removedvalue').val(obj1.removedvalue == '0000-00-00' ? "" : obj1.removedvalue);
				$('#id').val(obj1.id);
				setMessage(4);
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
					කපාහරින ලද විස්තර :  -  <span id="fileno"></span>
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
                                    </ul>
                                    <form name="add_form" method="post" id="add_form" action="index.php" class="add_form"> 
                                        <input type="hidden" name="action" value="add_removed" />
                                        <input type="hidden" name="id" id="id" value="0" />
										<input type="hidden" name="type" id="type" value="0" />
										<div><label for="name" class="label">කපාහරින ලද දිනය  :</label><input type="text" class="date" name="removeddate"  id="removeddate" style="width:100px"/></div>
										<div><label for="name" class="label">කපාහරින ලද වටිනාකම :</label><input type="text" class="text" name="removedvalue"  id="removedvalue" style="width:150px; text-align:right;" onkeypress="return isNumberKey(event)"/></div>
										<div><input type="submit" name="submit" id="submit" value="Add Details"></div> 			
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











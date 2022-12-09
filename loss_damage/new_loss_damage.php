<?php
include '../view/header1.php';
?>
<div id="sec_menu">
    <?php include("sub_menu.tpl"); ?>
</div>
<style>
input { font-size: 16px; }
label {font-size: 15px;}
</style>
<script>
    $(document).ready(function () {
       $('.date').datepicker({dateFormat: 'yy-mm-dd',
        maxDate: '0',
		changeMonth : true,
        changeYear: true});

    $('#assetscenter').change(function() {
        getAsstUnit($(this).val(), "");
    });
    function getAsstUnit(assetscenter, assetunit)
    {
        var querystring = {
            center: assetscenter,
            action: 'findAssetsUnitsByCenter_Ajax'
        }
        $.get('index.php', querystring, processResponse);
        function processResponse(result) {
            var numbers = $.parseJSON(result);
            var option = '<option></option>';
            for (var i = 0; i < numbers.length; i++) {
                option += '<option value="' + numbers[i] + '">' + numbers[i] + '</option>';
            }
            $('#assetunit').html(option);
            $('#assetunit option[value="' + assetunit + '"]').attr('selected', 'selected');
        } // end processData
    };		
		
		$("#add_form").validate({
			rules: {
                "fileno": {
                    required: true
                },
                "assetunit": {
                    required: true
                }
            },
            submitHandler: function () {
                $(':text:first').focus();
                var formData = $("#add_form").serialize();
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
                    setMessage(6);
                }
                return false;
            }
        });
        $('#fileno').on('keyup keypress change', function(e) {
			$("#id").val("0");
            $("#submit").prop('value', 'Add Details');
            $('#update').hide();
			setMessage(0);
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
                $('#fileno').val(obj1.fileno);
                $('#assetscenter').val(obj1.assetscenter);
				getAsstUnit(obj1.assetscenter, obj1.assetunit);
				$('#place').val(obj1.place);
				$('#date').val(obj1.date);
				$('#time').val(obj1.time);
				$('#goods').val(obj1.goods);
				$('#value').val(obj1.value);
				$('#description').val(obj1.description);
				$('#letter1').val(obj1.letter1);
				$('#letter1date').val(obj1.letter1date);
				$('#id').val(obj1.id);
                $("#submit").prop('value', 'Update Details');
                $('#update').show();
				setMessage(4);
             }
    });	

	function clearForm() {
		$('#fileno').val("");
		$('#assetscenter').val("");
		getAsstUnit("", "");
		$('#place').val("");
		$('#date').val("");
		$('#time').val("");
		$('#goods').val("");
		$('#value').val("");
		$('#description').val("");
		$('#letter1').val("");
		$('#letter1date').val("");
		$('#id').val("");
    };
	
	$("#update").click(
                function (e) {
                    if ($('#id').val() != 0) {
                        $("#confirm").html("<p>Are you sure you want to Delete this record? " + $('#fileno').val() + "</p>");
                        var id = $('#id').val();
                        $("#confirm").dialog({
                            resizable: false,
                            modal: true,
                            height: 150,
                            width: 400,
                            buttons: {
                                "Confirm": function () {
                                    var querystring = {
                                        id: id,
                                        action: 'deleteRecordByid'
                                    }
                                    $.get('index.php', querystring, processResponse);
                                    function processResponse(data) {
                                        if (data == '1') {
                                            setMessage(7);
                                            $("#id").val("0");
                                            $("#submit").prop('value', 'Add Details');
                                            $('#update').hide();
											showSidebar(0);
                                        } else {
                                            setMessage(8);
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
                    }
                });

        $(".text").keypress(function (event) {
            if (event.keyCode == 13) {
                textboxes = $("input.text");
                debugger;
                currentBoxNumber = textboxes.index(this);
                if (currentBoxNumber < 5) {
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
                    $('#message').html('<li class="red"><span class="ico"></span><strong class="system_title">File Number Already Entered</strong></li>');
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
        $('#update').hide();
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
<div id="page">
    <div class="inner">
        <div class="section">
            <div class="title_wrapper">
                <h2>
                    ADD - New File
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
                                        <input type="hidden" name="action" value="add_loss_damage" />
                                        <input type="hidden" name="id" id="id" value="0" />
                                        <div><label for="code" class="label">ලිපිගොනු අංකය :</label><input type="text" class="text" name="fileno"  id="fileno" style="width:300px"/></div>
                                        <div><label for="code" class="label">පාලන මූලය  :</label>
                                            <select name="assetscenter" id="assetscenter">
                                                <option value=""></option>
                                                <?php foreach ($assetsCenters as $center) { ?>
                                                    <option value="<?php echo $center->getName(); ?>" <?php if ($assetscenter == $center->getName()) echo "selected = 'selected'"; ?>>
                                                <?php echo $center->getName(); ?>
                                                    </option>
												<?php } ?>
                                            </select>										
										</div>
										<div><label for="name" class="label">ඒකකය :</label>                                            
												<select name="assetunit" id="assetunit">
                                                <option value=""></option>
                                                <?php foreach ($assetunits as $unit) { ?>
                                                    <option value="<?php echo $unit->getName(); ?>" <?php if ($assetunit == $unit->getName()) echo "selected = 'selected'"; ?>>
                                                <?php echo $unit->getName(); ?>
                                                    </option>
<?php } ?>
                                            </select>
                                                        </div>
                                        <div><label for="name" class="label">ස්ථානය :</label><input type="text" class="text" name="place"  id="place" style="width:300px"/></div>
                                        <div><label for="name" class="label">දිනය /වේලාව :</label><input type="text" class="date" name="date"  id="date" style="width:100px"/><input type="text" class="text" name="time"  id="time" style="width:100px"/></div>
										<div><label for="name" class="label">විස්තරය:</label><textarea rows="5" name="goods" id="goods" style="width:500px"></textarea></div>
										<div><label for="name" class="label">භාන්ඩයන්හි කිට්ටුම වටිනාකම :</label><input type="text" class="text" name="value"  id="value" style="width:150px; text-align:right;" onkeypress="return isNumberKey(event)"/></div>
										<div><label for="name" class="label">නැතිවූ ආකාරය :</label>
										<select name="description" id="description">
												<option value=""></option>
                                                <option value="1">අසාමාන්‍ය සිදුවීම්</option>
												<option value="2">ත්‍රස්තවාදී ප්‍රහාර</option>
                                            </select>
										</div>
										<div><label for="name" class="label">ලිපියේ අංකය :</label><input type="text" class="text" name="letter1"  id="letter1" style="width:300px"/></div>
										<div><label for="name" class="label">ලිපිය ලද දිනය :</label><input type="text" class="date" name="letter1date"  id="letter1date" style="width:100px"/></div>
										<div><input type="submit" name="submit" id="submit" value="Add Details"> <input type="checkbox" name="clearform" id="clearform" checked> <label>Clear Form After Save</label></div>
                                        <div><input type="submit" name="submit" id="update" value="Delete Details"></div>										
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











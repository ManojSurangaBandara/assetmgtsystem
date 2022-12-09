<?php
include 'header1.php';
?>
<script>
    $(document).ready(function () {
        									$('.date').datepicker({dateFormat: 'yy-mm-dd',
										changeMonth : true,
										changeYear: true});
									var d = new Date();
									var month = d.getMonth()+1;
									var day = d.getDate();
									var output = d.getFullYear() + '-' +
										(month<10 ? '0' : '') + month + '-' +
										(day<10 ? '0' : '') + day;
		
		
		
		$("#add_form").validate({
            rules: {
                "code": {
                    required: true
                },
                "name_english": {
                    required: true
                }
            },
            //perform an AJAX post to ajax.php
            submitHandler: function () {
                $(':text:first').focus();
                var formData = $("#add_form").serialize();
                $.post('index.php', formData, processData).error(errorResponse);
                function processData(data) {
                    if (data == '1') {
                        setMessage(data);
                        populatetable();
                    } else if (data == '2') {
                        $('#' + $('#id').val()).remove();
                        setMessage(data);
                        $("#id").val("0");
                        $("#submit").prop('value', 'Add Details');
                        $('#update').hide();
                    } else if (data == '3') {
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
        $('#code').focus(function () {
            $('#message').html('<li class="blue"><span class="ico"></span><strong class="system_title">Enter Data and  press "Add Details" Button</strong></li>');
        });
        $('tr').dblclick(function () {
            $("html, body").animate({scrollTop: 0}, "slow");
            var id = $(this).attr('id');
            var querystring = {
                id: id,
                action: 'get_places_detail'
            }
            $.get('index.php', querystring, processResponse);
            function processResponse(result) {
                var obj1 = $.parseJSON(result);
                $('#code').val(obj1.code);
                $('#name').val(obj1.name);
                $("#submit").prop('value', 'Update Details');
                $('#update').show();
                $('#message').html('<li class="blue"><span class="ico"></span><strong class="system_title">Enter Data and  press "Update Details" Button</strong></li>');
            }
        });
        $("#update").click(
                function (e) {
                    if ($('#id').val() != 0) {
                        $("#confirm").html("<p>Are you sure you want to Delete this record? " + $('#name').val() + "</p>");
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
                                        action: 'delete_places_details'
                                    }
                                    $.get('index.php', querystring, processResponse);
                                    function processResponse(data) {
                                        if (data == '1') {
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
                    }
                });
        $('#update').hide();
        $(".text").keypress(function (event) {
            if (event.keyCode == 13) {
                textboxes = $("input.text");
                debugger;
                currentBoxNumber = textboxes.index(this);
                if (currentBoxNumber < 3) {
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
                case 1:
                    $('#message').html('<li class="green"><span class="ico"></span><strong class="system_title">Data Successfully Saved.</strong></li>');
                    break;
                case 2:
                    $('#message').html('<li class="green"><span class="ico"></span><strong class="system_title">Data Successfully Updated.</strong></li>');
                    break;
                case 3:
                    $('#message').html('<li class="red"><span class="ico"></span><strong class="system_title">Place Code Number Already Entered</strong></li>');
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
            }
        }
    });
</script>
<div id="page">
    <div class="inner">
        <div class="section">
            <div class="title_wrapper">
                <h2>
                    ADD - Board of Survay Schedule 
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
                                        <input type="hidden" name="action" value="Add_surveyyear_schedule_record" />
                                        <input type="hidden" name="id" id="id" value="0" />
                                        <div><label for="code" class="label">Year :</label><input type="text" class="text" name="year"  id="year" value="<?php echo $survayyear;?>" style="width:75px"/ readonly></div>
                                        <div><label for="name" class="label">Verfication Board - Appoint :</label><input type="text" name="ver_brd_app" id="ver_brd_app" value="<?php echo $ver_brd_app = ($exp['ver_brd_app'] == '0000-00-00') ? '' : $exp['ver_brd_app'];?>" class="date" style="width:75px"></div>
                                        <div><label for="name" class="label">Verfication Board - Receive :</label><input type="text" name="ver_brd_rec" id="ver_brd_rec" value="<?php echo $ver_brd_rec = ($exp['ver_brd_rec'] == '0000-00-00') ? '' : $exp['ver_brd_rec'];?>" class="date" style="width:75px"></div>
                                        <div><label for="name" class="label">Verfication Board - Approve :</label><input type="text" name="ver_brd_approved" id="ver_brd_approved" value="<?php echo $ver_brd_approved = ($exp['ver_brd_approved'] == '0000-00-00') ? '' : $exp['ver_brd_approved'];?>" class="date" style="width:75px"></div>
                                        <div><label for="name" class="label">Condemnation Board - Appoint :</label><input type="text" name="con_brd_app" id="con_brd_app" value="<?php echo $con_brd_app = ($exp['con_brd_app'] == '0000-00-00') ? '' : $exp['con_brd_app'];?>" class="date" style="width:75px"></div>
                                        <div><label for="name" class="label">Condemnation Board - Receive :</label><input type="text" name="con_brd_rec" id="con_brd_rec" value="<?php echo $con_brd_rec = ($exp['con_brd_rec'] == '0000-00-00') ? '' : $exp['con_brd_rec'];?>" class="date" style="width:75px"></div>
                                        <div><label for="name" class="label">Condemnation Board - Approve :</label><input type="text" name="con_brd_approved" id="con_brd_approved" value="<?php echo $con_brd_approved = ($exp['con_brd_approved'] == '0000-00-00') ? '' : $exp['con_brd_approved'];?>" class="date" style="width:75px"></div>
                                        <div><label for="name" class="label">Destruction Board - Appoint :</label><input type="text" name="des_brd_app" id="des_brd_app" value="<?php echo $des_brd_app = ($exp['des_brd_app'] == '0000-00-00') ? '' : $exp['des_brd_app'];?>" class="date" style="width:75px"></div>
                                        <div><label for="name" class="label">Destruction Board - Receive :</label><input type="text" name="des_brd_rec" id="des_brd_rec" value="<?php echo $des_brd_rec = ($exp['des_brd_rec'] == '0000-00-00') ? '' : $exp['des_brd_rec'];?>" class="date" style="width:75px"></div>
										<div><input type="submit" name="submit" id="submit" value="Add Details"></div>
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











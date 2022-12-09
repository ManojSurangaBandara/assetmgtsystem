<?php include 'header1.php'; ?>
<script>
    $(document).ready(function () {
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
        $("#code").blur(function () {
            if ($("#code").val() != "") {
                var querystring = {
                    id: $("#code").val(),
                    action: 'get_places_detail_code'
                }
                $.get('index.php', querystring, processResponse);
                function processResponse(result) {
                    var data = $.parseJSON(result);
                    if ($('#code').val() == data.code) {
                        $('#name').val(data.name);
                        $('#id').val(data.id);
                        $("#submit").prop('value', 'Update Details');
                        $('#update').show();
                        $('#message').html('<li class="blue"><span class="ico"></span><strong class="system_title">Enter Data and  press "Update Details" Button</strong></li>');
                    } else {
                        $('#name').val("");
                        $("#id").val("0");
                        $("#submit").prop('value', 'Add Details');
                        $('#update').hide();
                    }
                }
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
        function populatetable()
        {
            var querystring = {
                action: 'get_places_table'
            }
            $.get('index.php', querystring, processResponse);
            function processResponse(result) {
                var data = $.parseJSON(result);
                $('#buyerTable tr').not(':first').not(':last').remove();
                var i = 1;
                $.each(data, function (key, value) {
                    html = '<tr id="' + value.id + '"><td>' + i +
                            '</td><td>' + value.code +
                            '</td><td>' + value.name_english +
                            '</td><td>' + value.name_sinhala +
                            '</td><td>' + value.name_tamil + '</td></tr>';
                    $('#buyerTable tr:last').after(html);
                    i++;
                });
            }
        }
        $('#buyerTable').delegate('tr', 'dblclick', function () {
            $("html, body").animate({scrollTop: 0}, "slow");
            var id = $(this).attr('id');
            var querystring = {
                id: id,
                action: 'get_places_detail'
            }
            $.get('index.php', querystring, processResponse);
            function processResponse(result) {
                var data = $.parseJSON(result);
                $('#code').val(data.code);
                $('#name_english').val(data.name_english);
				$('#name_sinhala').val(data.name_sinhala);
				$('#name_tamil').val(data.name_tamil);
                $("#submit").prop('value', 'Update Details');
                $('#update').show();
				setMessage(4);
            }
        });
        populatetable();
    });
</script>
<div id="page">
    <div class="inner">
        <div class="section">
            <div class="title_wrapper">
                <h2>
                    ADD - Places
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
                                        <input type="hidden" name="action" value="add_places_record" />
                                        <input type="hidden" name="id" id="id" value="0" />
                                        <div><label for="code" class="label">Place Code :</label><input type="text" class="text" name="code"  id="code" style="width:150px"/></div>
                                        <div><label for="name" class="label">Places Name (English) :</label><input type="text" class="text" name="name_english"  id="name_english" style="width:300px"/></div>
                                        <div><label for="name" class="label">Places Name (සිංහල) :</label><input type="text" class="text" name="name_sinhala"  id="name_sinhala" style="width:300px"/></div>
                                        <div><label for="name" class="label">Places Name (தமிழ்) :</label><input type="text" class="text" name="name_tamil"  id="name_tamil" style="width:300px"/></div>
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
                                        <th>Place Code</th>
                                        <th>Places Name (English)</th>
                                        <th>Places Name (සිංහල)</th>
                                        <th>Places Name (தமிழ்)</th>															
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











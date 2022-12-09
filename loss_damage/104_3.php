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

/* 		$("#add_form").validate({
            submitHandler: function () {
                var formData = $("#add_form").serialize();
                $.post('index.php', formData, processData).error(errorResponse);
                function processData(data) {
                    alert(data);
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
        }); */

$("form#add_form").submit(function() {
    var formData = new FormData(this);

    $.ajax({
        url: window.location.pathname,
        type: 'POST',
        data: formData,
        async: false,
        success: function (data) {
			if (data == parseInt(data, 10)) {
			} else {alert(data);}
			if (data == '1') {
				setMessage(data);
			} else if (data == '3') {
				setMessage(data);						
			} else {
				setMessage(data);
			}
        },
        cache: false,
        contentType: false,
        processData: false
    });

    return false;
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
				$('#_1043_recdate').val(obj1._1043_recdate == '0000-00-00' ? "" : obj1._1043_recdate);
				$('#_1043_frbrsenddate').val(obj1._1043_frbrsenddate == '0000-00-00' ? "" : obj1._1043_frbrsenddate);
				$('#_1043_frbrrecdate').val(obj1._1043_frbrrecdate == '0000-00-00' ? "" : obj1._1043_frbrrecdate);
				$('#_1043_comdsecsenddate').val(obj1._1043_comdsecsenddate == '0000-00-00' ? "" : obj1._1043_comdsecsenddate);
				$('#_1043_comdsecrecdate').val(obj1._1043_comdsecrecdate == '0000-00-00' ? "" : obj1._1043_comdsecrecdate);
				$('#_1043_defminsenddate').val(obj1._1043_defminsenddate == '0000-00-00' ? "" : obj1._1043_defminsenddate);
				$('#_1043_defminrecdate').val(obj1._1043_defminrecdate == '0000-00-00' ? "" : obj1._1043_defminrecdate);
				$('#_1043_adviseddate').val(obj1._1043_adviseddate == '0000-00-00' ? "" : obj1._1043_adviseddate);
				$('#_1043_letter').val(obj1._1043_letter);
				if (obj1._1043_letter != "") {
					$("a#_1043_report").show();
					$("a#_1043_report").attr("href", "upload/r1043/"+obj1._1043_letter);
				} else {
					$("a#_1043_report").hide();
				}
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
</style>
<div id="page">
    <div class="inner">
        <div class="section">
            <div class="title_wrapper">
                <h2>
					මු.රෙ. 104(3) යටතේ ප්‍රාරම්භක වාර්තාව  -  <span id="fileno"></span>
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
                                        <input type="hidden" name="action" value="add_104_3" />
                                        <input type="hidden" name="id" id="id" value="0" />
										<input type="hidden" name="_1043_letter" id="_1043_letter" value="" />
										<div><label for="name" class="label">වාර්තා ලද දිනය :</label><input type="text" class="date" name="_1043_recdate"  id="_1043_recdate" style="width:100px"/></div>
										<div><label for="name" class="label">මුකශා වෙත යැවූ දිනය :</label><input type="text" class="date" name="_1043_frbrsenddate"  id="_1043_frbrsenddate" style="width:100px"/></div>
										<div><label for="name" class="label">මුකශා වෙතින් ලද දිනය :</label><input type="text" class="date" name="_1043_frbrrecdate"  id="_1043_frbrrecdate" style="width:100px"/></div>
										<div><label for="name" class="label">හලේකා වෙත යැවූ දිනය :</label><input type="text" class="date" name="_1043_comdsecsenddate"  id="_1043_comdsecsenddate" style="width:100px"/></div>
										<div><label for="name" class="label">හලේකා වෙතින් ලද දිනය :</label><input type="text" class="date" name="_1043_comdsecrecdate"  id="_1043_comdsecrecdate" style="width:100px"/></div>
										<div><label for="name" class="label">රා. ආ. අ. වෙත යැවූ දිනය :</label><input type="text" class="date" name="_1043_defminsenddate"  id="_1043_defminsenddate" style="width:100px"/></div>
										<div><label for="name" class="label">මු.රෙ. 104(4) සඳහා අනුමැතිය ලද දිනය :</label><input type="text" class="date" name="_1043_defminrecdate"  id="_1043_defminrecdate" style="width:100px"/></div>
										<div><label for="name" class="label">උපදෙස් ලබා දුන් දිනය :</label><input type="text" class="date" name="_1043_adviseddate"  id="_1043_adviseddate" style="width:100px"/></div>
										<div><label for="name" class="label">අලාභයන් පිළිබඳ ප්‍රාරම්භක වාර්තාව :</label><input type="file" name="letter"  id="letter"/></div>
										<div><label for="name" class="label"></label><a href="upload/r1043/filename.pdf" target="_blank" name="_1043_report" id="_1043_report" class="btn btn-default" style="color:blue"  hidden>ඇතුලත් කරනලද ප්‍රාරම්භක වාර්ථාව </a></div>
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











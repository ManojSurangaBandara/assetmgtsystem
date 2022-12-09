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
				$('#_109_dirfinsenddate').val(obj1._109_dirfinsenddate == '0000-00-00' ? "" : obj1._109_dirfinsenddate);
				$('#_109_dirfinrecdate').val(obj1._109_dirfinrecdate == '0000-00-00' ? "" : obj1._109_dirfinrecdate);
				$('#_109_frbrsenddate').val(obj1._109_frbrsenddate == '0000-00-00' ? "" : obj1._109_frbrsenddate);
				$('#_109_frbrrecdate').val(obj1._109_frbrrecdate == '0000-00-00' ? "" : obj1._109_frbrrecdate);
				$('#_109_comdsecsenddate').val(obj1._109_comdsecsenddate == '0000-00-00' ? "" : obj1._109_comdsecsenddate);
				$('#_109_comdsecrecdate').val(obj1._109_comdsecrecdate == '0000-00-00' ? "" : obj1._109_comdsecrecdate);
				$('#_109_defminsenddate').val(obj1._109_defminsenddate == '0000-00-00' ? "" : obj1._109_defminsenddate);
				$('#_109_defminrecdate').val(obj1._109_defminrecdate == '0000-00-00' ? "" : obj1._109_defminrecdate);
				$('#_109_letter').val(obj1._109_letter);
				if (obj1._109_letter != "") {
					$("a#_109_report").show();
					$("a#_109_report").attr("href", "upload/r109/"+obj1._109_letter);
				} else {
					$("a#_109_report").hide();
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
					මු. රෙ 109 යටතේ අවසන් වාර්තාව -  <span id="fileno"></span>
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
                                        <input type="hidden" name="action" value="add_109" />
                                        <input type="hidden" name="id" id="id" value="0" />
										<input type="hidden" name="_109_letter" id="_109_letter" value="" />
										<div><label for="name" class="label">අ/මුදල් වෙත ඉදිරිපත් කල දිනය :</label><input type="text" class="date" name="_109_dirfinsenddate"  id="_109_dirfinsenddate" style="width:100px"/></div>
										<div><label for="name" class="label">අ/මුදල් වෙතින් ලද දිනය :</label><input type="text" class="date" name="_109_dirfinrecdate"  id="_109_dirfinrecdate" style="width:100px"/></div>
										<div><label for="name" class="label">මුකශා වෙත යැවූ දිනය :</label><input type="text" class="date" name="_109_frbrsenddate"  id="_109_frbrsenddate" style="width:100px"/></div>
										<div><label for="name" class="label">මුකශා වෙතින් ලද දිනය :</label><input type="text" class="date" name="_109_frbrrecdate"  id="_109_frbrrecdate" style="width:100px"/></div>
										<div><label for="name" class="label">හලේකා වෙත යැවූ දිනය :</label><input type="text" class="date" name="_109_comdsecsenddate"  id="_109_comdsecsenddate" style="width:100px"/></div>
										<div><label for="name" class="label">හලේකා වෙතින් ලද දිනය :</label><input type="text" class="date" name="_109_comdsecrecdate"  id="_109_comdsecrecdate" style="width:100px"/></div>
										<div><label for="name" class="label">රා. ආ. අ. වෙත යැවූ දිනය :</label><input type="text" class="date" name="_109_defminsenddate"  id="_109_defminsenddate" style="width:100px"/></div>
										<div><label for="name" class="label">කපාහැරීමේ අනුමැතිය ලද දිනය :</label><input type="text" class="date" name="_109_defminrecdate"  id="_109_defminrecdate" style="width:100px"/></div>
										<div><label for="name" class="label">මු. රෙ 109 යටතේ අවසන් වාර්තාව :</label><input type="file" name="letter"  id="letter"/></div>
										<div><label for="name" class="label"></label><a href="upload/r109/filename.pdf" target="_blank" name="_109_report" id="_109_report" class="btn btn-default" style="color:blue"  hidden>ඇතුලත් කරනලද මු. රෙ 109 යටතේ අවසන් වාර්තාව </a></div>
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











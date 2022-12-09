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
					$("html, body").animate({scrollTop: 0}, "slow");
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
			$("html, body").animate({scrollTop: 0}, "slow");
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
				$('#_1044_recdate').val(obj1._1044_recdate == '0000-00-00' ? "" : obj1._1044_recdate);
				$('#_1044_obsenddate').val(obj1._1044_obsenddate == '0000-00-00' ? "" : obj1._1044_obsenddate);
				$('#_1044_obrecdate').val(obj1._1044_obrecdate == '0000-00-00' ? "" : obj1._1044_obrecdate);
				$('#_1044_lowsenddate').val(obj1._1044_lowsenddate == '0000-00-00' ? "" : obj1._1044_lowsenddate);
				$('#_1044_lowobsenddate').val(obj1._1044_lowobsenddate == '0000-00-00' ? "" : obj1._1044_lowobsenddate);
				$('#_1044_againsenddate').val(obj1._1044_againsenddate == '0000-00-00' ? "" : obj1._1044_againsenddate);
				$('#_1044_againrecdate').val(obj1._1044_againrecdate == '0000-00-00' ? "" : obj1._1044_againrecdate);
				$('#_1044_againlowsenddate').val(obj1._1044_againlowsenddate == '0000-00-00' ? "" : obj1._1044_againlowsenddate);
				$('#_1044_commanderorderdate').val(obj1._1044_commanderorderdate == '0000-00-00' ? "" : obj1._1044_commanderorderdate);
				$('#_1044_clams').val(obj1._1044_clams);
				$('#_1044_frbrsenddate').val(obj1._1044_frbrsenddate == '0000-00-00' ? "" : obj1._1044_frbrsenddate);
				$('#_1044_frbrrecdate').val(obj1._1044_frbrrecdate == '0000-00-00' ? "" : obj1._1044_frbrrecdate);
				$('#_1044_comdsecsenddate').val(obj1._1044_comdsecsenddate == '0000-00-00' ? "" : obj1._1044_comdsecsenddate);
				$('#_1044_comdsecrecdate').val(obj1._1044_comdsecrecdate == '0000-00-00' ? "" : obj1._1044_comdsecrecdate);
				$('#_1044_defminsenddate').val(obj1._1044_defminsenddate == '0000-00-00' ? "" : obj1._1044_defminsenddate);
				$('#_1044_defminrecdate').val(obj1._1044_defminrecdate == '0000-00-00' ? "" : obj1._1044_defminrecdate);
				$('#_1044_letter').val(obj1._1044_letter);
				if (obj1._1044_letter != "") {
					$("a#_1044_report").show();
					$("a#_1044_report").attr("href", "upload/r1044/"+obj1._1044_letter);
				} else {
					$("a#_1044_report").hide();
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
					මු. රෙ 104(4) යටතේ අවසන් වාර්තාව  -  <span id="fileno"></span>
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
                                        <input type="hidden" name="action" value="add_104_4" />
										<input type="hidden" name="_1044_letter" id="_1044_letter" value="" />
                                        <input type="hidden" name="id" id="id" value="0" />
										<div><label for="name" class="label">වාර්තා ලද දිනය :</label><input type="text" class="date" name="_1044_recdate"  id="_1044_recdate" style="width:100px"/></div>
										<div><label for="name" class="label">නිරීක්ෂණ ඇත්නම් නැවත යැවූ දිනය :</label><input type="text" class="date" name="_1044_obsenddate"  id="_1044_obsenddate" style="width:100px"/></div>
										<div><label for="name" class="label">නිරීක්ෂණ ඇත්නම් නැවත ලද දිනය :</label><input type="text" class="date" name="_1044_obrecdate"  id="_1044_obrecdate" style="width:100px"/></div>
										<div><label for="name" class="label">නීතිඅම වෙත ඉදිරිපත් කල දිනය :</label><input type="text" class="date" name="_1044_lowsenddate"  id="_1044_lowsenddate" style="width:100px"/></div>
										<div><label for="name" class="label">නීති අම නිරීක්ෂණ ඇත්නම් ලද දිනය :</label><input type="text" class="date" name="_1044_lowobsenddate"  id="_1044_lowobsenddate" style="width:100px"/></div>
										<div><label for="name" class="label">නැවත ඉදිරිපත් කල දිනය :</label><input type="text" class="date" name="_1044_againsenddate"  id="_1044_againsenddate" style="width:100px"/></div>
										<div><label for="name" class="label">මනැවත ලද දිනය :</label><input type="text" class="date" name="_1044_againrecdate"  id="_1044_againrecdate" style="width:100px"/></div>
										<div><label for="name" class="label">නැවත නීති අම වෙත ඉදිරිපත් කල දිනය :</label><input type="text" class="date" name="_1044_againlowsenddate"  id="_1044_againlowsenddate" style="width:100px"/></div>
										<div><label for="name" class="label">යුහපති නිගමනය ලද දිනය :</label><input type="text" class="date" name="_1044_commanderorderdate"  id="_1044_commanderorderdate" style="width:100px"/></div>
										<div><label for="name" class="label">අයකිරීම් ඇත්නම් :</label><input type="text" name="_1044_clams"  id="_1044_clams" style="width:100px"/></div>
										<div><label for="name" class="label">මුකශා වෙත යැවූ දිනය :</label><input type="text" class="date" name="_1044_frbrsenddate"  id="_1044_frbrsenddate" style="width:100px"/></div>
										<div><label for="name" class="label">මුකශා වෙතින් ලද දිනය :</label><input type="text" class="date" name="_1044_frbrrecdate"  id="_1044_frbrrecdate" style="width:100px"/></div>
										<div><label for="name" class="label">හලේකා වෙත යැවූ දිනය :</label><input type="text" class="date" name="_1044_comdsecsenddate"  id="_1044_comdsecsenddate" style="width:100px"/></div>
										<div><label for="name" class="label">හලේකා වෙතින් ලද දිනය :</label><input type="text" class="date" name="_1044_comdsecrecdate"  id="_1044_comdsecrecdate" style="width:100px"/></div>
										<div><label for="name" class="label">රා.ආ.අ. වෙත යැවූ දිනය :</label><input type="text" class="date" name="_1044_defminsenddate"  id="_1044_defminsenddate" style="width:100px"/></div>
										<div><label for="name" class="label">මු.රෙ. 109 සඳහා අනුමැතිය ලද දිනය :</label><input type="text" class="date" name="_1044_defminrecdate"  id="_1044_defminrecdate" style="width:100px"/></div>
										<div><label for="name" class="label">මු. රෙ 104(4) යටතේ අවසන් වාර්තාව:</label><input type="file" name="letter"  id="letter"/></div>
										<div><label for="name" class="label"></label><a href="upload/r1044/filename.pdf" target="_blank" name="_1044_report" id="_1044_report" class="btn btn-default" style="color:blue"  hidden>ඇතුලත් කරනලද මු. රෙ 104(4) යටතේ අවසන් වාර්තාව </a></div>
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











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

$("#submit").click(function(){
		saveData();
	return false
});		
function saveData()
		{
	var closedfile = ($('input:checkbox[name=closedfile]').is(':checked')) ? 1 : 0; 
	var id = $('#id').val();
	var querystring = {
			closedfile: closedfile,
			id: id,
			action: 'add_close_file'
		}
		$.get('index.php', querystring, processResponse);
	 function processResponse(result) {
		setMessage(result);
		}
	return false
		};		

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
				$('#fileno1').val(obj1.fileno);
				$('#assetscenter').val(obj1.assetscenter);
				$('#assetunit').val(obj1.assetunit);
				$('#place').val(obj1.place);
				$('#date').val(obj1.date);
				$('#time').val(obj1.time);
				$('#goods').val(obj1.goods);
				$('#value').val(obj1.value);
				if (obj1.description == 1) { 
					$('#description').val("අසාමාන්‍ය සිදුවීම්");
				} else {
					$('#description').val("ත්‍රස්තවාදී ප්‍රහාර");
				}
				$('#letter1').val(obj1.letter1);
				$('#letter1date').val(obj1.letter1date);
				$("a#board_letter").attr("href", "upload/board/"+obj1.board_letter);
				$('#_1043_recdate').val(obj1._1043_recdate == '0000-00-00' ? "" : obj1._1043_recdate);
				$('#_1043_frbrsenddate').val(obj1._1043_frbrsenddate == '0000-00-00' ? "" : obj1._1043_frbrsenddate);
				$('#_1043_frbrrecdate').val(obj1._1043_frbrrecdate == '0000-00-00' ? "" : obj1._1043_frbrrecdate);
				$('#_1043_comdsecsenddate').val(obj1._1043_comdsecsenddate == '0000-00-00' ? "" : obj1._1043_comdsecsenddate);
				$('#_1043_comdsecrecdate').val(obj1._1043_comdsecrecdate == '0000-00-00' ? "" : obj1._1043_comdsecrecdate);
				$('#_1043_defminsenddate').val(obj1._1043_defminsenddate == '0000-00-00' ? "" : obj1._1043_defminsenddate);
				$('#_1043_defminrecdate').val(obj1._1043_defminrecdate == '0000-00-00' ? "" : obj1._1043_defminrecdate);
				$('#_1043_adviseddate').val(obj1._1043_adviseddate == '0000-00-00' ? "" : obj1._1043_adviseddate);
				$("a#_1043_report").attr("href", "upload/r1043/"+obj1._1043_letter);
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
				$("a#_1044_report").attr("href", "upload/r1044/"+obj1._1044_letter);
				$('#_109_dirfinsenddate').val(obj1._109_dirfinsenddate == '0000-00-00' ? "" : obj1._109_dirfinsenddate);
				$('#_109_dirfinrecdate').val(obj1._109_dirfinrecdate == '0000-00-00' ? "" : obj1._109_dirfinrecdate);
				$('#_109_frbrsenddate').val(obj1._109_frbrsenddate == '0000-00-00' ? "" : obj1._109_frbrsenddate);
				$('#_109_frbrrecdate').val(obj1._109_frbrrecdate == '0000-00-00' ? "" : obj1._109_frbrrecdate);
				$('#_109_comdsecsenddate').val(obj1._109_comdsecsenddate == '0000-00-00' ? "" : obj1._109_comdsecsenddate);
				$('#_109_comdsecrecdate').val(obj1._109_comdsecrecdate == '0000-00-00' ? "" : obj1._109_comdsecrecdate);
				$('#_109_defminsenddate').val(obj1._109_defminsenddate == '0000-00-00' ? "" : obj1._109_defminsenddate);
				$('#_109_defminrecdate').val(obj1._109_defminrecdate == '0000-00-00' ? "" : obj1._109_defminrecdate);
				$("a#_109_report").attr("href", "upload/r109/"+obj1._109_letter);
				$('#removeddate').val(obj1.removeddate == '0000-00-00' ? "" : obj1.removeddate);
				$('#removedvalue').val(obj1.removedvalue == '0000-00-00' ? "" : obj1.removedvalue);
				if (obj1.closedfile == 1) {
					$('#closedfile').prop('checked', true);
					//$('input:checkbox[name=closedfile]').attr('checked',true);
				} else {
					$('#closedfile').prop('checked', false);
					//$('input:checkbox[name=closedfile]').attr('checked',false);
				}
				populateBoardtable(obj1.fileno);
                populatetable(obj1.fileno);
                populatechargetable(obj1.fileno);
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
    });
function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode != 46 &&(charCode < 48 || charCode > 57)))
        return false;
    return true;
}
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
                            '</td></tr>';
                    $('#buyerTable tr:last').after(html);
                    i++;
                });
            }
        }
		
function populateBoardtable(fileno)
        {
            var querystring = {
                fileno: fileno,
				action: 'get_lost_damage_board'
            }
            $.get('index.php', querystring, processResponse);
            function processResponse(result) {
				var data = $.parseJSON(result);
				$('#BoardTable tr').not(':first').remove();
                var i = 1;
                $.each(data, function (key, value) {
                    html = '<tr id="' + value.id + '"><td>' + i +
                            '</td><td>' + value.number +
                            '</td><td>' + value.rank +
                            '</td><td>' + value.name +
							'</td><td>' + value.unit +
							'</td><td>' + value.post +
                            '</td></tr>';
                    $('#BoardTable tr:last').after(html);
                    i++;
                });
            }
        }
        function populatechargetable(fileno)
        {
            var querystring = {
                fileno: fileno,
				action: 'get_file_table_charge'
            }
            $.get('index.php', querystring, processResponse);
            function processResponse(result) {
				var data = $.parseJSON(result);
				$('#chargeTable tr').not(':first').remove();
                var i = 1;
                $.each(data, function (key, value) {
                    html = '<tr id="' + value.id + '"><td>' + i +
                            '</td><td>' + value.number +
                            '</td><td>' + value.rank +
                            '</td><td>' + value.name +
							'</td><td>' + value.unit +
							'</td><td>' + value.value +
                            '</td></tr>';
                    $('#chargeTable tr:last').after(html);
                    i++;
                });
            }
        }
</script>
<style>
form#add_form .label{
	display: block;
	clear: left;
	float: left;
	width: 300px;
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
					ගොණුව අවසන් කිරීම :  -  <span id="fileno"></span>
                </h2>
                <span class="title_wrapper_left"></span>
                <span class="title_wrapper_right"></span>
            </div>
				<div class="section_content">
                <div class="sct">
                    <div class="sct_left">
                        <div class="sct_right">
                            <div class="sct_left">
                                <div class="title_wrapper">
                <h2>
                    ලිපිගොණුවේ මූලික විස්තර
                </h2>
                <span class="title_wrapper_left"></span>
                <span class="title_wrapper_right"></span>
            </div><div class="sct_right">
             <form id="add_form"> 
                                        <div><label for="code" class="label">ලිපිගොනු අංකය :</label><input type="text" class="text" name="fileno1"  id="fileno1" style="width:300px" readonly/></div>
                                        <div><label for="code" class="label">පාලන මූලය  :</label><input type="text" class="text" name="assetscenter"  id="assetscenter" style="width:300px" readonly/></div>										
										<div><label for="name" class="label">ඒකකය :</label><input type="text" class="text" name="assetunit"  id="assetunit" style="width:300px" readonly/></div>                                            
                                        <div><label for="name" class="label">ස්ථානය :</label><input type="text" class="text" name="place"  id="place" style="width:300px" readonly/></div>
                                        <div><label for="name" class="label">දිනය /වේලාව :</label><input type="text" class="text" name="date"  id="date" style="width:100px"/><input type="text" class="text" name="time"  id="time" style="width:100px" readonly/></div>
										<div><label for="name" class="label">විස්තරය :</label><textarea rows="5" name="goods" id="goods" style="width:500px" readonly></textarea></div>
										<div><label for="name" class="label">භාන්ඩයන්හි කිට්ටුම වටිනාකම :</label><input type="text" class="text" name="value"  id="value" style="width:150px; text-align:right;" readonly/></div>
										<div><label for="name" class="label">නැතිවූ ආකාරය :</label><input type="text" class="text" name="description"  id="description" style="width:500px" readonly/></div>
										<div><label for="name" class="label">ලිපියේ අංකය :</label><input type="text" class="text" name="letter1"  id="letter1" style="width:300px" readonly/></div>
										<div><label for="name" class="label">ලිපිය ලද දිනය :</label><input type="text" class="text" name="letter1date"  id="letter1date" style="width:100px" readonly/></div>					
                                    </form>                                
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
			<div class="title_wrapper">
                <h2>
					මණ්ඩලය
                </h2>
                <span class="title_wrapper_left"></span>
                <span class="title_wrapper_right"></span>
            </div>                   
				   <div class="table_wrapper">
                        <div class="table_wrapper_inner">
                            <table id = "BoardTable" style="font-size: 15px;" cellpadding="0" cellspacing="0" width="100%" >
                                <tbody><tr>
                                        <th>&nbsp;</th>
                                        <th style="font-size: 16px;">නි/අංකය</th>
                                        <th style="font-size: 16px;">නිලය</th>
                                        <th style="font-size: 16px;">නම</th>
                                        <th style="font-size: 16px;">ඒකකය</th>
                                        <th style="font-size: 16px;">තනතුර</th>											
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
			<div class="title_wrapper">
                <h2>
					මණ්ඩල වාර්තාව
                </h2>
                <span class="title_wrapper_left"></span>
                <span class="title_wrapper_right"></span>
            </div> 	
			 <form name="add_form" method="post" id="add_form" action="index.php" class="add_form"> 
				<div><label for="name" class="label"><a href="upload/board/filename.pdf" target="_blank" name="board_letter" id="board_letter" class="btn btn-default" style="color:blue">අලාභයන් පිළිබඳ මණ්ඩල වාර්තාව </a></label><input type="text" value="PDF Format" style="width:100px" readonly /></div>			
</form>            
		   <div class="title_wrapper">
                <h2>
					මු.රෙ. 104(3) යටතේ ප්‍රාරම්භක වාර්තාව
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
                                    <form name="add_form" method="post" id="add_form" action="index.php" class="add_form"> 
										<div><label for="name" class="label">වාර්තා ලද දිනය :</label><input type="text" class="text" name="_1043_recdate"  id="_1043_recdate" style="width:100px" readonly/></div>
										<div><label for="name" class="label">මුකශා වෙත යැවූ දිනය :</label><input type="text" class="text" name="_1043_frbrsenddate"  id="_1043_frbrsenddate" style="width:100px" readonly /></div>
										<div><label for="name" class="label">මුකශා වෙතින් ලද දිනය :</label><input type="text" class="text" name="_1043_frbrrecdate"  id="_1043_frbrrecdate" style="width:100px" readonly /></div>
										<div><label for="name" class="label">හලේකා වෙත යැවූ දිනය :</label><input type="text" class="text" name="_1043_comdsecsenddate"  id="_1043_comdsecsenddate" style="width:100px" readonly /></div>
										<div><label for="name" class="label">හලේකා වෙතින් ලද දිනය :</label><input type="text" class="text" name="_1043_comdsecrecdate"  id="_1043_comdsecrecdate" style="width:100px" readonly /></div>
										<div><label for="name" class="label">රා. ආ. අ. වෙත යැවූ දිනය :</label><input type="text" class="text" name="_1043_defminsenddate"  id="_1043_defminsenddate" style="width:100px" readonly /></div>
										<div><label for="name" class="label">මු.රෙ. 104(4) සඳහා අනුමැතිය ලද දිනය :</label><input type="text" class="text" name="_1043_defminrecdate"  id="_1043_defminrecdate" style="width:100px" readonly /></div>
										<div><label for="name" class="label">උපදෙස් ලබා දුන් දිනය :</label><input type="text" class="text" name="_1043_adviseddate"  id="_1043_adviseddate" style="width:100px" readonly /></div>
										<div><label for="name" class="label"><a href="upload/r1043/filename.pdf" target="_blank" name="_1043_report" id="_1043_report" class="btn btn-default" style="color:blue">මු.රෙ. 104(3) යටතේ ප්‍රාරම්භක වාර්තාව </a></label><input type="text" value="PDF Format" style="width:100px" readonly /></div>										
									</form>                                
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
                                    <form name="add_form" method="post" id="add_form" action="index.php" class="add_form"> 
										<div><label for="name" class="label">වාර්තා ලද දිනය :</label><input type="text" class="text" name="_1044_recdate"  id="_1044_recdate" style="width:100px" readonly /></div>
										<div><label for="name" class="label">නිරීක්ෂණ ඇත්නම් නැවත යැවූ දිනය :</label><input type="text" class="text" name="_1044_obsenddate"  id="_1044_obsenddate" style="width:100px" readonly /></div>
										<div><label for="name" class="label">නිරීක්ෂණ ඇත්නම් නැවත ලද දිනය :</label><input type="text" class="text" name="_1044_obrecdate"  id="_1044_obrecdate" style="width:100px" readonly /></div>
										<div><label for="name" class="label">නීතිඅම වෙත ඉදිරිපත් කල දිනය :</label><input type="text" class="text" name="_1044_lowsenddate"  id="_1044_lowsenddate" style="width:100px" readonly /></div>
										<div><label for="name" class="label">නීති අම නිරීක්ෂණ ඇත්නම් ලද දිනය :</label><input type="text" class="text" name="_1044_lowobsenddate"  id="_1044_lowobsenddate" style="width:100px" readonly /></div>
										<div><label for="name" class="label">නැවත ඉදිරිපත් කල දිනය :</label><input type="text" class="text" name="_1044_againsenddate"  id="_1044_againsenddate" style="width:100px" readonly /></div>
										<div><label for="name" class="label">මනැවත ලද දිනය :</label><input type="text" class="text" name="_1044_againrecdate"  id="_1044_againrecdate" style="width:100px" readonly /></div>
										<div><label for="name" class="label">නැවත නීති අම වෙත ඉදිරිපත් කල දිනය :</label><input type="text" class="text" name="_1044_againlowsenddate"  id="_1044_againlowsenddate" style="width:100px" readonly /></div>
										<div><label for="name" class="label">යුහපති නිගමනය ලද දිනය :</label><input type="text" class="text" name="_1044_commanderorderdate"  id="_1044_commanderorderdate" style="width:100px" readonly /></div>
										<div><label for="name" class="label">අයකිරීම් ඇත්නම් :</label><input type="text" name="_1044_clams"  id="_1044_clams" style="width:100px" readonly /></div>
										<div><label for="name" class="label">මුකශා වෙත යැවූ දිනය :</label><input type="text" class="text" name="_1044_frbrsenddate"  id="_1044_frbrsenddate" style="width:100px" readonly /></div>
										<div><label for="name" class="label">මුකශා වෙතින් ලද දිනය :</label><input type="text" class="text" name="_1044_frbrrecdate"  id="_1044_frbrrecdate" style="width:100px" readonly /></div>
										<div><label for="name" class="label">හලේකා වෙත යැවූ දිනය :</label><input type="text" class="text" name="_1044_comdsecsenddate"  id="_1044_comdsecsenddate" style="width:100px" readonly /></div>
										<div><label for="name" class="label">හලේකා වෙතින් ලද දිනය :</label><input type="text" class="text" name="_1044_comdsecrecdate"  id="_1044_comdsecrecdate" style="width:100px" readonly /></div>
										<div><label for="name" class="label">රා.ආ.අ. වෙත යැවූ දිනය :</label><input type="text" class="text" name="_1044_defminsenddate"  id="_1044_defminsenddate" style="width:100px" readonly /></div>
										<div><label for="name" class="label">මු.රෙ. 109 සඳහා අනුමැතිය ලද දිනය :</label><input type="text" class="text" name="_1044_defminrecdate"  id="_1044_defminrecdate" style="width:100px" readonly /></div>		
										<div><label for="name" class="label"><a href="upload/r1044/filename.pdf" target="_blank" name="_1044_report" id="_1044_report" class="btn btn-default" style="color:blue">මු. රෙ 104(4) යටතේ අවසන් වාර්තාව </a></label><input type="text" value="PDF Format" style="width:100px" readonly /></div>
									</form>                                
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>			
            <div class="section_content">
                <div class="sct">
                    <div class="sct_left">
                        <div class="sct_right">
                            <div class="sct_left">
                                <div class="sct_right">
            <div class="title_wrapper">
                <h2>
                අයකිරීම් පිළිබඳ විස්තර
                </h2>
                <span class="title_wrapper_left"></span>
                <span class="title_wrapper_right"></span>
            </div>                   
				   <div class="table_wrapper">
                        <div class="table_wrapper_inner">
                            <table id = "chargeTable" style="font-size: 15px;" cellpadding="0" cellspacing="0" width="100%" >
                                <tbody><tr>
                                        <th style="font-size: 16px;">&nbsp;</th>
                                        <th style="font-size: 16px;">රෙජිමේන්තු අංකය</th>
                                        <th style="font-size: 16px;">නිලය</th>
                                        <th style="font-size: 16px;">නම</th>
                                        <th style="font-size: 16px;">ඒකකය</th>
                                        <th style="font-size: 16px;">අයකරනලද වටිනාකම</th>										
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
           
           
            <div class="title_wrapper">
                <h2>
					මු. රෙ 109 යටතේ අවසන් වාර්තාව -  <span id="fileno"></span>
                </h2>
                <span class="title_wrapper_left"></span>
                <span class="title_wrapper_right"></span>
            </div>
                                    <form name="add_form" method="post" id="add_form" action="index.php" class="add_form"> 
										<div><label for="name" class="label">අ/මුදල් වෙත ඉදිරිපත් කල දිනය :</label><input type="text" class="text" name="_109_dirfinsenddate"  id="_109_dirfinsenddate" style="width:100px"readonly /></div>
										<div><label for="name" class="label">අ/මුදල් වෙතින් ලද දිනය :</label><input type="text" class="text" name="_109_dirfinrecdate"  id="_109_dirfinrecdate" style="width:100px" readonly /></div>
										<div><label for="name" class="label">මුකශා වෙත යැවූ දිනය :</label><input type="text" class="text" name="_109_frbrsenddate"  id="_109_frbrsenddate" style="width:100px" readonly /></div>
										<div><label for="name" class="label">මුකශා වෙතින් ලද දිනය :</label><input type="text" class="text" name="_109_frbrrecdate"  id="_109_frbrrecdate" style="width:100px" readonly /></div>
										<div><label for="name" class="label">හලේකා වෙත යැවූ දිනය :</label><input type="text" class="text" name="_109_comdsecsenddate"  id="_109_comdsecsenddate" style="width:100px" readonly /></div>
										<div><label for="name" class="label">හලේකා වෙතින් ලද දිනය :</label><input type="text" class="text" name="_109_comdsecrecdate"  id="_109_comdsecrecdate" style="width:100px" readonly /></div>
										<div><label for="name" class="label">රා. ආ. අ. වෙත යැවූ දිනය :</label><input type="text" class="text" name="_109_defminsenddate"  id="_109_defminsenddate" style="width:100px" readonly /></div>
										<div><label for="name" class="label">කපාහැරීමේ අනුමැතිය ලද දිනය :</label><input type="text" class="text" name="_109_defminrecdate"  id="_109_defminrecdate" style="width:100px" readonly /></div>	
										<div><label for="name" class="label"><a href="upload/r109/filename.pdf" target="_blank" name="_109_report" id="_109_report" style="color:blue">මු. රෙ 109 යටතේ අවසන් වාර්තාව </a></label><input type="text" value="PDF Format" style="width:100px" readonly /></div>										
                                    </form>                                
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="title_wrapper">
                <h2>
					කපාහරින ලද විස්තර ලයිස්තුව  : - <span id="fileno1"></span>
                </h2>
                <span class="title_wrapper_left"></span>
                <span class="title_wrapper_right"></span>
            </div>                   
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
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
			
			<div class="section_content">
                <div class="sct">
                    <div class="sct_left">
                        <div class="sct_right">
                            <div class="sct_left">
                                <div class="sct_right">                                        
                                    </ul>
                                    <form name="add_form" method="post" id="add_form" action="index.php" class="add_form"> 
										<div><label for="name" class="label">කපාහරින ලද දිනය  :</label><input type="text" class="text" name="removeddate"  id="removeddate" style="width:100px" readonly /></div>
										<div><label for="name" class="label">කපාහරින ලද වටිනාකම :</label><input type="text" class="text" name="removedvalue"  id="removedvalue" style="width:150px; text-align:right;" readonly /></div>			
                                    </form>                                
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                <div class="section">
            <div class="title_wrapper">
                <h2>
					ගොණුව අවසන් කිරීම
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
                                        <input type="hidden" name="action" value="add_close_file" />
                                        <input type="hidden" name="id" id="id" value="0" />
										<input type="hidden" name="type" id="type" value="0" />
										<div><label for="name" class="label">ගොණුව අවසන් කරන්න :</label><input type="checkbox" class="text" name="closedfile"  id="closedfile" style="width:100px"/></div>
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
</div>
<?php
include('sidebar.php');
include '../view/footer.php';
?>











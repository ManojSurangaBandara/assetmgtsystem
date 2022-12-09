<?php include 'header1.php';?>
	<script>
	$(function(){
	$("#submit").click(function(){
	saveData();
	return false
});

$('#thetable').delegate('button', 'click', function() {
 	   var result = confirm("Want to delete?");
        if (result) {
        var id = $(this).attr('id');
        var querystring = {
			id: id,
			action: 'detete_errorcode'
		}
        $.get('index.php', querystring, processResponse);
	   function processResponse(result) {
		tablePopulate();
       };    
	   return false
    }  
}); 
        
    $(".text").keypress(function(event) {
    if(event.keyCode == 13) { 
        textboxes = $("input.text");
        debugger;
        currentBoxNumber = textboxes.index(this);
        if (currentBoxNumber < 1) {
            nextBox = textboxes[currentBoxNumber + 1]
            nextBox.focus();
            nextBox.select();
            } else {
                $("#details").focus();
            }
        event.preventDefault();
        return false 
    }
    });
$( "#code" ).blur(function() {
if ($( "#code" ).val() != "") {
var querystring = {
                code: $( "#code" ).val(),
                action: 'get_errorcode'
            }
            $.get('index.php', querystring, processResponse);
    function processResponse(result) {   
        var obj1 = $.parseJSON(result);
               // $('#code').val(obj1.code)											
                $('#title').val(obj1.title);													
                $('#details').val(obj1.details);
            }
            }
});
function saveData()
		{
	var code = $('#code').val();
	var title = $('#title').val();
	var details = $('#details').val();
	var querystring = {
			code: code,
			title: title,
			details: details,
			action: 'add_errorcode_record'
		}
		$.get('index.php', querystring, processResponse);
	 function processResponse(result) {
		//alert(result);
         tablePopulate();
		}
	return false
		};
    $('#update').hide();
      tablePopulate();  
	});
function tablePopulate()
		{
	var querystring = {
			action: 'get_errorcode_full'
		}
		$.get('index.php', querystring, processResponse);
	 function processResponse(result) {
		var data = $.parseJSON(result);
         $("#thetable").find("tr:gt(0)").remove();
            var html = '';
         $.each(data, function(key,value) {
            $('#thetable').append('<tr><td>' + (key + 1) + '</td><td>' + value.code + '</td><td>' + value.title + '</td><td>' + value.details + '</td><td><button id="'+ value.id + '" class="del">Delete</button></td></tr>');
         });   
		}
	return false
		};
	</script>
<div id="page">
    <div class="inner">
        <div class="section">
            <div class="title_wrapper">
                <h2>
                    ADD - Error Codes
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
                                        <input type="hidden" name="action" value="add_errorcode_record" />
										<input type="hidden" name="id" id="id" value="0" />
                                        <div><label for="code" class="label">Code No :</label><input type="number" class="text" name="code" id="code" style="width:50px"/></div>
										<div><label for="title" class="label">Title :</label><input type="text" class="text" name="title" id="title" style="width:500px"/></div>
										<div><label for="details" class="label">Details :</label><textarea rows="10" cols="80" name="details"  id="details"></textarea></div>
										<div><input type="submit" name="submit" id="submit" value="Add Details"></div>										
                                        <div><input type="submit" name="submit" id="update" value="Delete Details"></div>
                                    </form> 
                                </div>
                                <fieldset>
									<div class="table_wrapper">
										<div class="table_wrapper_inner">
										<table cellpadding="0" id="thetable" cellspacing="0" width="100%">
                                            <tr>
                                                <th>S/No</th>
												<th>Code</th>
												<th>Title</th>
                                                <th>Details</th>
                                            </tr>
                                            </table>
										</div>
									</div>
									</fieldset>
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











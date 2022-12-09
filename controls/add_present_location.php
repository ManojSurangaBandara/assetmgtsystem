<?php include 'header1.php';?>
	<script>
	$(function(){
	$("#submit").click(function(){
	saveData();
	return false
});
function saveData()
		{
	var assetunit = $('#unit').val();
	var locations = $('#locations').val();
	var querystring = {
			assetunit: assetunit,
			locations: locations,
			action: 'save_present_location'
		}
		$.get('index.php', querystring, processResponse);
	 function processResponse(data) {
                   get_present_location_details($('#unit').val());
				   setMessage(data);
                } // end processData
                function errorResponse() {
                    $('#message').html('<li class="red"><span class="ico"></span><strong class="system_title">Error when Database Writing !</strong></li>');
                }
	return false
		};
$('#locations').keyup(function() {
 $('#message').html('<li class="blue"><span class="ico"></span><strong class="system_title">Enter Data and Press Add Locations Button.</strong></li>');
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
                    $('#message').html('<li class="blue"><span class="ico"></span><strong class="system_title">Enter Data and Press Add Locations Button.</strong></li>');
                    break;
                case 5:
                    $('#message').html('<li class="red"><span class="ico"></span><strong class="system_title">Data Error. Please Check Data !</strong></li>');
                    break;
                case 6:
                    $('#message').html('<li class="red"><span class="ico"></span><strong class="system_title">Error when Database Writing !</strong></li>');
                    break;
            }
        }
function get_present_location_details(assetunit)
{
	var querystring = {
			assetunit: assetunit,				 
			action: 'get_present_location_details'
		}
		$.get('index.php', querystring, processResponse);
	 function processResponse(result) {
				var data = $.parseJSON(result);
				$('#location_table tr').not(':first').remove();
                $.each(data, function (key, value) {
                    html = '<tr id="tr_' + value.id + '"><td><nobr>' + value.locations + '</td></tr>';
					$('#location_table tr:last').after(html);
                });
		}
}
get_present_location_details($('#unit').val());
	});
	</script>
<div id="page">
    <div class="inner">
        <div class="section">
            <div class="title_wrapper">
                <h2>
                    ADD - Present Location 
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
                                        <input type="hidden" name="action" value="save_present_location" />
										<input type="hidden" name="id" id="id" value="0" />
                                        <div><label for="brand" class="label">Assets Unit :</label><input type="text" class="text" name="unit"  id="unit" value ="<?php echo $assetunit; ?>" style="width:300px" readonly/></div>
										<div><label for="model" class="label">Location :</label><input type="text" class="text" name="locations"  id="locations" value ="" style="width:400px"/></div>			
										<div><input type="submit" name="submit" id="submit" value="Add Locations"></div>										
                                    </form> 
						   </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
				<div class="table_wrapper">
				<div class="table_wrapper_inner">
				<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-hover" id="location_table">
					<thead>
					<tr class="alert alert-warning alert-dismissible">
						<th style='font-size:100%'>Locations</th>
					</tr>
					</thead>
					<tbody id="situation_body">
				   </tbody>
				   </table>	
				   </div>
					</div>
    </div>
</div>
</div>
<?php
include('sidebar.php');
include '../view/footer.php';
?>











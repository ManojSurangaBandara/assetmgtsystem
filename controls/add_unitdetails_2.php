<?php include 'header2.php';?>
	<script>
	$(function(){
			$('#dg').edatagrid({
				url: 'index.php?action=get_unitmembers',
				saveUrl: 'index.php?action=save_unitmember',
				updateUrl: 'index.php?action=update_unitmember',
				destroyUrl: 'index.php?action=destroy_unitmember'
			});
	$("#submit").click(function(){
	saveData();
	return false
});
function saveData()
		{
	var unit = $('#unit').val();
	var address = $('#address').val();
	var telephone = $('#telephone').val();
	var email = $('#email').val();
	var fax = $('#fax').val();
	var fb = $('#fb').val();
	var coX = $('#coX').val();
	var coY = $('#coY').val();
	var querystring = {
			unit: unit,
			address: address,
			telephone: telephone,
			email: email,
			fax: fax,
			fb: fb,
			coX: coX,
			coY: coY,
			action: 'add_unitdetails_record'
		}
		$.get('index.php', querystring, processResponse);
	 function processResponse(data) {
					if (data == '1') {
                        setMessage(data);
                    } else if (data == '2') {
                        setMessage(data);               
                    } else {
                        $('#message').html('<li class="red"><span class="ico"></span><strong class="system_title">' + data + ' Data Error. Please Check Data !</strong></li>');
                    }
                } // end processData
                function errorResponse() {
                    $('#message').html('<li class="red"><span class="ico"></span><strong class="system_title">Error when Database Writing !</strong></li>');
                }
	return false
		};
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
                    ADD - Unit Details
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
                                        <input type="hidden" name="action" value="add_unitdetails_record" />
										<input type="hidden" name="id" id="id" value="0" />
                                        <div><label for="brand" class="label">Assets Unit :</label><input type="text" class="text" name="unit"  id="unit" value ="<?php echo $assetunit; ?>" style="width:300px" readonly/></div>
										<div><label for="model" class="label">Address :</label><input type="text" class="text" name="address"  id="address" value ="<?php echo $details['address'] ?? ""; ?>" style="width:400px"/></div>
										<div><label for="details" class="label">Telephone No. :</label><input type="text" class="text" name="telephone"  id="telephone" value ="<?php echo $details['telephone'] ?? ""; ?>" style="width:300px"/></div>
										<div><label for="details" class="label">E-Mail Address :</label><input type="text" class="text" name="email"  id="email" value ="<?php echo $details['email'] ?? ""; ?>" style="width:300px"/></div>
										<div><label for="details" class="label">Fax No. :</label><input type="text" class="text" name="fax"  id="fax" value ="<?php echo $details['fax'] ?? ""; ?>" style="width:300px"/></div>
										<div><label for="details" class="label">Facebook :</label><input type="text" class="text" name="fb"  id="fb" value ="<?php echo $details['fb'] ?? ""; ?>" style="width:300px"/></div>
										<div><label for="details" class="label">Google Map Latitude :</label><input type="text" class="text" name="coX"  id="coX" value ="<?php echo $details['coX'] ?? ""; ?>" style="width:100px"/><a href="http://www.latlong.net"  onclick="window.open('http://www.latlong.net', 'newwindow', 'width=600, height=500'); return false;"> Find This Values</a></div>
										<div><label for="details" class="label">Google Map Longitude :</label><input type="text" class="text" name="coY"  id="coY" value ="<?php echo $details['coY'] ?? ""; ?>" style="width:100px"/></div>									
										<div><input type="submit" name="submit" id="submit" value="Add Details"></div>										
                                    </form> 
						   </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
                <div class="title_wrapper">
                <h2>
                    Upload Unit Crest
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
																
									<form name="frm_land_add" method="post" id="frm_land_add" action="index.php" class="search_form general_form" enctype="multipart/form-data"> 
                                        <input type="hidden" name="action" value="add_unitdetails" />                                      
                                        <input type="hidden" name="unit" id="unit" value="<?php echo $assetunit; ?>" /> 
										<table width="100%" border="0">
                                            <td colspan="3">
                                                <table width="100%" border="0" class="listing form">                                                    
													 													 <tr>
                                                        <td width="30%"><label></label></td>
                                                        <td width="70%"><img src="<?php echo $details['crest']; ?>" width="230" height="230" /></td> 
                                                    </tr>
													 <tr>
                                                        <td width="30%"><label>Unit Crest :</label></td>
                                                        <td width="70%"><input type="file" name="Filename"> 
                                                    </tr>                                                    
                                                    <tr>
                                                        <td><label> </label></td>
                                                        <td>
                                                            <div class="buttons">
                                                                <ul>
                                                                    <li><span class="button send_form_btn"><span><span>Upload Crest</span></span><input name="" type="submit"/></span> </li>
                                                                </ul>       
                                                            </div>

                                                        </td>
                                                    </tr>                                                         
                                                </table>
                                            </td>
                                            </tr>
                                        </table>
                                    </form> 
						   </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		
									
                                   		
		
		
		
		
		
		<div id="md"></div>
	<table id="dg" title="Unit Members" style="width:100%;height:400px"
			toolbar="#toolbar" pagination="true" idField="id"
			rownumbers="true" fitColumns="true" singleSelect="true">
		<thead>
			<tr>
				<th field="sno" editor="{type:'validatebox',options:{required:true}}">S no</th>
                <th field="post" editor="{type:'validatebox',options:{required:true}}">Post</th>
                <th field="number" editor="{type:'validatebox',options:{required:true}}">Number</th>
                <th field="rank" editor="{type:'validatebox',options:{required:true}}">Rank</th>
				<th field="name" editor="{type:'validatebox',options:{required:true}}">Name</th>
				<th field="telephone" editor="text">Telephone</th>
				<th field="email" editor="{type:'validatebox',options:{validType:'email'}}">E-mail</th>
				<th field="fax" editor="text">Fax</th>
				<th field="fb" editor="text">Facebook</th>
				<th field="skype" editor="text">Skype</th>				
			</tr>
		</thead>
	</table>
	<div id="toolbar">
		<a href="#md" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:$('#dg').edatagrid('addRow')">New</a>
		<a href="#md" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="javascript:$('#dg').edatagrid('destroyRow')">Destroy</a>
		<a href="#md" class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="javascript:$('#dg').edatagrid('saveRow')">Save</a>
		<a href="#md" class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:$('#dg').edatagrid('cancelRow')">Cancel</a>
	</div>	
	
		<div id="googleMap" style="width:100%;height:500px;"></div> 
		<!-- Add Google Maps -->
		<script src="//maps.googleapis.com/maps/api/js"></script>
		<script>
		var myCenter = new google.maps.LatLng(<?php echo $details['coX']; ?>, <?php echo $details['coY']; ?>);

		function initialize() {
		var mapProp = {
		center:myCenter,
		zoom:12,
		scrollwheel:false,
		draggable:false,
		mapTypeId:google.maps.MapTypeId.ROADMAP
		};

		var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);

		var marker = new google.maps.Marker({
		position:myCenter,
		});

		marker.setMap(map);
		}

		google.maps.event.addDomListener(window, 'load', initialize);
		</script>
    </div>
</div>
</div>
<?php
include('sidebar.php');
include '../view/footer.php';
?>











<?php include 'header2.php';?>
	<script>
	$(function(){
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
	 function processResponse(result) {
		//alert(result);
		}
	return false
		};


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
										<div><label for="model" class="label">Address :</label><input type="text" class="text" name="address"  id="address" value ="<?php echo $details['address']; ?>" style="width:500px"/></div>
										<div><label for="details" class="label">Telephone No. :</label><input type="text" class="text" name="telephone"  id="telephone" value ="<?php echo $details['telephone']; ?>" style="width:300px"/></div>
										<div><label for="details" class="label">E-Mail Address :</label><input type="text" class="text" name="email"  id="email" value ="<?php echo $details['email']; ?>" style="width:300px"/></div>
										<div><label for="details" class="label">Fax No. :</label><input type="text" class="text" name="fax"  id="fax" value ="<?php echo $details['fax']; ?>" style="width:300px"/></div>
										<div><label for="details" class="label">Facebook :</label><input type="text" class="text" name="fb"  id="fb" value ="<?php echo $details['fb']; ?>" style="width:300px"/></div>
										<div><label for="details" class="label">Google Map Latitude :</label><input type="text" class="text" name="coX"  id="coX" value ="<?php echo $details['coX']; ?>" style="width:100px"/><a href="http://www.latlong.net"  onclick="window.open('http://www.latlong.net', 'newwindow', 'width=600, height=500'); return false;"> Find This Values</a></div>
										<div><label for="details" class="label">Google Map Longitude :</label><input type="text" class="text" name="coY"  id="coY" value ="<?php echo $details['coY']; ?>" style="width:100px"/></div>
										<div><input type="submit" name="submit" id="submit" value="Add Details"></div>										
                                    </form> 
						   </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		   <table id="dg" title="Unit Members" class="easyui-datagrid" style="width:100%;height:400px"
            url="index.php?action=get_unitmembers" 
            toolbar="#toolbar" idField="id" pagination="true"
            rownumbers="true" fitColumns="true" singleSelect="true">
        <thead>
            <tr>
                <th field="id">ID</th>
				<th field="sno">S no</th>
                <th field="post">Post</th>
                <th field="number">Number</th>
                <th field="rank">Rank</th>
				<th field="name">Name</th>
				<th field="telephone">Telephone</th>
				<th field="email">E-mail</th>
				<th field="fax">Fax</th>
				<th field="fb">Facebook</th>
				<th field="skype">Skype</th>
            </tr>
        </thead>
    </table>
	<div id="toolbar">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newUser()">New Member</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editUser()">Edit Member</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyUser()">Remove Member</a>
    </div>
	    <div id="dlg" class="easyui-dialog" style="width:400px;height:400px;padding:10px 20px"
            closed="true" buttons="#dlg-buttons">
        <div class="ftitle">Member Information</div>
        <form id="fm" method="post" novalidate>
            <div class="fitem">
                <label>S no:</label>
                <input name="sno" class="easyui-textbox" required="true"  validType="numeric">
            </div>
            <div class="fitem">
                <label>Post:</label>
                <input name="post" class="easyui-textbox" required="true">
            </div>
            <div class="fitem">
                <label>Rank:</label>
                <input name="rank" class="easyui-textbox" required="true">
            </div>
			<div class="fitem">
                <label>Number:</label>
                <input name="number" class="easyui-textbox" required="true">
            </div>
			<div class="fitem">
                <label>Name:</label>
                <input name="name" class="easyui-textbox" required="true">
            </div>
			<div class="fitem">
                <label>Phone:</label>
                <input name="telephone" class="easyui-textbox">
            </div>
            <div class="fitem">
                <label>Email:</label>
                <input name="email" class="easyui-textbox" validType="email">
            </div>
			<div class="fitem">
                <label>Fax:</label>
                <input name="fax" class="easyui-textbox">
            </div>
			<div class="fitem">
                <label>Facebook:</label>
                <input name="fb" class="easyui-textbox">
            </div>
			<div class="fitem">
                <label>Skype:</label>
                <input name="skype" class="easyui-textbox">
            </div>
        </form>
    </div>
	 <div id="dlg-buttons">
        <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveUser()" style="width:90px">Save</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')" style="width:90px">Cancel</a>
    </div>
	 <script type="text/javascript">
        var url;
        function newUser(){
            $('#dlg').dialog('open').dialog('center').dialog('setTitle','New Member');
            $('#fm').form('clear');
            url = 'index.php?action=save_unitmember';
        }
        function editUser(){
            var row = $('#dg').datagrid('getSelected');
            if (row){
                $('#dlg').dialog('open').dialog('center').dialog('setTitle','Edit Member');
                $('#fm').form('load',row);
				url = 'index.php?action=update_unitmember?id='+row.id;
            }
        }
        function saveUser(){
            $('#fm').form('submit',{
                url: url,
                onSubmit: function(){
                    return $(this).form('validate');
                },
                success: function(result){
						alert(result);
						$('#dg').datagrid('reload');    // reload the user data
						$('#fm').form('clear');
                    //}
                }
            });
        }
        function destroyUser(){
            var row = $('#dg').datagrid('getSelected');
            if (row){
                $.messager.confirm('Confirm','Are you sure you want to destroy this member?',function(r){
                    if (r){
                        $.post('index.php?action=destroy_unitmember',{id:row.id},function(result){
                            if (result.success){
                                $('#dg').datagrid('reload');    // reload the user data
                            } else {
                                $.messager.show({    // show error message
                                    title: 'Error',
                                    msg: result.errorMsg
                                });
                            }
                        },'json');
                    }
                });
            }
        }
    </script>
	<style type="text/css">
        #fm{
            margin:0;
            padding:10px 30px;
        }
        .ftitle{
            font-size:14px;
            font-weight:bold;
            padding:5px 0;
            margin-bottom:10px;
            border-bottom:1px solid #ccc;
        }
        .fitem{
            margin-bottom:5px;
        }
        .fitem label{
            display:inline-block;
            width:80px;
        }
        .fitem input{
            width:160px;
        }
    </style>
	
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











<?php include 'header2.php';?>
<style type="text/css">
       a:link {color: black;}      /* unvisited link */
       a:visited {color: black;}   /* visited link */
       a:hover {color: black;}     /* mouse over link */
       a:active {color: black;}    /* selected link */
    </style>
<script>	
$(document).ready(function () {
$('#tt').tree({
	onClick: function(node){
		var str = node.id;
	//	var res = str.substring(0, 1);
	//	//alert(res);
	//	$('#dg1').datagrid('load', 'index.php?action=getDetailsUnitbyCategory&category='+ node.text +'&res='+ res);
		$("html, body").animate({ scrollTop: 0 }, "slow");
	}
});
}); 
</script>
<div id="page">
    <div class="inner">
        <div class="section">
            <div class="title_wrapper">
                <h2>
                  Unit Details
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
                                        <div><label for="brand" class="label">Assets Unit :</label><input type="text" class="text" name="unit"  id="unit" value ="<?php echo $assetunit; ?>" style="width:300px" readonly/></div>
										<div><label for="model" class="label">Address :</label><input type="text" class="text" name="address"  id="address" value ="<?php echo $details['address']; ?>" style="width:500px" readonly/></div>
										<div><label for="details" class="label">Telephone No. :</label><input type="text" class="text" name="telephone"  id="telephone" value ="<?php echo $details['telephone']; ?>" style="width:300px" readonly/></div>
										<div><label for="details" class="label">E-Mail Address :</label><input type="text" class="text" name="email"  id="email" value ="<?php echo $details['email']; ?>" style="width:300px" readonly/></div>
										<div><label for="details" class="label">Fax No. :</label><input type="text" class="text" name="fax"  id="fax" value ="<?php echo $details['fax']; ?>" style="width:300px" readonly/></div>
										<div><label for="details" class="label">Facebook :</label><input type="text" class="text" name="fb"  id="fb" value ="<?php echo $details['fb']; ?>" style="width:300px" readonly/></div>										
                                    </form> 
						   </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		   <table id="dg" title="Unit Members" class="easyui-datagrid" style="width:100%;height:400px"
            url="index.php?action=get_unitmembers_all&unit=<?php echo $assetunit; ?>"
            rownumbers="true" fitColumns="true" singleSelect="true">
        <thead>
            <tr>
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











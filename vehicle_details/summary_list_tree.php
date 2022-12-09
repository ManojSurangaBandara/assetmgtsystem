<?php include '../view/header2.php'; ?>
<script>	
$(document).ready(function () {
$('#tt2').tree({
	onClick: function(node){
		var str = node.id;
		var res = str.substring(0, 1);
		//alert(res);
		$('#dg1').datagrid('load', 'index.php?action=getDetailsUnitbyCategory&category='+ node.text +'&res='+ res);
		$("html, body").animate({ scrollTop: 0 }, "slow");
	}
});
}); 
</script>
<div id="page">
<div class="inner">
<div class="section table_section">
        <div class="section_content">
            <div class="sct">
                <div class="sct_left">
                    <div class="sct_right">
                        <div class="sct_left">
                            <div class="sct_right">
								<table id="dg1" title="<?php echo $subMenu[0][$lang]?>" class="easyui-datagrid" style="height:500px"
									url=""
									pagination="true" idField="id"
									rownumbers="true" fitColumns="true" singleSelect="true">
								<thead>
									<tr>
										<th field="assetunit">Asset Unit</th>
										<th field="mainCategory">Vehicle Type</th>
										<th field="identificationno">Identification No</th>									
										<th field="itemCategory">Category</th>
										<th field="itemDescription">Description</th>
										<th field="make">Capacity</th>
										<th field="fuel">Fuel</th>
										<th field="assetsno">Asset No</th>
										<th field="engineno">Engine No</th>
										<th field="chessisno">Chassis No</th>
										<th field="brandName">Brand</th>
										<th field="modelName">Model</th>
										<th field="armyno">Army No</th>
										<th field="purchasedDate">DOP</th>
										<th field="receivedDate">DOR</th>
										<th field="unitValue" align ="right">Value</th>								
									</tr>
								</thead>
							</table>								
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <span class="scb"><span class="scb_left"></span><span class="scb_right"></span></span>						
        </div>
    </div>
						
  </div>
</div>
<?php
include('sidebar.php');
include '../view/footer.php';
?>
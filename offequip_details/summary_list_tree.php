<?php	
	include 'header2.php';
?>
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
								<table id="dg1" class="easyui-datagrid" style="height:600px" title="<?php echo $subMenu[0][$lang]?>"
									data-options="url:'',fitColumns:true,singleSelect:true,rownumbers:true">
								<thead>
									<tr>
										<th data-options="field:'assetunit'"><?php echo $tList[1][$lang]?></th>
										<th data-options="field:'itemCategory'"><?php echo $tList[3][$lang]?></th>
										<th data-options="field:'itemDescription'"><?php echo $tList[4][$lang]?></th>
										<th data-options="field:'catalogueno'"><?php echo $tList[5][$lang]?></th>
										<th data-options="field:'assetsno'">Assets Number</th>
										<th data-options="field:'newAssestno'">Classification</th>
										<th data-options="field:'cnt',align:'right'">Quantity</th>
										<th data-options="field:'tot',align:'right'">Value</th>
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
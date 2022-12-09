<?php	
	include 'header2.php';
?>
<script>	
$(document).ready(function () {
$('#tt').tree({
	onClick: function(node){
		$('#dg1').datagrid('load', 'index.php?action=getDetailsUnit&unit='+ node.text);
		$('#dg2').datagrid('load', 'index.php?action=getDetailsUnit2&unit='+ node.text);
		$('#dg3').datagrid('load', 'index.php?action=getDetailsUnit3&unit='+ node.text);
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
									idField="id"
									rownumbers="true" fitColumns="true" singleSelect="true">
								<thead frozen="true">
									<tr>
										<th field="identificationno"><?php echo $tList[18][$lang]?></th>										
									</tr>
								</thead>
								<thead>
									<tr>
										<th field="mainCategory"><?php echo $tList[2][$lang]?></th>
										<th field="itemCategory"><?php echo $tList[3][$lang]?></th>
										<th field="itemDescription"><?php echo $tList[4][$lang]?></th>
										<th field="catalogueno"><?php echo $tList[5][$lang]?></th>
										<th field="assetsno">Assets Number</th>
										<th field="newAssestno">Classification No</th>
										<th field="natureOwnership"><?php echo $tList[33][$lang]?></th>
										<th field="ledgerno"><?php echo $tList[7][$lang]?></th>
										<th field="ledgerFoliono"><?php echo $tList[8][$lang]?></th>
										<th field="eqptSriNo"><?php echo $tList[9][$lang]?></th>
										<th field="purchasedDate"><?php echo $tList[10][$lang]?></th>
										<th field="unitValue" align ="right"><?php echo $tList[13][$lang]?></th>
										<th field="receivedDate"><?php echo $tList[15][$lang]?></th>
										<th field="presentLocation"><?php echo $tList[16][$lang]?></th>
										<th field="Remarks"><?php echo $tList[17][$lang]?></th>
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
	
<div class="section table_section">
        <div class="section_content">
            <div class="sct">
                <div class="sct_left">
                    <div class="sct_right">
                        <div class="sct_left">
                            <div class="sct_right">
							<table id="dg2" title="Group By Catalogue Number" class="easyui-datagrid" style="height:500px"
									url=""
									idField="id"
									rownumbers="true" singleSelect="true">
								<thead frozen="true">
									<tr>
										<th field="assetunit"><?php echo $tList[1][$lang]?></th>										
										<th field="mainCategory"><?php echo $tList[2][$lang]?></th>
										<th field="itemCategory"><?php echo $tList[3][$lang]?></th>
										<th field="itemDescription"><?php echo $tList[4][$lang]?></th>
										<th field="catalogueno"><?php echo $tList[5][$lang]?></th>
										<th field="assetsno">Assets Number</th>
										<th field="newAssestno">Classification No</th>										
										<th field="cnt" align ="right">Quantity</th>
										<th field="tot" align ="right">Value</th>										
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

<div class="section table_section">
        <div class="section_content">
            <div class="sct">
                <div class="sct_left">
                    <div class="sct_right">
                        <div class="sct_left">
                            <div class="sct_right">
							<table id="dg3" title="Group By Item Category" class="easyui-datagrid" style="height:500px"
									url=""
									idField="id"
									rownumbers="true" singleSelect="true">
								<thead frozen="true">
									<tr>
										<th field="assetunit"><?php echo $tList[1][$lang]?></th>										
										<th field="mainCategory"><?php echo $tList[2][$lang]?></th>
										<th field="itemCategory"><?php echo $tList[3][$lang]?></th>																			
										<th field="cnt" align ="right">Quantity</th>
										<th field="tot" align ="right">Value</th>										
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
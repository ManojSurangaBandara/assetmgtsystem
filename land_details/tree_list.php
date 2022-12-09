<?php include 'header2.php'; ?>
<script>	
$(document).ready(function () {
$('#tt').tree({
	onClick: function(node){
		$('#dg1').datagrid('load', 'index.php?action=getDetailsUnit&unit='+ node.text);
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
							<table id="dg1" title="<?php echo $subMenu[0][$lang]?>" class="easyui-datagrid" style="height:950px"
									url=""
									idField="id"
									rownumbers="true" fitColumns="true" singleSelect="true">
								<thead frozen="true">
									<tr>
										<th field="assetunit">Assets Unit</th>
										<th field="identificationno">Identification No</th>
									</tr>
								</thead>
								<thead>
									<tr>
										<th field="category">Category Name </th>
										<th field="assetsno">Assets No</th>
										<th field="classificationno">Classification No</th>
										<th field="district">District</th>
										<th field="dsDivision">DS Division</th>
										<th field="gsDivision">GS Division</th>
										<th field="register">Land Registration Number/Date</th>
										<th field="landname">Land Name</th>
										<th field="natureOwnership">Nature of the Ownership</th>
										<th field="planno">Plan Number</th>
										<th field="deedno"">Deed Number</th>
										<th field="area" align ="right">Area(Hect)</th>
										<th field="acquisitiondate" align ="right">Acqu. Date</th>
										<th field="estimatedValue" align ="right">Value</th>
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
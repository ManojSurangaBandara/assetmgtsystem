<?php	
	include 'header2.php';
?>
<script>
function hideColumn(colToHide) {
    $('#dg').datagrid('hideColumn', colToHide);
}

function showColumn(colToHide) {
    $('#dg').datagrid('showColumn', colToHide);
}
   function myformatter(date){
            var y = date.getFullYear();
            var m = date.getMonth()+1;
            var d = date.getDate();
            return y+'-'+(m<10?('0'+m):m)+'-'+(d<10?('0'+d):d);
        }
        function myparser(s){
            if (!s) return new Date();
            var ss = (s.split('-'));
            var y = parseInt(ss[0],10);
            var m = parseInt(ss[1],10);
            var d = parseInt(ss[2],10);
            if (!isNaN(y) && !isNaN(m) && !isNaN(d)){
                return new Date(y,m-1,d);
            } else {
                return new Date();
            }
        }
        $(function () {
            var $chk = $("#grpChkBox input:checkbox"); 
            $chk.click(function () {
                var colToHide = $(this).attr("name");
				if ($(this).prop('checked')) {
					showColumn(colToHide);
				} else {
					hideColumn(colToHide);
				}
				//$('#dg').datagrid('reload');
            });
			$.fn.datebox.defaults.parser = function(s){
		if (!s) return new Date();
		var ss = s.split('-');
		var y = parseInt(ss[0],10);
		var m = parseInt(ss[1],10);
		var d = parseInt(ss[2],10);
		if (!isNaN(y) && !isNaN(m) && !isNaN(d)){
			return new Date(y,m-1,d);
		} else {
			return new Date();
		}
	};
	
	$('#search').bind('click', function(){
		if ($('#assetscenter').combobox('getValue') == "") {
			$.messager.alert('Warning','Please Select Assets Centre');
			//alert("Please Select Assets Centre");
			return false;
		}
		var url = 'index.php?action=List_columnlist_easyui_query&assetscenter='+$('#assetscenter').combobox('getValue')+'&assetunit='+$('#assetunit').combobox('getValue');
		$('#dg').datagrid('reload', url);
    });


        });
</script>
<div id="page">
		<div id="grpChkBox">
		    <table>
        <tbody>
            <tr>
                <td><input type="checkbox" name="assetscenter" /><?php echo $tList[0][$lang]?></td>
                <td><input type="checkbox" name="assetunit" /><?php echo $tList[1][$lang]?></td>
                <td><input type="checkbox" name="mainCategory" /><?php echo $tList[2][$lang]?></td>
                <td><input type="checkbox" name="itemCategory" /><?php echo $tList[3][$lang]?></td>
                <td><input type="checkbox" name="itemDescription" /><?php echo $tList[4][$lang]?></td>
				<td><input type="checkbox" name="catalogueno" /><?php echo $tList[5][$lang]?></td>
            </tr>
            <tr>
                <td><input type="checkbox" name="assetsno" /><?php echo $tList[6][$lang]?></td>
                <td><input type="checkbox" name="natureOwnership" /><?php echo $tList[33][$lang]?></td>
				<td><input type="checkbox" name="ledgerno" /><?php echo $tList[7][$lang]?></td>				
                <td><input type="checkbox" name="ledgerFoliono" /><?php echo $tList[8][$lang]?></td>				
                <td><input type="checkbox" name="eqptSriNo" /><?php echo $tList[9][$lang]?></td>
				<td><input type="checkbox" name="purchasedDate" /><?php echo $tList[10][$lang]?></td>
            </tr>
            <tr>
				<td><input type="checkbox" name="quantity" /><?php echo $tList[11][$lang]?></td>                
                <td><input type="checkbox" name="unitValue" /><?php echo $tList[13][$lang]?></td>
                <td><input type="checkbox" name="receivedDate" /><?php echo $tList[15][$lang]?></td>
                <td><input type="checkbox" name="presentLocation" /><?php echo $tList[16][$lang]?></td>
				<td><input type="checkbox" name="Remarks" /><?php echo $tList[17][$lang]?></td>
				<td><input type="checkbox" name="identificationno" /><?php echo $tList[18][$lang]?></td>
            </tr>
        </tbody>
    </table>
	<div>&nbsp;</div>
	<span id="error"></span>
    </div>
		<table id="dg" title="Plant & Machinery" class="easyui-datagrid" style="width:100%;height:400px"
			url = ""
			rownumbers="true" fitColumns="true" singleSelect="true" toolbar="#tb">
		<thead>
			<tr>
				<th field="assetscenter" hidden><?php echo $tList[0][$lang]?></th>
				<th field="assetunit" hidden><?php echo $tList[1][$lang]?></th>
				<th field="mainCategory" hidden><?php echo $tList[2][$lang]?></th>
				<th field="itemCategory" hidden><?php echo $tList[3][$lang]?></th>
				<th field="itemDescription" hidden><?php echo $tList[4][$lang]?></th>
				<th field="catalogueno" hidden><?php echo $tList[5][$lang]?></th>
				<th field="assetsno" hidden><?php echo $tList[6][$lang]?></th>
				<th field="natureOwnership" hidden><?php echo $tList[33][$lang]?></th>
				<th field="ledgerno" hidden><?php echo $tList[7][$lang]?></th>				
				<th field="ledgerFoliono" hidden><?php echo $tList[8][$lang]?></th>				
				<th field="eqptSriNo" hidden><?php echo $tList[9][$lang]?></th>
				<th field="purchasedDate" hidden><?php echo $tList[10][$lang]?></th>
				<th field="quantity" hidden><?php echo $tList[11][$lang]?></th>
				<th field="unitValue" hidden><?php echo $tList[13][$lang]?></th>
				<th field="receivedDate" hidden><?php echo $tList[15][$lang]?></th>
				<th field="presentLocation" hidden><?php echo $tList[16][$lang]?></th>
				<th field="Remarks" hidden><?php echo $tList[17][$lang]?></th>
				<th field="identificationno" hidden><?php echo $tList[18][$lang]?></th>
			</tr>
		</thead>
		</table>
		<div id="tb" style="padding:2px 5px;">
		Asset Center :<input id="assetscenter" name="assetscenter" class="easyui-combobox" style="auto" data-options="
			valueField: 'centreName',
			textField: 'centreName',
			url: 'index.php?action=getassetscenter',
			onSelect: function(rec){
			var url = 'index.php?action=getassetsunitcenter&id='+rec.centreName;
			$('#assetunit').combobox('reload', url);
			}">
		Asset Unit :<input id="assetunit" name="assetunit" class="easyui-combobox" style="width:100px" data-options="valueField:'unitName',textField:'unitName'">
		<a href="#" id="search" name="search" class="easyui-linkbutton" iconCls="icon-search">Search</a>
		</div>
					


</div>
<?php
//include('sidebar.php');
include '../view/footer.php';
?>
<?php include 'header2.php'; ?>
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
		var url = 'index.php?action=List_columnlist_easyui_query&assetscenter='+$('#assetscenter').combobox('getValue')+'&assetunit='+$('#assetunit').combobox('getValue')+'&fromdate='+$('#fromdate').combobox('getValue')+'&todate='+$('#todate').combobox('getValue');
		alert(url);
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
                <td><input type="checkbox" name="province" /><?php echo $tList[2][$lang]?></td>
                <td><input type="checkbox" name="district" /><?php echo $tList[3][$lang]?></td>
                <td><input type="checkbox" name="dsDivision" /><?php echo $tList[4][$lang]?></td>
				<td><input type="checkbox" name="gsDivision" /><?php echo $tList[5][$lang]?></td>
            </tr>
            <tr>
                <td><input type="checkbox" name="category" /><?php echo $tList[6][$lang]?></td>
                <td><input type="checkbox" name="classificationno" /><?php echo $tList[7][$lang]?></td>
                <td><input type="checkbox" name="natureOwnership" /><?php echo $tList[8][$lang]?></td>
                <td><input type="checkbox" name="ownership" /><?php echo $tList[9][$lang]?></td>
                <td><input type="checkbox" name="register" /><?php echo $tList[10][$lang]?></td>
				<td><input type="checkbox" name="landname" /><?php echo $tList[11][$lang]?></td>
            </tr>
            <tr>
                <td><input type="checkbox" name="planno" /><?php echo $tList[12][$lang]?></td>
                <td><input type="checkbox" name="deedno" /><?php echo $tList[13][$lang]?></td>
                <td><input type="checkbox" name="deeddate" /><?php echo $tList[14][$lang]?></td>
                <td><input type="checkbox" name="landNature" /><?php echo $tList[15][$lang]?></td>
                <td><input type="checkbox" name="areaMeasure" /><?php echo $tList[16][$lang]?></td>
				<td><input type="checkbox" name="area" /><?php echo $tList[17][$lang]?></td>
            </tr>
			<tr>
                <td><input type="checkbox" name="estimatedValue" /><?php echo $tList[18][$lang]?></td>
                <td><input type="checkbox" name="previousownership" /><?php echo $tList[19][$lang]?></td>
                <td><input type="checkbox" name="acquisitiondate" /><?php echo $tList[20][$lang]?></td>
                <td><input type="checkbox" name="remarks" /><?php echo $tList[21][$lang]?></td>
                <td><input type="checkbox" name="identificationno" /><?php echo $tList[22][$lang]?></td>
				<td></td>
            </tr>
        </tbody>
    </table>
	<div>&nbsp;</div>
	<span id="error"></span>
    </div>
		<table id="dg" title="Land Details" class="easyui-datagrid" style="width:100%;height:400px"
			url="index.php?action=List_columnlist_easyui_query&assetscenter="+$('#assetscenter').combobox('getValue')
			rownumbers="true" fitColumns="true" singleSelect="true" toolbar="#tb">
		<thead>
			<tr>
				<th field="assetscenter" hidden><?php echo $tList[0][$lang]?></th>
				<th field="assetunit" hidden><?php echo $tList[1][$lang]?></th>
				<th field="province" hidden><?php echo $tList[2][$lang]?></th>
				<th field="district" hidden><?php echo $tList[3][$lang]?></th>
				<th field="dsDivision" hidden><?php echo $tList[4][$lang]?></th>
				<th field="gsDivision" hidden><?php echo $tList[5][$lang]?></th>
				<th field="category" hidden><?php echo $tList[6][$lang]?></th>
				<th field="classificationno" hidden><?php echo $tList[7][$lang]?></th>
				<th field="natureOwnership" hidden><?php echo $tList[8][$lang]?></th>
				<th field="ownership" hidden><?php echo $tList[9][$lang]?></th>
				<th field="register" hidden><?php echo $tList[10][$lang]?></th>
				<th field="landname" hidden><?php echo $tList[11][$lang]?></th>
				<th field="planno" hidden><?php echo $tList[12][$lang]?></th>
				<th field="deedno" hidden><?php echo $tList[13][$lang]?></th>
				<th field="deeddate" hidden><?php echo $tList[14][$lang]?></th>
				<th field="landNature" hidden><?php echo $tList[15][$lang]?></th>
				<th field="areaMeasure" hidden><?php echo $tList[16][$lang]?></th>
				<th field="area" hidden><?php echo $tList[17][$lang]?></th>
				<th field="estimatedValue" hidden><?php echo $tList[18][$lang]?></th>
				<th field="previousownership" hidden><?php echo $tList[19][$lang]?></th>
				<th field="acquisitiondate" hidden><?php echo $tList[20][$lang]?></th>
				<th field="remarks" hidden><?php echo $tList[21][$lang]?></th>
				<th field="identificationno" hidden><?php echo $tList[22][$lang]?></th>
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

		<?php echo $tList[20][$lang]?> From: <input id="fromdate" name="fromdate" type="text" class="easyui-datebox" data-options="formatter:myformatter,parser:myparser" style="width:110px">
		To: <input id="todate" name="todate" class="easyui-datebox" data-options="formatter:myformatter,parser:myparser" style="width:110px">
		<a href="#" id="search" name="search" class="easyui-linkbutton" iconCls="icon-search">Search</a>
		</div>
					


</div>
<?php
//include('sidebar.php');
include '../view/footer.php';
?>
<?php	
	include 'header2.php';
?>
<style>
a.paging:link, a:visited {
    background-color: #5CB3FF;
    color: white;
    padding: 4px 5px;
    text-align: center;	
    text-decoration: none;
    display: inline-block;
}


a.paging:hover, a:active {
    background-color: #157DEC;
}
</style>
<style type="text/css">
       a:link {color: black;}      /* unvisited link */
       a:visited {color: black;}   /* visited link */
       a:hover {color: black;}     /* mouse over link */
       a:active {color: black;}    /* selected link */
</style>
<script>	
$(document).ready(function () {
			$('table').tablesorter({
			widgets        : ['stickyHeaders'],
			usNumberFormat : false,
			sortReset      : true,
			sortRestart    : true
		});	
$('#tt').tree({
	onClick: function(node){
		    			alert(node.id);
	}
});
}); 
</script>
<script>
$(document).ready(function(){
    $('#oe').click(function(){
 	var querystring1 = {			 
			action: 'itemcategory_all'
		}
		$.get('index.php', querystring1, processResponse);
	 function processResponse(data) {
		//alert(data);
		var item = $.parseJSON(data);
		$.each(item, function(key, value) {
 	var querystring = {			 
			itemcategory:value.itemCategory,
			action: 'json_all'
		}
		$.get('index.php', querystring, processResponse);
	 function processResponse(data) {
		//alert(data);
        if(data == '')
            return;
        JSONToCSVConvertor(data, "Plant & Machinery - " + value.itemCategory, true);
		} 
                });
		} 		
return false       
    });
});
function JSONToCSVConvertor(JSONData, ReportTitle, ShowLabel) {
    //If JSONData is not an object then JSON.parse will parse the JSON string in an Object
    var arrData = typeof JSONData != 'object' ? JSON.parse(JSONData) : JSONData;
    
    var CSV = '';    
    //Set Report title in first row or line
    
    CSV += ReportTitle + '\r\n\n';

    //This condition will generate the Label/Header
    if (ShowLabel) {
        var row = "";
        
        //This loop will extract the label from 1st index of on array
        for (var index in arrData[0]) {
            
            //Now convert each value to string and comma-seprated
            row += index + ',';
        }

        row = row.slice(0, -1);
        
        //append Label row with line break
        CSV += row + '\r\n';
    }
    
    //1st loop is to extract each row
    for (var i = 0; i < arrData.length; i++) {
        var row = "";
        
        //2nd loop will extract each column and convert it in string comma-seprated
        for (var index in arrData[i]) {
            row += '"' + arrData[i][index] + '",';
        }

        row.slice(0, row.length - 1);
        
        //add a line break after each row
        CSV += row + '\r\n';
    }

    if (CSV == '') {        
        alert("Invalid data");
        return;
    }   
    
    //Generate a file name
    var fileName = "MyReport_";
    //this will remove the blank-spaces from the title and replace it with an underscore
    fileName += ReportTitle.replace(/ /g,"_");   
    
    //Initialize file format you want csv or xls
    var uri = 'data:text/csv;charset=utf-8,' + escape(CSV);
    
    // Now the little tricky part.
    // you can use either>> window.open(uri);
    // but this will not work in some browsers
    // or you will not get the correct file extension    
    
    //this trick will generate a temp <a /> tag
    var link = document.createElement("a");    
    link.href = uri;
    
    //set the visibility hidden so it will not effect on your web-layout
    link.style = "visibility:hidden";
    link.download = fileName + ".csv";
    
    //this part will append the anchor tag and remove it after automatic click
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}
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
<?php
if ($id <> 0){
echo "<a href='index.php?action=List_summary_tree_3&id=$id&itemCategory=$itemCategory&page1=1' class='paging'>First Page</a>";
for ($j=1; $j<=$total_pages; $j++) {
	echo "<a href='index.php?action=List_summary_tree_3&id=$id&itemCategory=$itemCategory&page1=$j' class='paging'>$j</a>";
};
$last_page_no = $total_pages ? $total_pages : 1;
echo "<a href='index.php?action=List_summary_tree_3&id=$id&itemCategory=$itemCategory&page1=$last_page_no'  class='paging'>Last Page</a>";
}
?>							

        <div class="title_wrapper">
            <h2><?php echo $title; ?></h2>
            <span class="title_wrapper_left"></span>
            <span class="title_wrapper_right"></span>
        </div>
		<table id="abc" class="tablesorter"> 
<thead> 
<tr> 
    <th>S/N</th>  
    <th><nobr><?php echo $tList[1][$lang]?></nobr></th> 
    <th><nobr><?php echo $tList[3][$lang]?></nobr></th> 
	<th><nobr><?php echo $tList[4][$lang]?></nobr></th> 
	<th><nobr>Asst. No.</nobr></th> 
	<th><nobr>Classi. No</nobr></th> 
	<th><nobr>Serial No.</nobr></th>
    <th><nobr>DOP</nobr></th>
    <th><nobr>DOR</nobr></th>
    <th><nobr>Unit Value</nobr></th>
</tr> 
</thead> 
<tbody> 
<?php 
$totvalue = 0;?>
<?php foreach ($exps as $exp) { ?>		
<tr> 
<td><nobr><?php echo $i; ?></nobr></td>
<td><nobr><?php echo $exp['assetunit']; ?></nobr></td>	
<td><nobr><?php echo $exp['itemCategory']; ?></nobr></td>
<td><nobr><?php echo substr($exp['itemDescription'],0,40); ?></nobr></td>
<td><nobr><?php echo $exp['assetsno']; ?></a></nobr></td>
<td><nobr><?php echo $exp['catalogueno']; ?></nobr></td>
<td><nobr><?php echo $exp['eqptSriNo']; ?></nobr></td>
<td><nobr><?php echo $exp['purchasedDate']; ?></nobr></td>
<td><nobr><?php echo $exp['receivedDate']; ?></nobr></td>
<td align="right"><nobr><?php echo number_format((float)$exp['unitValue'], 2, '.', ','); ?></nobr></td>
</tr> 
 <?php $i++; 
 $totvalue = $totvalue + $exp['unitValue']; ?>
<?php } ?> 
</tbody>
	<tfoot>
	<tr>
	<td></td>
	<td>Total</td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>	
	  <td align="right"><?php echo number_format((float)$totvalue, 2, '.', ','); ?></td>
	</tr>
  </tfoot> 
</table>
                    </div>
					  </div>
                    </div>
                </div>
            </div>			
            <span class="scb"><span class="scb_left"></span><span class="scb_right"></span></span>	
			<iframe id="txtArea1" style="display:none"></iframe>
			<button id="btnExport" onclick="fnExcelReport();">Export to Excel</button>
			<button onclick="generate()">Export to pdf</button>
			<script src="../jspdf/libs/jspdf.min.js"></script>
			<script src="../jspdf/libs/jspdf.plugin.autotable.src.js"></script>
			<script src="../jspdf/libs/json2.js"></script>
			<script>
				function generate() {
					var doc = new jsPDF('l', 'pt', 'a3');
					doc.text("<?php echo $title; ?>", 30, 50);
					var res = doc.autoTableHtmlToJson(document.getElementById("abc"));
					doc.autoTable(res.columns, res.data, {startY: 60});
					doc.save("table.pdf");
				}
			</script>			
        </div>
    </div>
  </div>
</div>
<div id="sidebar">
    <div class="inner">
        <p>&nbsp;</p>
        <div class="section">
            <div class="section">
                <div class="title_wrapper">                   
							<h2 id = "oe">Summary List</h2>
                            <span class="title_wrapper_left"></span>
                            <span class="title_wrapper_right"></span>       
                </div>
    <div class="easyui-panel" style="padding:5px">
        <ul id="tt2" class="easyui-tree">
            <li>
                <span><a href="index.php?action=List_summary_tree_3&id=1">Plant & Machinery</a></span>
                <ul>
                    <?php 
					$i=0;
					$j = 0;
					$tem = "";
					$tem2 = "";
					foreach ($items as $exp) { 
					 if ($tem <> $exp['mainCategory']) { 
					 if ($j<>0){
						 $j++;
						?> 
						</li>
						</ul>						
					 <?php }
					  $j++;
					 ?>	
					<li id="2" data-options="state:'closed'">                        
						<span><a href="index.php?action=List_summary_tree_3&id=2&itemCategory=<?php echo $exp['mainCategory']; ?>"><?php echo $exp['mainCategory']; ?></a></span>
						<?php 
					   $tem = $exp['mainCategory'];
					   $i=0;
					   } 
						if ($tem2 <> $exp['itemCategory']) { 
						if ($i<>0) { ?>
							</li>
							</ul>
						 <?php
						}
						?>
						<ul>
                            <li id="3" data-options="state:'closed'"><span><a href="index.php?action=List_summary_tree_3&id=3&itemCategory=<?php echo $exp['itemCategory']; ?>"><?php echo $exp['itemCategory']; ?></a></span>
                        
                       <?php 
					   $tem2 = $exp['itemCategory'];
					   } ?>
						<ul>
                            <li id="4"><a href="index.php?action=List_summary_tree_3&id=4&itemDescription=<?php echo $exp['itemDescription']; ?>"><?php echo $exp['itemDescription']; ?></a></li>
                        </ul>   
						<?php   
					   $i++;
					} ?>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
                    <span class="scb"><span class="scb_left"></span><span class="scb_right"></span></span>
                </div>
            </div>
        </div>
<?php
//include('sidebar.php');
include '../view/footer.php';
?>
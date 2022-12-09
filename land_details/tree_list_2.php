<?php include 'header2.php'; ?>
<script>	
$(document).ready(function () {
$('#tt').tree({
	onClick: function(node){
		    var querystring = {
            id: node.id,
            text:node.text,
            action: 'getDetailsUnit_2'
        }
        $.get('index.php', querystring, processResponse);
        function processResponse(result) {
			//alert(result);
			var land = $.parseJSON(result);
			$("#tbodyid").empty();
			var table = $("#abc tbody");
			var total = 0.00;
			$.each(land, function(index, item){
				sno = 1 + index; 
				total = total + parseFloat(item.estimatedValue, 2);
				parch1 = parseFloat(item.parch);
				table.append("<tr><td><nobr>"+ sno +"</td><td><nobr>"+item.assetunit+"</td><td><nobr>"+item.identificationno+"</td><td><nobr>"+item.category+"</td><td><nobr>"+item.assetsno+"</td><td><nobr>"+item.classificationno+"</td><td><nobr>"+item.district+"</td><td><nobr>"+item.dsDivision+"</td><td><nobr>"+item.gsDivision+"</td><td><nobr>"+item.register+"</td><td><nobr>"+item.landname+"</td><td><nobr>"+item.natureOwnership+"</td><td><nobr>"+item.planno+"</td><td><nobr>"+item.deedno+"</td><td align='right'><nobr>"+item.area+"</td><td align='right'><nobr>"+item.acre+" A, "+item.rood+" R, "+ parch1.toFixed(2) +" P </nobr></td><td><nobr>"+item.acquisitiondate+"</td><td align='right'><nobr>"+formatCurrency(item.estimatedValue)+"</td></tr>");
				});
        		table.append("<tr><td></td><td>Total Value</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td align='right'>"+formatCurrency(total) +"</td></tr>");
			} // end processData
		$("html, body").animate({ scrollTop: 0 }, "slow");
	}
});
});
</script>
<div id="page">
<div class="inner">
    <div class="section table_section">
        <div class="title_wrapper">
            <h2><?php echo $subMenu[0][$lang]?></h2>
            <span class="title_wrapper_left"></span>
            <span class="title_wrapper_right"></span>
        </div>
        <div class="section_content">
            <div class="sct">
                <div class="sct_left">
                    <div class="sct_right">
                        <div class="sct_left">
                            <div class="sct_right">  

																		
                                        <div style="width:"100%";border:6px green solid;">
										<table id="abc" class="tablesorter" cellpadding="1" cellspacing="0" width="100%" border="1" BORDERCOLOR=skyblue style="font-size:11px;">
											<thead>
												<tr>
                                                <th><nobr>S/N</nobr></th>
												<th><nobr>Assets Unit</nobr></th>
												<th><nobr>Identification No</nobr></th>
                                                <th><nobr>Category Name</nobr></th>
												<th><nobr>Assets No</nobr></th>
												<th><nobr>Classification No</nobr></th>
                                                <th><nobr>District</nobr></th>
                                                <th><nobr>DS Division</nobr></th>
                                                <th><nobr>GS Division</nobr></th>
												<th><nobr>Land Registration Number/Date</nobr></th>
												<th><nobr>Land Name</nobr></th>
												<th><nobr>Nature of the Ownership</nobr></th>
												<th><nobr>Plan Number</nobr></th>
                                                <th><nobr>Deed Number</nobr></th>
                                                <th><nobr>Area(Hect)</nobr></th>
												<th><nobr>Area(Acre/Rood/Parch)</nobr></th>
                                                <th><nobr>Acqu. Date</nobr></th>
                                                <th><nobr>Value</nobr></th>
                                                </tr>
											</thead>
											<tbody id="tbodyid">
                                            </tbody>
											</table>
                                        </div>
                   
                        
                    </div>
					  </div>
                    </div>
                </div>
            </div>
			<iframe id="txtArea1" style="display:none"></iframe>
			<button id="btnExport" onclick="fnExcelReport();">Export to Excel</button>
			<button onclick="generate()">Export to pdf</button>
			<script src="../jspdf/libs/jspdf.min.js"></script>
			<script src="../jspdf/libs/jspdf.plugin.autotable.src.js"></script>
			<script src="../jspdf/libs/json2.js"></script>
			<script>
				function generate() {
					var doc = new jsPDF('l', 'pt', 'a1');
					doc.text("Land Details List", 30, 50);
					var res = doc.autoTableHtmlToJson(document.getElementById("abc"));
					doc.autoTable(res.columns, res.data, {startY: 60});
					doc.save("table.pdf");
				}
			</script>			
            <span class="scb"><span class="scb_left"></span><span class="scb_right"></span></span>						
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
							<h2><?php echo $slideBar[0][$lang]?></h2>
                            <span class="title_wrapper_left"></span>
                            <span class="title_wrapper_right"></span>       
                </div>

    <div  class="easyui-panel" style="padding:5px">
        <ul id="tt" class="easyui-tree">
            <li id="1">
                <span>Sri Lanka Army</span>
                <ul>
                    <?php 
					$tem = "";
					$tem2 = "";
					foreach ($items as $exp) { 
					 if ($exp['protocollevel1'] == 25) {
					 if ($tem <> $exp['protocoltext2']) { ?>	
					<li id="2" data-options="state:'closed'">                        
						<span><?php echo $exp['protocoltext2']; ?></span>
						<ul>
                            <li id="3"><?php echo $exp['unitName']; ?></li>
                        </ul>
                       <?php 
					   $tem = $exp['protocoltext2'];
					   } else {
						?>
						<ul>
                            <li id="4"><?php echo $exp['unitName']; ?></li>
                        </ul>   
						<?php   
					   } 
					 } else {
					 if ($tem <> $exp['protocoltext1']) { ?>	
					<li id="5" data-options="state:'closed'">                        
						<span><?php echo $exp['protocoltext1']; ?></span>
						<ul>
                            <li id="6"><?php echo $exp['unitName']; ?></li>
                        </ul>
                       <?php 
					   $tem = $exp['protocoltext1'];
					   } else {
						?>
						<ul>
                            <li id="7"><?php echo $exp['unitName']; ?></li>
                        </ul>   
						<?php   
					   } 
					} }?>
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
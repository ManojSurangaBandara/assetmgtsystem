<?php
include 'header1.php';
?>
<script>
$(document).ready(function() {
    $('#report').change(function() {
        var report = $(this).val();
		var option = '<option></option>';
		switch (report){
		   case "ver":
				option += '<option value="1">Not Appoint</option>';
				option += '<option value="2">Appointed Not Receive</option>';
				option += '<option value="3">Received But Rejected - Not Received New</option>';
				option += '<option value="4">Received Not Approved</option>';
				option += '<option value="5">Approved</option>';
				break;
		   case "con":
				option += '<option value="11">Not Appoint</option>';
				option += '<option value="12">Appointed Not Receive</option>';
				option += '<option value="13">Received But Rejected - Not Received New</option>';
				option += '<option value="14">Received Not Approved</option>';
				option += '<option value="15">Approved</option>';
				break;
		   case "des":
				option += '<option value="21">Not Appoint</option>';
				option += '<option value="12">Appointed Not Approved</option>';
				option += '<option value="15">Approved</option>';		
			   break;
		}
		$('#status').html(option); 	
        $("#add_form").validate({
            rules: {
                "report": {
                    required: true
                },
                "status": {
                    required: true
                }
            },
            //perform an AJAX post to ajax.php
            submitHandler: function () {
				var formData = $("#add_form").serialize();
                $.post('index.php', formData, processResponse);
            function processResponse(result) {
				var data = $.parseJSON(result);
                $("#maintable").find("tr:not(:nth-child(1)):not(:nth-child(2))").remove();
                var i = 1;
                $.each(data, function (key, value) {
                    var ver_brd_app = (value.ver_brd_app == '0000-00-00') ? '' : value.ver_brd_app;
					var ver_brd_rec = (value.ver_brd_rec == '0000-00-00') ? '' : value.ver_brd_rec;
					var ver_brd_rej1 = (value.ver_brd_rej1 == '0000-00-00') ? '' : value.ver_brd_rej1;
					var ver_brd_rej_rec1 = (value.ver_brd_rej_rec1 == '0000-00-00') ? '' : value.ver_brd_rej_rec1;
					var ver_brd_approved = (value.ver_brd_approved == '0000-00-00') ? '' : value.ver_brd_approved;
					var con_brd_app = (value.con_brd_app == '0000-00-00') ? '' : value.con_brd_app;
					var con_brd_rec = (value.con_brd_rec == '0000-00-00') ? '' : value.con_brd_rec;
					var con_brd_rej1 = (value.con_brd_rej1 == '0000-00-00') ? '' : value.con_brd_rej1;
					var con_brd_rej_rec1 = (value.con_brd_rej_rec1 == '0000-00-00') ? '' : value.con_brd_rej_rec1;
					var con_brd_approved = (value.con_brd_approved == '0000-00-00') ? '' : value.con_brd_approved;
					var des_brd_app = (value.des_brd_app == '0000-00-00') ? '' : value.des_brd_app;
					var des_brd_rec = (value.des_brd_rec == '0000-00-00') ? '' : value.des_brd_rec;
					html = '<tr id="' + value.id + '"><td>' + i +
                            '</td><td>' + value.assetscenter +
                            '</td><td>' + value.assetunit +
                            '</td><td>' + ver_brd_app +
							'</td><td>' + ver_brd_rec +
							'</td><td>' + ver_brd_rej1 +
							'</td><td>' + ver_brd_rej_rec1 +
							'</td><td>' + ver_brd_approved +
							'</td><td>' + con_brd_app +
							'</td><td>' + con_brd_rec +
							'</td><td>' + con_brd_rej1 +
							'</td><td>' + con_brd_rej_rec1 +
							'</td><td>' + con_brd_approved +
							'</td><td>' + des_brd_app +
                            '</td><td>' + des_brd_rec + '</td></tr>';
                    $('#maintable tr:last').after(html);
                    i++;
                });
            }
                return false;
            }
        });    
	
	
	
	});
});
</script>	
<div id="page">
    <div class="section table_section">
        <form name="add_form" method="post" id="add_form" action="index.php" class="add_form">
            <input type="hidden" name="action" value="data_inquiry"/>
            <table width="1009" border="0">
                <tr>
                    <td>
                    </td>
                    <td>
                        <b>Report</b> </td>
                    <td>
                        <select name="report" id="report">
						<option value=""></option>
                            <option value="ver">Annual Verfication Board</option>
							 <option value="con">Annual Condemnation Board</option>
							  <option value="des">Annual Destruction Board</option>
							</select>
                    </td>
</tr>
                <tr>
                    <td>
                    </td>
                    <td><b>Status</b></td>
                                       <td>
                        <select name="status" id="status">
							</select>
                    </td>
</tr>
                <tr>
                    <td> </td>
                    <td> </td>
                    <td>  
                        <input type="submit" value="Search" /> 
                    </td>
                </tr>
            </table>
        </form>        
		<div class="title_wrapper">
            <h2>Board of Survey - Total List - <?php echo $survayyear?></h2>
            <span class="title_wrapper_left"></span>
            <span class="title_wrapper_right"></span>
        </div>
        <div class="section_content">
            <div class="sct">
                <div class="sct_left">
                    <div class="sct_right">
                        <div class="sct_left">
                            <div class="sct_right">
                                <fieldset>                                   
                                        <div id="wrap">
										<div id="table-container">
										<table  id="maintable" class="tablesorter" cellpadding="1" cellspacing="0" width="100%" border="1" BORDERCOLOR=skyblue style="font-size:11px;">
											<thead>
												<tr>
													<th rowspan="2">S/No</th>
													<th rowspan="2">Assets Center</th>
													<th rowspan="2">Assets Unit</th>
													<th colspan="5">Annual Verfication Board</th>
													<th colspan="5">Annual Condemnation Board</th>
													<th colspan="2">Annual Destruction Board</th>
												</tr>
												<tr>
													<th>Appoint</th>
													<th>Rpt. Received</th>
													<th>Rpt. Rejected</th>
													<th>Rej. Rpt. Received</th>
													<th>Approved</th>
													<th>Appoint</th>
													<th>Rpt. Received</th>
													<th>Rpt. Rejected</th>
													<th>Rej. Rpt. Received</th>
													<th>Approved</th>
													<th>Appoint</th>
													<th>Rpt. Received</th>
												</tr>
											</thead>
											<tbody>
	
											</tbody>
										</table>
										<div id="bottom_anchor"></div>
</div>
                                        </div>
                                </fieldset>
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
					var doc = new jsPDF('l', 'pt', 'a1');
					doc.text("Land Details List", 30, 50);
					var res = doc.autoTableHtmlToJson(document.getElementById("abc"));
					doc.autoTable(res.columns, res.data, {startY: 60});
					doc.save("table.pdf");
				}
			</script>
		</div>
    </div>
</div>
<?php
//include('sidebar.php');
include '../view/footer.php';
?>
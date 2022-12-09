<?php
include 'header1.php';
?>
<script>	
$(document).ready(function() {
	$("#catalogueno1").on('change',  function () {
	   displayData();
	   //alert("test");              
    });
function getCataloguenos(){
        var querystring = {
            action: 'getCataloguenos'
        }
        $.get('index.php', querystring, processResponse);
        function processResponse(result) {
			var item = $.parseJSON(result);
            var option = '<option></option>';
            $.each(item, function(key, value) {
                option += '<option value="' + value.catalogueno + '">' + value.catalogueno + '</option>';
            });
            $('#catalogueno1').html(option);
			$('#catalogueno2').html(option);
        } // end processData
    };
	function displayData() {
	$('#abc tr').not(':first').remove();
	var catalogueno = $('#catalogueno1').val();
	var querystring = {
			catalogueno: catalogueno,
			action: 'get_cataloguenos_details'
		}
		$.get('index.php', querystring, processResponse);
	 function processResponse(result) {
		var html = '';		 
		 var item = $.parseJSON(result);
		  $.each(item, function(key, value) {
				var col;
				col = '#F4F4F8';
				if(value.apprived == 0) {
					col = '#d9ffb3';
				} 
				else {
					// code to be executed if condition is false
				}
				html += '<tr bgcolor="' + col + '"><td>' + value.id + '</td><td>'
									+ value.assetunit + '</td><td>'
									+ value.identificationno + '</td><td>'
									+ value.counterId + '</td><td>'
									+ value.groupId + '</td><td>'
									+ value.itemCategory + '</td><td>'
									+ value.itemDescription + '</td><td>'
									+ value.assetsno + '</td><td>'
									+ value.catalogueno + '</td><td>'
									+ value.eqptSriNo + '</td><td>'
									+ value.purchasedDate + '</td><td>'
									+ value.receivedDate + '</td><td>'
									+ value.unitValue + '</td></tr>';
          });
		  $('#abc tr').first().after(html);
		}
	return false
		};
	$('#reorderbtn').click(function() {
	var catalogueno1 = $('#catalogueno1').val();
	var catalogueno2 = $('#catalogueno2').val();
	var querystring = {
			catalogueno1: catalogueno1,
			catalogueno2: catalogueno2,
			action: 'change_Catalognos'
		}
		$.get('index.php', querystring, processResponse);
			 function processResponse(result) {
				displayData();
		}
	return false
    })
getCataloguenos();	
});
</script>
<style>
.button {
    background-color: #f44336; /* Green */
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
}
</style>
<div id="page">

    <div class="section table_section">
        <form action="." method="post" id="search_Expendable__form">
            <input type="hidden" name="action" value="reorder_id"/>
            <table border="0">
                <tr>
                    <td>
                        <b>Error Catelouge Number - (from)</b>
                    </td>
                    <td>   
                            <select name="catalogueno1" id="catalogueno1">
                                <option value=""></option>
                            </select>
                    </td>
                </tr>
				<tr>
                    <td>
                        <b>Correct Catelouge Number - (To)</b>
                    </td>
                    <td>   
                            <select name="catalogueno2" id="catalogueno2">
                                <option value=""></option>
                            </select>
                    </td>
                </tr>
            </table>
        </form>
        <div class="title_wrapper">
            <h2>Change Catalogue Numbers</h2>
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

                                    <div class="table_wrapper_inner">
                                        <table id="abc" class="tablesorter" cellpadding="1" cellspacing="0" width="100%" border="1" BORDERCOLOR=skyblue style="font-size:11px;">
                                             <thead>
											 <tr>
                                            <th><nobr>ID</nobr></th>
											<th><nobr>Assets Unit</nobr></th>
                                            <th><nobr>Identification No</nobr></th>
											<th><nobr>Counter ID</nobr></th>
											<th><nobr>Group ID</nobr></th>
                                            <th><nobr>Category</nobr></th>
                                            <th><nobr>Description</nobr></th>
                                            <th><nobr>Asset No</nobr></th>
                                            <th><nobr>Catalogue No</nobr></th>
                                            <th><nobr>Serial No.</nobr></th>
                                            <th><nobr>DOP</nobr></th>
                                            <th><nobr>DOR</nobr></th>
                                            <th><nobr>Unit Value</nobr></th>
											</tr>
                                           </thead>
														<tbody>
 
                                                        </tbody>
														</table>
														<button id="reorderbtn" class="button">Change Catalogue Number</button>
                                                        </div>
                                                        </fieldset>
                                                        </div>
                                                        </div>
                                                        </div>
                                                        </div>														
                                                        </div>
                                                        <span class="scb"><span class="scb_left"></span><span class="scb_right"></span></span>						
                                                        </div>
                                                        </div>

                                                        </div>
                                                        <?php
//include('sidebar.php');
                                                        include '../view/footer.php';
                                                        ?>
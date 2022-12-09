<?php include 'header1.php';?>
<script>
	$(function(){
		$('table').tablesorter({
			widgets        : ['zebra', 'stickyHeaders', 'filter', 'cssStickyHeaders'],
			usNumberFormat : false,
			sortReset      : true,
			sortRestart    : true
		});
    $('.clickable').click(function() {
        $( "#assetunit" ).val($(this).html());
		$( "#submit" ).show();
		tablePopulate($(this).html());
    });
	$("#submit").click(function(){
	var cyear = $('#currentYear').val();
	var itemtype = $('#itemtype').find(":selected").val();
	var assetunit = $('#assetunit').val();
	var title = $('#title').val();
	var details = $('#details').val();
		var querystring = {
			cyear: cyear,
			itemtype: itemtype,
			assetunit: assetunit,
			title:title,
			details: details,
			action: 'add_board_report_ob_save'
		}
		$.get('index.php', querystring, processResponse);
	 function processResponse(result) {
		//alert(result);
        tablePopulate(assetunit);
		}
	return false
	//return false
});
$('#thetable').delegate('button', 'click', function() {
 	   var result = confirm("Want to delete?");
        if (result) {
        var id = $(this).attr('id');
        var querystring = {
			id: id,
			action: 'detete_board_report'
		}
        $.get('index.php', querystring, processResponse);
	   function processResponse(result) {
		tablePopulate($('#assetunit').val());
       };    
	   return false
    }  
}); 



function tablePopulate(assetunit)
		{
	var cyear = "<?php echo $currentYear; ?>";
	var querystring = {
			cyear: cyear,
			assetunit: assetunit,
			action: 'get_board_report'
		}
		$.get('index.php', querystring, processResponse);
	 function processResponse(result) {
		var data = $.parseJSON(result);
         $("#thetable").find("tr:gt(0)").remove();
            var html = '';
         $.each(data, function(key,value) {
            $('#thetable').append('<tr><td>' 
			+ (key + 1) + '</td><td>' 
			+ value.itemtype + '</td><td>' 
			+ value.subject + '</td><td>' 
			+ value.details + '</td><td><button id="'
			+ value.id + '" class="del">Delete</button></td></tr>');
         });   
		}
	return false
		};
	});
</script>
<div id="page">
<div class="inner">
	<div class="section">
		<div class="section_content">
			<div class="sct">
				<div class="sct_left">
					<div class="sct_right">
						<div class="sct_left">
						    <div class="title_wrapper">
								<h2>
									ADD - Board Report Observations
								</h2>
								<span class="title_wrapper_left"></span>
								<span class="title_wrapper_right"></span>
							</div>
							<div style="display:block; width:100%;">
							<div style="width:20%; float: left; display: inline-block;">
                            <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-hover" id="myTable" style="background-color:#FFFFFF">
							<thead>
								<tr class="alert alert-warning alert-dismissible"  style='font-size:140%'>
									<th style='font-size:110%'>Units</th>																
								</tr>
							</thead>
							<tbody>
							<?php
							foreach ($content as $c):							
							?>								
							<tr style='font-size:120%'>
							<td class="clickable" id = "<?php echo $c['id']; ?>"><?php echo $c['assetunit']; ?></td>													
							</tr>
							<?php 
							endforeach; ?>
						   </tbody>
						   </table>
  
  
							</div>
                                    
							<div style="width:80%; float: left; display: inline-block;">
        <div class="section">
            <div class="title_wrapper">
                <h2>
                    Board Report Observations
                </h2>
                <span class="title_wrapper_left"></span>
                <span class="title_wrapper_right"></span>
            </div>
                <div class="sct">

							
								<div id="confirm" title="Confirm Destruction"></div>
                                    <ul id="message" class="system_messages">
                                        <li class="blue"><span class="ico"></span><strong class="system_title">Enter Data and  press "Add Details" Button</strong></li>
                                    </ul>
                                    <form name="add_form" method="post" id="add_form" action="index.php" class="add_form"> 
                                        <input type="hidden" name="action" value="add_board_report_ob_save" />
										<input type="hidden" name="id" id="id" value="0" />
										<input type="hidden" name="currentYear" id="currentYear" value="<?php echo $currentYear; ?>" />
                                        <div><label for="code" class="label">Unit :</label><input type="text" class="text" name="assetunit" id="assetunit" style="width:200px" readonly/></div>
										<div><label for="itemtype" class="label">Asset Category :</label><select name="itemtype" id="itemtype">
											<option value="land">LAND DETAILS</option>
											<option value="building">BUILDING DETAILS</option>											
											<option value="plant">PLANT & MACHINERY</option>
											<option value="office">OFFICE EQUIPMENTS</option>
											<option value="vehicle">VEHICLES</option>
										</select></div>
										<div><label for="title" class="label">Title :</label><input type="text" class="text" name="title" id="title" style="width:500px"/></div>
										<div><label for="details" class="label">Details :</label><textarea rows="10" cols="80" name="details"  id="details"></textarea></div>
										<div><input type="submit" name="submit" id="submit" value="Add Details" hidden></div>										
                                        <div><input type="submit" name="submit" id="update" value="Delete Details" hidden></div>
                                    </form> 
                                </div>
                                <fieldset>
									<div class="table_wrapper">
										<div class="table_wrapper_inner">
										<table cellpadding="0" id="thetable" cellspacing="0" width="100%">
                                            <tr>
                                                <th>S/No</th>
												<th>Asset Category</th>
												<th>Title</th>
                                                <th>Details</th>
                                            </tr>
                                            </table>
										</div>
									</div>
									</fieldset>


            
    </div>
  
  </div>
</div>		
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
  </div>
</div>
<?php
include('sidebar.php');
include '../view/footer.php';
?>
<?php
include 'header1.php';
?>
<script>	
$(document).ready(function () {
									$('.date').datepicker({dateFormat: 'yy-mm-dd',
										maxDate: '0',
										changeMonth : true,
										changeYear: true});
									var d = new Date();
									var month = d.getMonth()+1;
									var day = d.getDate();
									var output = d.getFullYear() + '-' +
										(month<10 ? '0' : '') + month + '-' +
										(day<10 ? '0' : '') + day;
$(".savebttn").click(function(){
  // Holds the product ID of the clicked element
	var id = $(this).attr('id');
	var des_brd_app = $('#des_brd_app_'+id).val();
	var des_brd_rec = $('#des_brd_rec_'+id).val();
	var querystring = {
			id: id,
			des_brd_app: des_brd_app,
			des_brd_rec: des_brd_rec,
			action: 'save_des_rpt'
		}
		$.get('index.php', querystring, processResponse);
	 function processResponse(result) {
		//alert(result);
		}
	return false
});
			$('table').tablesorter({
			widgets        : ['stickyHeaders', "filter"],
			usNumberFormat : false,
			sortReset      : true,
			sortRestart    : true
		});
}); 
</script>
<div id="page">

    <div class="section table_section">
        <div class="title_wrapper">
            <h2>Add Destruction Board - <?php echo $survayyear?></h2>
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
										<table  id="abc" class="tablesorter" cellpadding="1" cellspacing="0" width="100%" border="1" BORDERCOLOR=skyblue style="font-size:11px;">
											<thead>
												<tr>
													<td>S/No</td>
													<td>Assets Center</td>
													<td>Assets Unit</td>
													<td>Board Appoint</td>
													<td>Board Report</td>
													<td>Save</td>
												</tr>
											</thead>
											<tbody>
											<?php $i = 1; 
                                                foreach ($items as $exp) { ?>																
                                                    <tr>
                                                        <td><nobr><?php echo $i; ?></nobr></td>
														<td><nobr><?php echo $exp['assetscenter']; ?></nobr></td>
														<td><nobr><?php echo $exp['assetunit']; ?></nobr></td>                                                        
														<form name="add_form" id="add_form" class="add_form" action="." method="post">
															<td><input type="text" name="des_brd_app_<?php echo $exp['id']; ?>" id="des_brd_app_<?php echo $exp['id']; ?>" value="<?php echo $des_brd_app = ($exp['des_brd_app'] == '0000-00-00') ? '' : $exp['des_brd_app'];?>" class="date" style="width:75px"></td>
															<td><input type="text" name="des_brd_rec_<?php echo $exp['id']; ?>" id="des_brd_rec_<?php echo $exp['id']; ?>" value="<?php echo $des_brd_rec = ($exp['des_brd_rec'] == '0000-00-00') ? '' : $exp['des_brd_rec']; ?>" class="date" style="width:75px"></td>															
															<td><input class = "savebttn" id = "<?php echo $exp['id']; ?>" name="submit" type="submit" value="Save"/>
														</form>														
                                                    </tr>
                                                <?php $i++; } ?> 	
											</tbody>
										</table>
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
<?php
include '../view/header1.php';
?>
<div id="sec_menu">
    <?php include("sub_menu.tpl"); ?>
</div>
<script>	
$(document).ready(function () {
$(".savebttn").click(function(){
  // Holds the product ID of the clicked element
	var id = $(this).attr('id');
	var report_received = $('#report_received_'+id).val();
	var report_received_date = $('#report_received_date'+id).val();
	var querystring = {
			id: id,
			report_received: report_received,
			report_received_date: report_received_date,
			action: 'add_report_received'
		}
		$.get('index.php', querystring, processResponse);
	 function processResponse(result) {
		//alert(result);
		}
	return false
});
}); 
</script>
<div id="page">

    <div class="section table_section">
        <div class="title_wrapper"> 
			<h2>Add Confirm Report Received</h2>
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
                                        <table cellpadding="1" cellspacing="0" width="100%" border="1" BORDERCOLOR=skyblue style="font-size:11px;">

                                            <tbody>
                                            <col width="10">
                                            <col width="185">
                                            <th>S/N</th>
                                            <th><a>Asst. Centre</a></th>							
                                            <th><a>Asst. Unit</a></th>
                                            <th><a>Report Received</a></th>
                                            <th><a>Report Received Date</a></th>
                                            <th><a></a></th>
                                                        </tr>
                                                        <?php $i = 1; ?>
                                                        <?php foreach ($items as $exp) { ?>																
                                                            <tr>
                                                                <td><?php echo $i; ?></td>
																<td><?php echo $exp['centreName']; ?></td>
                                                                <td><?php echo $exp['unitName']; ?></td>																															
																
																<form name="add_form" id="add_form" class="add_form" action="." method="post">										
																	<td><input type="text" name="report_received_<?php echo $exp['SN']; ?>" id="report_received_<?php echo $exp['SN']; ?>" value="<?php echo $exp['report_received']; ?>" maxlength="1" onkeypress="return isNumberKey(event)"></td>
																	<td><input type="date" name="report_received_date<?php echo $exp['SN']; ?>" id="report_received_date<?php echo $exp['SN']; ?>" value="<?php echo $exp['report_received_date']; ?>"></td>
																	<td><input class = "savebttn" id = "<?php echo $exp['SN']; ?>" name="submit" type="submit" value="Save"/></td>
																</form>
																
                                                            </tr>
                                                            <?php $i++; ?>
                                                        <?php } ?> 
                                                        </tbody></table>
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
                                                        include '../view/footer.php';
                                                        ?>
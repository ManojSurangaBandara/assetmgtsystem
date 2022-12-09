<?php
include 'header1.php';
?>

<script>	
$(document).ready(function() {
		$('table').tablesorter({
			widgets        : ['stickyHeaders'],
			usNumberFormat : false,
			sortReset      : true,
			sortRestart    : true
		});	
});
</script>
<script type="text/javascript">
$(function() {
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
	
	$('.date-picker').datepicker( {
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        dateFormat: 'yy-MM',
        onClose: function(dateText, inst) { 
            $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
        }
    });
});
</script>
<div id="page">
	<div class="section">
		<div class="section_content">
			<div class="sct">
				<div class="sct_left">
					<div class="sct_right">
						<div class="sct_left">
						        <div class="title_wrapper">
            <h2>Plant & Machinery Date Range Change Details List</h2>
            <span class="title_wrapper_left"></span>
            <span class="title_wrapper_right"></span>
        </div>
    <div class="section table_section">
	        <form action="." method="post" id="search_Expendable__form" class="search_form general_form">
            <input type="hidden" name="action" value="date_range_changes"/>
			<table width="100%" border="0" class="listing form">
                <tr>
                    <td><b>Recevied Date - From : </b></td> 
					<td><input name="receivedDate_from" id="receivedDate_from" class="date" value="<?php echo $receivedDate_from; ?>" required/></td>
					<td><input name="receivedDate_to" id="receivedDate_to" class="date" value="<?php echo $receivedDate_to; ?>" required/></td>
				</tr>
				<tr>
                    <td></td> 
					<td><input type="checkbox" name="with_units" value="1" <?php if ($with_units == 1) { echo "checked";}?> > With Units</td>
					<td><input type="checkbox" name="full_details" value="1" <?php if ($full_details == 1) { echo "checked";}?> > Full Details</td>
				</tr>
                <tr>
                    <td></td>
                    <td>  
                        <input type="submit" value="Search" />
                    </td>
                </tr>
            </table>
        </form>
        <div class="title_wrapper">
            <h2><?php echo $title2?></h2>
            <span class="title_wrapper_left"></span>
            <span class="title_wrapper_right"></span>
        </div>
<?php
if ($display_type == 0){
	include 'date_range_changes_1.php';
} elseif ($display_type == 1){
	include 'date_range_changes_2.php';
} elseif ($display_type == 2){
	include 'date_range_changes_3.php';
}
?>

							</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

                                                        <?php
//include('sidebar.php');
                                                        include '../view/footer.php';
                                                        ?>
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
<style>
.ui-datepicker-calendar {
    display: none;
    }
</style>
<div id="page">
	<div class="section">
		<div class="section_content">
			<div class="sct">
				<div class="sct_left">
					<div class="sct_right">
						<div class="sct_left">
						        <div class="title_wrapper">
            <h2><?php echo $title?></h2>
            <span class="title_wrapper_left"></span>
            <span class="title_wrapper_right"></span>
        </div>
    <div class="section table_section">
        <div class="title_wrapper">
            <h2><?php echo $title2?></h2>
            <span class="title_wrapper_left"></span>
            <span class="title_wrapper_right"></span>
        </div>
		<table id="abc" class="tablesorter"> 
<thead> 
<tr> 
<th><nobr>S/N</nobr></th>
                                            <th><nobr>Identification No</nobr></th>
                                            <th><nobr>Category</nobr></th>
                                            <th><nobr>Description</nobr></th>
                                            <th><nobr>Catalogue No</nobr></th>
                                            <th><nobr>Serial No.</nobr></th>
                                            <th><nobr>DOP</nobr></th>
                                            <th><nobr>DOR</nobr></th>
                                            <th><nobr>Unit Value</nobr></th> 
</tr> 
</thead> 
<tbody> 
<?php $i = 1;
$totqty = 0; 
$totvalue = 0;?>
<?php foreach ($exps as $exp) { ?>		
<tr> 
<td><nobr><?php echo $i; ?></nobr></td>
                                                                <td><nobr><a href="index.php?action=ApprovedList&identificationno=<?php echo $exp['identificationno']; ?>&ignore_month=<?php echo $ignore_month;?>"><font color="DarkBlue"><?php echo $exp['identificationno']; ?></a></nobr></td>
																<td><?php echo $exp['itemCategory']; ?></td>
                                                                <td><?php echo $exp['itemDescription']; ?></td>
                                                                <td><nobr><?php echo $exp['catalogueno']; ?></nobr></td>
                                                                <td><nobr><?php echo $exp['eqptSriNo']; ?></nobr></td>
                                                                <td><nobr><?php echo $exp['purchasedDate']; ?></nobr></td>
                                                                <td><nobr><?php echo $exp['receivedDate']; ?></nobr></td>
                                                                <td align="right"><nobr><?php echo number_format($exp['unitValue'], 2, '.', ','); ?></nobr></td>
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
	  <td align="right"><?php echo number_format($totvalue, 2, '.', ','); ?></td>
	</tr>
  </tfoot> 
</table>

        <div class="title_wrapper">
            <h2><?php echo $title_dis?></h2>
            <span class="title_wrapper_left"></span>
            <span class="title_wrapper_right"></span>
        </div>
		<table id="abc" class="tablesorter"> 
<thead> 
<tr> 
                                            <th><nobr>S/N</nobr></th>
                                            <th><nobr>Identification No</nobr></th>
                                            <th><nobr>Category</nobr></th>
                                            <th><nobr>Description</nobr></th>
                                            <th><nobr>Catalogue No</nobr></th>
                                            <th><nobr>Serial No.</nobr></th>
                                            <th><nobr>DOP</nobr></th>
                                            <th><nobr>DOR</nobr></th>
											<th><nobr>Disposal Date</nobr></th>
                                            <th><nobr>Unit Value</nobr></th> 
</tr> 
</thead> 
<tbody> 
<?php $i = 1;
$totqty = 0; 
$totvalue = 0;?>
<?php foreach ($exps_dis as $exp) { ?>		
<tr> 
                                                                <td><nobr><?php echo $i; ?></nobr></td>
                                                                <td><nobr><a href="index.php?action=ApprovedList&identificationno=<?php echo $exp['identificationno']; ?>&ignore_month=<?php echo $ignore_month;?>"><font color="DarkBlue"><?php echo $exp['identificationno']; ?></a></nobr></td>
																<td><?php echo $exp['itemCategory']; ?></td>
                                                                <td><?php echo $exp['itemDescription']; ?></td>
                                                                <td><nobr><?php echo $exp['catalogueno']; ?></nobr></td>
                                                                <td><nobr><?php echo $exp['eqptSriNo']; ?></nobr></td>
                                                                <td><nobr><?php echo $exp['purchasedDate']; ?></nobr></td>
                                                                <td><nobr><?php echo $exp['receivedDate']; ?></nobr></td>
																<td><nobr><?php echo $exp['disposedDate']; ?></nobr></td>
                                                                <td align="right"><nobr><?php echo number_format($exp['unitValue'], 2, '.', ','); ?></nobr></td>
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
	  <td align="right"><?php echo number_format($totvalue, 2, '.', ','); ?></td>
	</tr>
  </tfoot> 
</table>							</div>
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
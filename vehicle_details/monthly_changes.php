<?php include 'header1.php'; ?>
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
            <h2>Plant & Machinery Monthly Change Details List</h2>
            <span class="title_wrapper_left"></span>
            <span class="title_wrapper_right"></span>
        </div>
    <div class="section table_section">
	        <form action="." method="post" id="search_Expendable__form" class="search_form general_form">
            <input type="hidden" name="action" value="monthly_changes"/>
			<table width="100%" border="0" class="listing form">
                <tr>
                    <td><b>Month Change: </b></td> 
					<td><input name="receivedDate" id="receivedDate" class="date-picker" value="<?php echo $receivedDate; ?>"/></td>
				</tr>
								<tr>
                    <td></td> 
					<td><input type="checkbox" name="ignore_month" value="1"> Ignore Month</td>
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
		<table id="abc" class="tablesorter"> 
<thead> 
<tr> 
    <th>S/N</th>  
    <th><nobr><?php echo $tList[1][$lang]?></nobr></th>
	<th><nobr>Identification No</nobr></th>
    <th><?php echo $tList[3][$lang]?></th> 
	<th><?php echo $tList[4][$lang]?></th> 
	<th><nobr>Assets Number</nobr></th> 
	<th><nobr>Classification No</nobr></th>
	<th><nobr>Army No.</nobr></th>
	<th><nobr>Civil No.</nobr></th>
	<th><nobr>Purchased Date</nobr></th>
	<th><nobr>Value</nobr></th>
</tr> 
</thead> 
<tbody> 
<?php $i = 1;
$totqty = 0; 
$totvalue = 0;?>
<?php foreach ($exps as $exp) { ?>		
<tr> 
<td><nobr><?php echo $i; ?></nobr></td>
<td><nobr><?php echo $exp['assetunit']; ?></nobr></td>
<td><nobr><a href="index.php?action=ApprovedList&identificationno=<?php echo $exp['identificationno']; ?>"><font color="DarkBlue"><?php echo $exp['identificationno']; ?></a></nobr></td>	
<td><?php echo $exp['itemCategory']; ?></td>
<td><?php echo $exp['itemDescription']; ?></td>
<td><nobr><?php echo $exp['assetsno']; ?></nobr></td>
<td><nobr><?php echo $exp['catalogueno']; ?></nobr></td>
<td><nobr><?php echo $exp['armyno']; ?></nobr></td>
<td><nobr><?php echo $exp['civilno']; ?></nobr></td>
<td><nobr><?php echo $exp['purchasedDate']; ?></nobr></td>
<td style="text-align:right"><nobr><?php echo number_format($exp['unitValue'], 2, '.', ','); ?></nobr></td>	
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
    <th>S/N</th>  
    <th><nobr><?php echo $tList[1][$lang]?></nobr></th>
	<th><nobr>Identification No</nobr></th>	
    <th><nobr><?php echo $tList[3][$lang]?></nobr></th> 
	<th><nobr><?php echo $tList[4][$lang]?></nobr></th> 
	<th><nobr>Assets Number</nobr></th> 
	<th><nobr>Classification No</nobr></th>
	<th><nobr>Army No.</nobr></th>
	<th><nobr>Civil No.</nobr></th>
	<th><nobr>Purchased Date</nobr></th>
	<th><nobr>Disposal Date</nobr></th>
	<th><nobr>Value</nobr></th> 
</tr> 
</thead> 
<tbody> 
<?php $i = 1;
$totqty = 0; 
$totvalue = 0;?>
<?php foreach ($exps_dis as $exp) { ?>		
<tr> 
<td><nobr><?php echo $i; ?></nobr></td>
<td><nobr><?php echo $exp['assetunit']; ?></nobr></td>
<td><nobr><a href="index.php?action=ApprovedList&identificationno=<?php echo $exp['identificationno']; ?>"><font color="DarkBlue"><?php echo $exp['identificationno']; ?></a></nobr></td>	
<td><?php echo $exp['itemCategory']; ?></td>
<td><?php echo $exp['itemDescription']; ?></td>
<td><nobr><?php echo $exp['assetsno']; ?></nobr></td>
<td><nobr><?php echo $exp['catalogueno']; ?></nobr></td>
<td><nobr><?php echo $exp['armyno']; ?></nobr></td>
<td><nobr><?php echo $exp['civilno']; ?></nobr></td>
<td><nobr><?php echo $exp['purchasedDate']; ?></nobr></td>
<td><nobr><?php echo $exp['disposedDate']; ?></nobr></td>
<td style="text-align:right"><nobr><?php echo number_format($exp['unitValue'], 2, '.', ','); ?></nobr></td>	
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
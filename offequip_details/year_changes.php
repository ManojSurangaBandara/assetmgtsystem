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
            <h2>Office Equipments Monthly Change Details List</h2>
            <span class="title_wrapper_left"></span>
            <span class="title_wrapper_right"></span>
        </div>
    <div class="section table_section">
	        <form action="." method="post" id="search_Expendable__form" class="search_form general_form">
            <input type="hidden" name="action" value="monthly_changes"/>
			<table width="100%" border="0" class="listing form">
                <tr>
                    <td><b>Year: </b></td> 
					<td><input name="receivedDate" id="receivedDate" class="date-picker" value="<?php echo $year; ?>"/></td>
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
    <th><nobr><?php echo $tList[3][$lang]?></nobr></th> 
	<th><?php echo $tList[4][$lang]?></th> 
	<th>Assets Number</th> 
	<th>Classification No</th> 
	<th><nobr>Quantity</nobr></th> 
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
<td><nobr><?php echo $exp['itemCategory']; ?></nobr></td>
<td><a href="index.php?action=monthly_changes_2&id=1&year=<?php echo $year;?>&month=<?php echo $month;?>&catalogueno=<?php echo $exp['catalogueno'];?>&ignore_month=<?php echo $ignore_month;?>"><font color="DarkBlue"><?php echo $exp['itemDescription']; ?></a></td>
<td><nobr><?php echo $exp['assetsno']; ?></nobr></td>
<td><nobr><?php echo $exp['catalogueno']; ?></nobr></td>
<td align="right"><nobr><?php echo $exp['cnt']; ?></nobr></td>
<td style="text-align:right"><nobr><?php echo number_format($exp['tot'], 2, '.', ','); ?></nobr></td>
</tr> 
 <?php $i++; 
 $totqty = $totqty + $exp['cnt']; 
 $totvalue = $totvalue + $exp['tot']; ?>
<?php } ?> 
</tbody>
	<tfoot>
	<tr>
	<td></td>
	<td>Total</td>
	<td></td>
	<td></td>
	<td></td>
	<td align="right"><?php echo number_format($totqty, 0, '.', ','); ?></td>	
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
    <th><nobr><?php echo $tList[3][$lang]?></nobr></th> 
	<th><?php echo $tList[4][$lang]?></th> 
	<th>Assets Number</th> 
	<th>Classification No</th> 
	<th align="right"><nobr>Quantity</nobr></th> 
	<th align="right"><nobr>Value</nobr></th> 
</tr> 
</thead> 
<tbody> 
<?php $i = 1;
$totqty = 0; 
$totvalue = 0;?>
<?php foreach ($exps_dis as $exp) { ?>		
<tr> 
<td><nobr><?php echo $i; ?></nobr></td>	
<td><nobr><?php echo $exp['itemCategory']; ?></nobr></td>
<td><a href="index.php?action=monthly_changes_2&id=1&year=<?php echo $year;?>&month=<?php echo $month;?>&catalogueno=<?php echo $exp['catalogueno'];?>&ignore_month=<?php echo $ignore_month;?>"><font color="DarkBlue"><?php echo $exp['itemDescription']; ?></a></td>
<td><nobr><?php echo $exp['assetsno']; ?></nobr></td>
<td><nobr><?php echo $exp['catalogueno']; ?></nobr></td>
<td align="right"><nobr><?php echo $exp['cnt']; ?></nobr></td>
<td style="text-align:right"><nobr><?php echo number_format($exp['tot'], 2, '.', ','); ?></nobr></td>
</tr> 
 <?php $i++; 
 $totqty = $totqty + $exp['cnt']; 
 $totvalue = $totvalue + $exp['tot']; ?>
<?php } ?> 
</tbody>
	<tfoot>
	<tr>
	<td></td>
	<td>Total</td>
	<td></td>
	<td></td>
	<td></td>
	<td align="right"><?php echo number_format($totqty, 0, '.', ','); ?></td>	
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
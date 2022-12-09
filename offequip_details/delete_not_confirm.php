<?php
include 'header1.php';
?>
<script>
$(document).ready(function(){
var my_options = $("#searchby option");
var selected = $("#searchby").val(); /* preserving original selection, step 1 */

my_options.sort(function(a,b) {
    if (a.text > b.text) return 1;
    else if (a.text < b.text) return -1;
    else return 0
})

$("#searchby").empty().append( my_options );
$("#searchby").val(selected); /* preserving original selection, step 2 */
$(".tablesorter").tablesorter(); 
});
</script>
<div id="page">

    <div class="section table_section">
        <form action="." method="post" id="search_Expendable__form">
            <input type="hidden" name="action" value="Delete_Not_Confirm"/>
            <table width="100%" border="0">
                <tr>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td>
                        <b><?php echo $tList[0][$lang]?></b>
                    </td>
                    <td>
                        <select name="assetscenter" onChange="getAssetsUnitByCenter('index.php?action=findAssetsUnitsByCenter&center=' + this.value)">
                            <option value=""></option>
                            <?php foreach ($assetsCenters as $center) { ?>
                                <option value="<?php echo $center->getName(); ?>" <?php if ($assetscenter == $center->getName()) echo "selected = 'selected'"; ?>>
                                    <?php echo $center->getName(); ?>
                                </option>
                            <?php } ?>
                        </select>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <b><?php echo $tList[1][$lang]?></b>
                    </td>
                    <td>   
                        <div id="Unitdiv">
                            <select name="assetunit" onChange="getPresentUnitByUnit('index.php?action=findPresentUnitByUnit&unit=' + this.value)">
                                <option value=""></option>
                                <?php foreach ($assetunits as $unit) { ?>
                                    <option value="<?php echo $unit->getName(); ?>" <?php if ($assetunit == $unit->getName()) echo "selected = 'selected'"; ?>>
                                        <?php echo $unit->getName(); ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </td>
                <tr>
                    <td></td>
                    <td>
                        <b><?php echo $inqtype[$lang]?></b>
                    </td>
                    <td>

                        <select name="searchby" id="searchby" >
                            <option value="Identification Number"  <?php if ($searchby == "Identification Number") echo "selected = 'selected'"; ?>>Identification Number</option>
                            <option value="Main Category"  <?php if ($searchby == "Main Category") echo "selected = 'selected'"; ?>>Main Category</option>
                            <option value="Item Category" <?php if ($searchby == "Item Category") echo "selected = 'selected'"; ?>>Item Category</option>
                            <option value="Item Description" <?php if ($searchby == "Item Description") echo "selected = 'selected'"; ?>>Item Description</option>
                            <option value="Catalogue Number" <?php if ($searchby == "Catalogue Number") echo "selected = 'selected'"; ?>>Catalogue Number</option>
                            <option value="Assets Number" <?php if ($searchby == "Assets Number") echo "selected = 'selected'"; ?>>Assets Number</option>
                            <option value="Classification No" <?php if ($searchby == "Classification No") echo "selected = 'selected'"; ?>>Classification No</option>
                            <option value="Ledger Number" <?php if ($searchby == "Ledger Number") echo "selected = 'selected'"; ?>>Ledger Number</option>
                            <option value="Ledger Folio Number" <?php if ($searchby == "Ledger Folio Number") echo "selected = 'selected'"; ?>>Ledger Folio Number</option>
                            <option value="Serial Number" <?php if ($searchby == "Serial Number") echo "selected = 'selected'"; ?>>Serial Number</option>
                            <option value="Date of Purchased" <?php if ($searchby == "Date of Purchased") echo "selected = 'selected'"; ?>>Date of Purchased</option>
                            <option value="Date of Received" <?php if ($searchby == "Date of Received") echo "selected = 'selected'"; ?>>Date of Received</option>
                        </select>
                    </td>
                    <td>
                        <div id="Itmdiv">
                            <input type="text" class="text" name="search"  id="search" value="<?php echo $search; ?>"/>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td><b><?php echo $tList[10][$lang]?></b></td> <td> <b>From :</b> 
                    
                        <input type='text' class="text" name="inputField1" value="<?php echo $inputField1; ?>" id="inputField1" style="width:90px;"/>
                       
                    </td><td><b>To :</b>
                        <input type='text' class="text" name="inputField2" value="<?php echo $inputField2; ?>" id="inputField2" style="width:90px;"/></td>
            </td>    
            </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td>  
                        <input type="submit" value="Search" />

                    </td>
                    <td>  

                        <input type="checkbox" name="ExpToExcel" value="1" /> <?php echo $expexcel[$lang]?>
 

                        <input type="checkbox" name="ExpToPdf" value="1" /> <?php echo $exppdf[$lang]?>
                    </td> 
                </tr>
            </table>
        </form>
        <div class="title_wrapper">
            <h2>Office Equipment Details Not Confirm List</h2>
            <span class="title_wrapper_left"></span>
            <span class="title_wrapper_right"></span>
        </div>
		
		<table id="myTable1" class="tablesorter"> 
<thead> 
<tr> 
    <th>S/N</th> 
    <th>Identification No</th> 
    <th>Category</th> 
    <th>Description</th> 
    <th>Asset No</th> 
	<th>Catalogue No</th> 
	<th>Ledger No</th> 
	<th>Folio No</th> 
	<th>DOP</th> 
	<th>DOR</th> 
	<th>Unit Value</th> 
</tr> 
</thead> 
<tbody> 
<?php $i = 1; ?>
<?php foreach ($items as $exp) { ?>		
<tr> 
<td><?php echo $i; ?></td>
<td><?php echo $exp['identificationno']; ?></td>	
<td><?php echo $exp['itemCategory']; ?></td>
<td><?php echo $exp['itemDescription']; ?></td>
<td><?php echo $exp['assetsno']; ?></td>
<td><?php echo $exp['catalogueno']; ?></td>
<td><?php echo $exp['ledgerno']; ?></td>
<td><?php echo $exp['ledgerFoliono']; ?></td>
<td><?php echo $exp['purchasedDate']; ?></td>
<td><?php echo $exp['receivedDate']; ?></td>	
<td align="right"><?php echo $exp['unitValue']; ?></td>
<td>
	<form action="." method="post">
	<input type="hidden" name="action" value="Delete_Not_Confirm" />
	<input type="hidden" name="groupId" value="<?php echo $exp['groupId']; ?>"/>
	<input type="hidden" name="assetscenter" value="<?php echo $assetscenter; ?>"/>
	<input type="hidden" name="assetunit" value="<?php echo $assetunit; ?>"/>
	<input type="hidden" name="searchby" value="<?php echo $searchby; ?>"/>
	<input type="hidden" name="search" value="<?php echo $search; ?>"/>
	<input name="submit" type="submit" value="Delete" onClick = "javascript: return confirm('Are you SURE you wish to Delete Item?');"/>
	</form>
</td>
</tr> 
 <?php $i++; ?>
                                                        <?php } ?> 
</tbody> 
</table>
       <div class="section_content">
             <div class="sct">
                <div class="sct_left">
                    <div class="sct_right">
                        <div class="sct_left">
                            <div class="sct_right">
                            <!--    <fieldset>

                                    <div class="table_wrapper_inner">
                                        <table id="myTable" class="tablesorter cellpadding="1" cellspacing="0" width="100%" border="1" BORDERCOLOR=skyblue style="font-size:11px;">
										<thead> 
										<tr> 
                                            <col width="10">
                                            <col width="200">
                                            <th>SNo</th>
                                            <th><a>Identification No.</a></th>
											<?php 
											if ($checkAllowType == 1 && $allocation == 2) { ?>
											<th><a>Allo. Unit</a></th>
											<?php }; ?>
                                            <th><a>Category</a></th>
                                            <th><a>Description</a></th>
                                            <th><a>Asset No</a></th>
                                            <th><a>Calalogue No</a></th>
                                            <th><a>Ledger No</a></th>
                                            <th><a>Folio No</a></th>
                                            <th><a>DOP</a></th>
                                            <th><a>DOR<a></th>
                                            <!-- <th><a>Quantity</a></th>  
                                                        <th><a>Unit Value</a></th>
                                                        <!-- <th><a>Total Value</a></th>  
														</tr> 
														</thead> 
                                                        <tbody>
                                                        <?php $i = 1; ?>
                                                        <?php foreach ($items as $exp) { ?>																
                                                            <tr>
                                                                <td><?php echo $i; ?></td>
                                                                <td><a href="index.php?action=Inquiry_List_Details&assetunit=<?php echo $assetunit; ?>&searchby=<?php echo $searchby; ?>&search=<?php echo $search; ?>&identificationno=<?php echo $exp['identificationno']; ?>&inputField1=<?php echo $inputField1; ?>&inputField2=<?php echo $inputField2; ?>"><font color="DarkBlue"><?php echo $exp['identificationno']; ?></a></td>
                                                                <?php if ($checkAllowType == 1 && $allocation == 2) { ?>
																<td><?php echo $exp['presentLocation']; ?></td>
																<?php }; ?>
																<td><?php echo $exp['itemCategory']; ?></td>
                                                                <td><?php echo $exp['itemDescription']; ?></td>
                                                                <td><?php echo $exp['assetsno']; ?></td>
                                                                <td><?php echo $exp['catalogueno']; ?></td>
                                                                <td><?php echo $exp['ledgerno']; ?></td>
                                                                <td><?php echo $exp['ledgerFoliono']; ?></td>
                                                                <td><?php echo $exp['purchasedDate']; ?></td>
                                                                <td><?php echo $exp['receivedDate']; ?></td>
                                                                <!-- <td><?php echo $exp['quantity']; ?></td>  
                                                                <td align="right"><?php echo $exp['unitValue']; ?></td>
                                                                <!-- <td><?php echo $exp['totalCost']; ?></td>  
                                                            </tr>
                                                            <?php $i++; ?>
                                                        <?php } ?> 
                                                        </tbody></table>
                                                        </div>

                                                        </fieldset>-->

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
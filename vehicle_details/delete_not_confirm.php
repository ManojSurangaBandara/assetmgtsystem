<?php include 'header1.php'; ?>
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
//$(".tablesorter").tablesorter(); 
});
</script>
<div id="page">

    <div class="section table_section">
        <form action="." method="post" id="search_Expendable__form">
            <input type="hidden" name="action" value="delete_not_confirm"/>
            <table width="100%" border="0">
                <tr>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td>
                        <b><?php echo $tList[0][$lang]?></b> </td>
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
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <b><?php echo $inqtype[$lang]?></b>
                    </td>
                    <td>

                        <select name="searchby" id="searchby" >
                            <option value="Identification Number"  <?php if ($searchby == "Identification Number") echo "selected = 'selected'"; ?>>Identification Number</option>
                            <option value="Category"  <?php if ($searchby == "Category") echo "selected = 'selected'"; ?>>Category</option>
                            <option value="Catalogue Number" <?php if ($searchby == "Catalogue Number") echo "selected = 'selected'"; ?>>Catalogue Number</option>
                            <option hidden value="Make" <?php if ($searchby == "Make") echo "selected = 'selected'"; ?>>Make</option>
                            <option hidden value="Modle" <?php if ($searchby == "Modle") echo "selected = 'selected'"; ?>>Modle</option>
                            <option value="Assets No" <?php if ($searchby == "Assets No") echo "selected = 'selected'"; ?>>Assets No</option>
                            <option value="Engine Number" <?php if ($searchby == "Engine Number") echo "selected = 'selected'"; ?>>Engine Number</option>
                            <option value="Chassis Number" <?php if ($searchby == "Chassis Number") echo "selected = 'selected'"; ?>>Chassis Number</option>
                            <option value="Year manufactured" <?php if ($searchby == "Year manufactured") echo "selected = 'selected'"; ?>>Year manufactured</option>
                            <option value="Ownership" <?php if ($searchby == "Ownership") echo "selected = 'selected'"; ?>>Ownership</option>
                            <option value="Army Number" <?php if ($searchby == "Army Number") echo "selected = 'selected'"; ?>>Army Number</option>
                            <option value="Civil Number" <?php if ($searchby == "Civil Number") echo "selected = 'selected'"; ?>>Civil Number</option>
                            <option value="Fuel" <?php if ($searchby == "Fuel") echo "selected = 'selected'"; ?>>Fuel</option>
                            <option value="Date of Purchased" <?php if ($searchby == "Date of Purchased") echo "selected = 'selected'"; ?>>Date of Purchased</option>
                            <option value="Unit Value" <?php if ($searchby == "Unit Value") echo "selected = 'selected'"; ?>>Unit Value</option>
                            <option value="Horse Power" <?php if ($searchby == "Horse Power") echo "selected = 'selected'"; ?>>Horse Power</option>
                            <option value="Tare" <?php if ($searchby == "Tare") echo "selected = 'selected'"; ?>>Tare</option>
                            <option value="Present Location" <?php if ($searchby == "Present Location") echo "selected = 'selected'"; ?>>Present Location</option>
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
                    <td><b><?php echo $tList[14][$lang]?></b></td> <td> <b>From :</b>
                        <input type='text' class="text" name="inputField1" value="<?php echo $inputField1; ?>" id="inputField1" style="width:90px;"/>
                        <b>To :</b>
                        <input type='text' class="text" name="inputField2" value="<?php echo $inputField2; ?>" id="inputField2" style="width:90px;"/></td>
                </tr>		
                <tr>
                    <td></td>
                    <td></td>
                    <td>  
                        <input type="submit" value="Search" />

                    </td> 
                </tr>
            </table>
        </form>
        <div class="title_wrapper">
            <h2>Vehicle Details - Not Conform List</h2>
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
                                            <col width="200">
                                            <th>S/N</th>
                                            <th><a>Identification No</a></th>                                            
											<th><a>Category</a></th>
                                            <th><a>Description</a></th>
                                            <th><a>Make</a></th>
                                            <th><a>Model</a></th>
                                            <th><a>Asset No</a></th>
                                            <th><a>Engine No</a></th>
                                            <th><a>Chassis No</a></th>
                                            <th><a>Army No</a></th>
                                            <th><a>DOP</a></th>
                                            <th><a>DOR<a></th>
                                                        <th><a>Unit Value</a></th>
                                                        <!-- <th><a>Total Value</a></th> -->
                                                        </tr>
                                                        <?php $i = 1; ?>
                                                        <?php foreach ($items as $exp) { ?>																
                                                            <tr>
                                                                <td><?php echo $i; ?></td>
                                                                <td><a href="index.php?action=Inquiry_List_Details&assetunit=<?php echo $assetunit; ?>&searchby=<?php echo $searchby; ?>&search=<?php echo $search; ?>&identificationno=<?php echo $exp['identificationno']; ?>&inputField1=<?php echo $inputField1; ?>&inputField2=<?php echo $inputField2; ?>"><font color="DarkBlue"><?php echo $exp['identificationno']; ?></a></td>
                                                                <td><?php echo $exp['itemCategory']; ?></td>
                                                                <td><?php echo $exp['itemDescription']; ?></td>
                                                                <td><?php echo $exp['make']; ?></td>
                                                                <td><?php echo $exp['modle']; ?></td>
                                                                <td><?php echo $exp['assetsno']; ?></td>
                                                                <td><?php echo $exp['engineno']; ?></td>
                                                                <td><?php echo $exp['chessisno']; ?></td>
                                                                <td><?php echo $exp['armyno']; ?></td>
                                                                <td><?php echo $exp['purchasedDate']; ?></td>
                                                                <td><?php echo $exp['receivedDate']; ?></td>
                                                                <td align="right"><?php echo $exp['unitValue']; ?></td>
                                                                <td>
														<form action="." method="post">
														<input type="hidden" name="action" value="delete_not_confirm" />
														<input type="hidden" name="id" value="<?php echo $exp['id']; ?>"/>
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
//include('sidebar.php');
                                                        include '../view/footer.php';
                                                        ?>
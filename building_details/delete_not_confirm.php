<?php include 'header1.php'; ?>
<div id="page">
    <div class="section table_section">
        <form action="." method="post" id="search_Expendable__form"  class="search_form general_form">
            <input type="hidden" name="action" value="delete_not_confirm"/>
            <table width="100%" border="0">
                <tr>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
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
                </tr>
                <tr>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
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
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td>
                        <b><?php echo $inqtype[$lang]?></b>
                    </td>
                    <td>

                        <select name="searchby" >                       
							<option value="Assets No" <?php if ($searchby == "Assets No") echo "selected = 'selected'"; ?>>Assets No</option>
							<option value="Building Category" <?php if ($searchby == "Building Category") echo "selected = 'selected'"; ?>>Building Category</option>
							<option value="Building Number" <?php if ($searchby == "Building Number") echo "selected = 'selected'"; ?>>Building Number</option>
							<option value="Building Type" <?php if ($searchby == "Building Type") echo "selected = 'selected'"; ?>>Building Type</option>
							<option value="Classification No" <?php if ($searchby == "Classification No") echo "selected = 'selected'"; ?>>Classification No</option>
							<option value="Construction Cost" <?php if ($searchby == "Construction Cost") echo "selected = 'selected'"; ?>>Construction Cost</option>
							<option value="Date of Acquisition" <?php if ($searchby == "Date of Acquisition") echo "selected = 'selected'"; ?>>Date of Acquisition</option>
							<option value="District" <?php if ($searchby == "District") echo "selected = 'selected'"; ?>>District</option>
							<option value="DS Division" <?php if ($searchby == "DS Division") echo "selected = 'selected'"; ?>>DS Division</option>
							<option value="GS Division" <?php if ($searchby == "GS Division") echo "selected = 'selected'"; ?>>GS Division</option>
							<option value="Identification Number"  <?php if ($searchby == "Identification Number") echo "selected = 'selected'"; ?>>Identification Number</option>
							<option value="Name of Land" <?php if ($searchby == "Name of Land") echo "selected = 'selected'"; ?>>Name of Land</option>							
							<option value="Nature of the Ownership" <?php if ($searchby == "Nature of the Ownership") echo "selected = 'selected'"; ?>>Nature of the Ownership</option>
							<option value="Ownership" <?php if ($searchby == "Ownership") echo "selected = 'selected'"; ?>>Ownership</option>
							<option value="Plan Date" <?php if ($searchby == "Plan Date") echo "selected = 'selected'"; ?>>Plan Date</option>
							<option value="Plan Number" <?php if ($searchby == "Plan Number") echo "selected = 'selected'"; ?>>Plan Number</option>
							<option value="Province"  <?php if ($searchby == "Province") echo "selected = 'selected'"; ?>>Province</option>							
                        </select>

                    </td>
                    <td>
                        <div id="Itmdiv">
                            <input type="text" class="text" name="search"  id="search" value="<?php echo $search; ?>" style="width:200px;"/>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td><b><?php echo $tList[24][$lang]?></b></td> <td> <b>From :</b>
                        <input type='text' class="text" name="inputField1" value="<?php echo $inputField1; ?>" id="inputField1" style="width:90px;"/>
                        <b>To :</b>
                        <input type='text' class="text" name="inputField2" value="<?php echo $inputField2; ?>" id="inputField2" style="width:90px;"/></td>
                </tr>
                <tr>
                <td> </td>
                <td> </td>
                <td>  
                    <input type="submit" value="Search" />
                </td>
                <td><input type="checkbox" name="ExpToExcel" value="1" /> <?php echo $expexcel[$lang]?> 
                    <input type="checkbox" name="ExpToPdf" value="1" /><?php echo $exppdf[$lang]?></td>
                </tr>
            </table>
        </form>
        <div class="title_wrapper">
            <h2>Building Details - Not Confirm List</h2>
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
                                            <th><a>Building Category</a></th>
                                            <th><a>Building Type</a></th>

                                            <th><a>Name of Land</a></th>
                                            <th><a>District</a></th>
                                            <th><a>DS Division</a></th>

                                            <th><a>Area(SQFT)</a></th>
                                            <th><a>Construction Cost</a></th>
                                            <th><a>Building Value</a></th>
                                            <th><a>DOR</a></th>
                                            <th><a>Name of the Owner</a></th>
                                            </tr>
                                            <?php $i = 1; ?>
                                            <?php foreach ($items as $exp) { ?>																
                                                <tr class=<?php
                                                if ($i % 2) {
                                                    echo "first";
                                                } else {
                                                    echo "second";
                                                }
                                                ?>>
                                                    <td><?php echo $i; ?></td>
                                                    <td><a href="index.php?action=Inquiry_List_Details&assetunit=<?php echo $assetunit; ?>&searchby=<?php echo $searchby; ?>&search=<?php echo $search; ?>&identificationno=<?php echo $exp['identificationno']; ?>&inputField1=<?php echo $inputField1; ?>&inputField2=<?php echo $inputField2; ?>"><font color="DarkBlue"><?php echo $exp['identificationno']; ?></a></td>
                                                    <td><?php echo $exp['buildingCategory']; ?></td>
                                                    <td><?php echo $exp['buildingType']; ?></td>

                                                    <td><?php echo $exp['landname']; ?></td>
                                                    <td><?php echo $exp['district']; ?></td>
                                                    <td><?php echo $exp['dsDivision']; ?></td>

                                                    <td><?php echo $exp['area']; ?></td>
                                                    <td><?php echo $exp['constructionCost']; ?></td>
                                                    <td><?php echo $exp['alterationValue']; ?></td>
                                                    <td><?php echo $exp['acquisitiondate']; ?></td>
                                                    <td><?php echo $exp['ownerName']; ?></td>
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
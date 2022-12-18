<?php
include '../view/header1.php';
?>
<div id="sec_menu">
    <?php include("sub_menu.tpl"); ?>
</div>

<div id="page">

    <div class="section table_section">
        <form action="." method="post" id="search_Expendable__form">
            <input type="hidden" name="action" value="List_Inquiry"/>
            <table border="0">
                <tr>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td>
                        <b>Tender Number : </b>
                    </td>
                    <td>
                        <select name="tenderno" onChange="getAssetsUnitByCenter('index.php?action=findtenderdetailsBytenderno&tenderno=' + this.value)">
                            <option value=""></option>
                            <?php foreach ($items as $item) { ?>
                                <option value="<?php echo $item['tenderno']; ?>" <?php if ($tenderno == $item['tenderno']) echo "selected = 'selected'"; ?>>
                                    <?php echo $item['tenderno']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                    </td>

                    <td>   
                    </td>
                </tr>

                <tr>
                    <td>
                    </td>
                    <td>
                        <input type="checkbox" name="ExpToExcel" value="1" /> <?php echo $expexcel[$lang]?>
                        <input type="checkbox" name="ExpToPdf" value="1" /> <?php echo $exppdf[$lang]?>
                    </td> <td>  
                        <input type="submit" value="Search" /> 
                    </td>
                </tr>
            </table>
        </form>
		<div id="Unitdiv">
        <div class="title_wrapper">
            <h2>Tender Details List</h2>
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
                                   <div class="table_wrapper">
													<div class="table_wrapper_inner">
														<table cellpadding="0" cellspacing="0" width="100%" >
														<tbody><tr>
															<th>&nbsp;</th>
															<th>Lot No.</th>
															<th>Vehicle No.</th>
															<th>Vehicle Description</th>
															<th>Estimate Amount</th>
															<th>Tender Amount</th>
															<th>Buyer Name</th>
														</tr>
														<?php $i = 1; ?>
														<?php foreach($exps as $exp) { ?>																
														<tr class=<?php if ($i % 2) {
																		echo "first";
																		} else {
																		echo "second";
																		}?>>
															<td><?php echo $i; ?></td>
															<td><?php echo $exp['lotno']; ?></td>
															<td><?php echo $exp['armyno']; ?></td>
															<td><?php echo $exp['itemDescription'];?></td>
															<td><?php echo $exp['estimatevalue']; ?></td>
															<td><?php echo number_format((float)$exp['tendervalue'], 2,".",","); ?></td>
															<td><?php echo $exp['buyername']; ?></td>
														</tr>
														<?php $i++; ?>
														<?php }  ?>
													  </tbody>
													  </table>
													  </div>
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

</div>
<?php
//include('sidebar.php');
include '../view/footer.php';
?>
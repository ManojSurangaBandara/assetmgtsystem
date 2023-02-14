<?php
include 'header5.php';
?>

<style>
a.paging:link, a:visited {
    background-color: #5CB3FF;
    color: white;
    padding: 4px 5px;
    text-align: center;	
    text-decoration: none;
    display: inline-block;
}


a.paging:hover, a:active {
    background-color: #157DEC;
}
</style>
<div id="page">

    <div class="section table_section">
        <div class="title_wrapper">
            <h2>Office Equipment List - Non Public Items</h2>
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
<?php
echo "<a href='index.php?action=np_Paging_List&page1=1' class='paging'>First Page</a>";
for ($j=1; $j<=$total_pages; $j++) {
	echo "<a href='index.php?action=np_Paging_List&page1=$j' class='paging'>$j</a>";
};
$last_page_no = $total_pages ? $total_pages : 1;
echo "<a href='index.php?action=np_Paging_List&page1=$last_page_no'  class='paging'>Last Page</a>";
?>
                                    <div class="table_wrapper_inner">
                                        <table id="abc" cellpadding="1" cellspacing="0" width="100%" border="1" BORDERCOLOR=skyblue style="font-size:11px;">

                                            <tbody>
                                          <!--  <col width="10">
                                            <col width="185"> -->
                                            <th><nobr>S/N</nobr></th>
                                            <th><nobr>Identification No</nobr></th>
                                            <th><nobr>Category</nobr></th>
                                            <th><nobr>Description</nobr></th>
                                            <th><nobr>Asset No</nobr></th>
                                            <th><nobr>Catalogue No</nobr></th>
                                            <th><nobr>Serial No.</nobr></th>
                                            <th><nobr>Present Locaton</nobr></th>
                                            <th><nobr>DOP</nobr></th>
                                            <th><nobr>DOR</nobr></th>
                                            <th><nobr>Unit Value</nobr></th>
                                                        </tr>                                                     
                                                        <?php foreach ($items as $exp) { ?>																
                                                            <tr bgcolor=<?php
                                                            switch ($exp['selectDisposal'] + $exp['confirmDisposal']) {
                                                                case '1':
                                                                    echo "#66FF00";
                                                                    break;
                                                                case '2':
                                                                    echo "#04860F";
                                                                    break;
                                                            }
															switch ($exp['transferSelect'] + $exp['transferToConfirm']) {
                                                                case '1':
                                                                    echo "#66FFFF";
                                                                    break;
                                                                case '2':
                                                                    echo "#466DFA";
                                                                    break;
                                                            }
															// if (($assetscenter == $assetunit) && ($exp['presentLocation'] != $assetunit)) {
																if ($exp['presentLocation'] != $exp['assetunit']) {
																echo "#EE82EE"; }
                                                            ?>>
                                                                <td><nobr><?php echo $i; ?></nobr></td>
                                                                <td><nobr><a href="index.php?action=ApprovedList&identificationno=<?php echo $exp['identificationno']; ?>"><font color="DarkBlue"><?php echo $exp['identificationno']; ?></a></nobr></td>
                                                                <td><nobr><?php echo $exp['itemCategory']; ?></nobr></td>
                                                                <td><nobr><?php echo $exp['itemDescription']; ?></nobr></td>
                                                                <td><nobr><?php echo $exp['assetsno']; ?></nobr></td>
                                                                <td><nobr><?php echo $exp['catalogueno']; ?></nobr></td>
                                                                <td><nobr><?php echo $exp['eqptSriNo']; ?></nobr></td>
                                                                <td><nobr><?php echo $exp['presentLocation']; ?></nobr></td>
                                                                <td><nobr><?php echo $exp['purchasedDate']; ?></nobr></td>
                                                                <td><nobr><?php echo $exp['receivedDate']; ?></nobr></td>
                                                                <!-- <td><?php echo $exp['quantity']; ?></td> -->
                                                                <td align="right"><nobr><?php echo $exp['unitValue']; ?></nobr></td>
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
															<iframe id="txtArea1" style="display:none"></iframe>
															<button id="btnExport" onclick="fnExcelReport();">Export to Excel</button>
															<button onclick="generate()">Export to pdf</button>
															<script src="../jspdf/libs/jspdf.min.js"></script>
															<script src="../jspdf/libs/jspdf.plugin.autotable.src.js"></script>
															<script>
																function generate() {
																	 var doc = new jsPDF('l', 'pt', 'a2');
																	doc.text("Plant & Machinery Details List", 30, 50);
																	var res = doc.autoTableHtmlToJson(document.getElementById("abc"));
																	doc.autoTable(res.columns, res.data, {startY: 60});
																	doc.save("table.pdf");
																}
															</script>
                                                            <span class="scb"><span class="scb_left"></span><span class="scb_right"></span></span>						
															</div>
                                                            </div>

                                                            </div>
                                                            <?php
//include('sidebar.php');
                                                            include '../view/footer.php';
                                                            ?>
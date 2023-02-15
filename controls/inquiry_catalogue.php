<?php include 'header5.php';?>
<div id="page">

    <div class="section table_section">
        <form action="." method="post" id="search_Expendable__form">
            <input type="hidden" name="action" value="List_Inquiry"/>
            <table width="100%" border="0">
                <tr>
                    <td>
                        <b>Inquiry Type:</b>
                    </td>
                    <td>

                        <select name="searchby">
                            <option value="Catalogue Number" <?php if ($searchby == "Catalogue Number") echo "selected = 'selected'"; ?>>Catalogue Number</option>
							<option value="Item Category" <?php if ($searchby == "Item Category") echo "selected = 'selected'"; ?>>Item Category</option>
							<option value="Item Description" <?php if ($searchby == "Item Description") echo "selected = 'selected'"; ?>>Item Description</option>
							<option value="Main Category"  <?php if ($searchby == "Main Category") echo "selected = 'selected'"; ?>>Main Category</option>
                            <option value="Make" <?php if ($searchby == "Make") echo "selected = 'selected'"; ?>>Make</option>
                            <option value="Model" <?php if ($searchby == "Modle") echo "selected = 'selected'"; ?>>Model</option>
                            <option value="New Classification of Asset" <?php if ($searchby == "New Classification of asset") echo "selected = 'selected'"; ?>>New Classification of Asset</option>
                            <option value="Present Asset No" <?php if ($searchby == "Present Asst No") echo "selected = 'selected'"; ?>>Present Asset No</option>
                        </select>

                    </td>
                    <td>
                        <input type="text" class="text" name="search"  id="search" list="searchs" value="<?php echo $search; ?>"/>
                    </td>
                    <td>  
                        <input type="submit" value="Search" />

                    </td>

                    <td>  

                        <input type="checkbox" name="ExpToExcel" value="1" /> Export to Excel
                    </td> 
                    <td>  

                        <input type="checkbox" name="ExpToPdf" value="1" /> Export to PDF
                    </td> 

                </tr>
            </table>
        </form>
        <div class="title_wrapper">
            <h2>Fixed Assets Details List</h2>
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
                                        <table id="abc" class="tablesorter" cellpadding="1" cellspacing="0" width="100%" border="1" BORDERCOLOR=skyblue style="font-size:11px;">
											<thead>
											<tr>
                                            <th><nobr>S/N</nobr></th>
											<th><nobr>Fixed Assets Type</nobr></th>
                                            <th><nobr>Main Category</nobr></th>
                                            <th><nobr>Item Category</nobr></th>
                                            <th><nobr>Description</nobr></th>
                                            <th><nobr>Capacity</nobr></th>
                                            <th><nobr>Fual</nobr></th>
                                            <th><nobr>Vote Head</nobr></th>
                                            <th><nobr>New Assets No</nobr></th>
                                            <th><nobr>Assets No</nobr></th>
                                            <th><nobr>Catalogue No</nobr></th>
											<th><nobr>Cigas Assetno</nobr></th>
											<th><nobr>DOS Catalogue No</nobr></th>
											</tr>
											</thead>
											<tbody>
                                                        <?php $i = 1; ?>
                                                        <?php foreach ($items as $exp) { ?>																
                                                            <tr>
                                                                <td><nobr><?php echo $i; ?></nobr></td>
																<td><nobr><?php echo ($exp['type'] == 1)?"Office Equipments":(($exp['type'] == 2)?"Plant & Machinery":"Vehicle"); ?></nobr></td>
                                                                <td><nobr><?php echo $exp['mainCategory']; ?></nobr></td>
                                                                <td><nobr><?php echo $exp['itemCategory']; ?></nobr></td>
                                                                <td><nobr><?php echo $exp['itemDescription']; ?></nobr></td>
                                                                <td><nobr><?php echo $exp['make']; ?></nobr></td>
                                                                <td><nobr><?php echo $exp['modle']; ?></nobr></td>
                                                                <td><nobr><?php echo $exp['voteHead']; ?></nobr></td>
                                                                <td><nobr><?php echo $exp['newAssestno']; ?></nobr></td>
                                                                <td><nobr><?php echo $exp['assetsno']; ?></nobr></td>
                                                                <td><nobr><?php echo $exp['catalogueno']; ?></nobr></td>
																<td><nobr><?php echo $exp['cigas_assetno']; ?></nobr></td>
																<td><nobr><?php echo $exp['dos_catalogueno']; ?></nobr></td>
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
																	 var doc = new jsPDF('l', 'pt', 'a1');
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
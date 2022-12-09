<?php include 'header5.php';?>
<div id="page">
    <div class="section table_section">
        <div class="title_wrapper">
            <h2>DOS Assets Catalogue List</h2>
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
											<th><nobr>Item Type</nobr></th>
                                            <th><nobr>Main Category</nobr></th>
											<th><nobr>Sub Category</nobr></th>
											<th><nobr>DAM Catalogue</nobr></th>
                                            <th><nobr>DOS Catalogue</nobr></th>
                                            <th><nobr>Description</nobr></th>
                                            <th><nobr>Asset No.</nobr></th>
                                            <th><nobr>Q Store</nobr></th>
                                            <th><nobr>Vote Head</nobr></th>
											<th><nobr>Vote Name</nobr></th>
											</tr>
											</thead>
											<tbody>
                                                        <?php $i = 1; ?>
                                                        <?php foreach ($items as $exp) { ?>																
                                                            <tr>
                                                                <td><nobr><?php echo $i; ?></nobr></td>
																<td><nobr><?php echo $exp['itemtype']; ?></nobr></td>
																<td><nobr><?php echo $exp['main_category']; ?></nobr></td>
																<td><nobr><?php echo $exp['sub_category']; ?></nobr></td>
                                                                <td><nobr><?php echo $exp['dam_catalogueno']; ?></nobr></td>
                                                                <td><nobr><?php echo $exp['itemcode']; ?></nobr></td>
                                                                <td><nobr><?php echo $exp['description']; ?></nobr></td>
                                                                <td><nobr><?php echo $exp['AsstNo']; ?></nobr></td>
                                                                <td><nobr><?php echo $exp['qstore']; ?></nobr></td>
                                                                <td><nobr><?php echo $exp['votehead']; ?></nobr></td>
                                                                <td><nobr><?php echo $exp['votename']; ?></nobr></td>
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
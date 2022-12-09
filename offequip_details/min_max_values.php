<?php
include 'header1.php';
?>
<div id="page">

    <div class="section table_section">
        <div class="title_wrapper">
            <h2>Office Equipments Minimum and Minimum Values</h2>
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
                                            <th>S/N</th>
											 <th><a>Main Category</a></th>
                                            <th><a>Item Category</a></th>
                                            <th><a>Description</a></th>
                                            <th><a>Catalogue No</a></th>
                                            <th><a>Minimum Value</a></th>
                                            <th><a>Maximum Value</a></th>
                                                        </tr>
                                                        <?php $i = 1; ?>
                                                        <?php foreach ($items as $exp) { ?>																
                                                            <tr>
                                                                <td><?php echo $i; ?></td>
                                                                <td><?php echo $exp['mainCategory']; ?></td>
																<td><?php echo $exp['itemCategory']; ?></td>
                                                                <td><?php echo $exp['itemDescription']; ?></td>
                                                                <td><?php echo $exp['catalogueno']; ?></td>
                                                                <td align="right"><?php echo $exp['mn']; ?></td>
                                                                <td align="right"><?php echo $exp['mx']; ?></td>
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
<?php
include 'header1.php';
?>
<div id="page">

    <div class="section table_section">
        <div class="title_wrapper">
            <h2>Plant & Machinery - Approve Items For Disposal List</h2>
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
                                          <!--  <col width="10">
                                            <col width="185"> -->
                                            <th>SNo</th>
                                            <th><a>Assets Center</a></th>
                                            <th><a>Asset Unit</a></th>
                                            <th><a>Identification No.</a></th>
                                            <th><a>Category</a></th>
                                            <th><a>Description</a></th>
                                            <th><a>Asset No</a></th>
                                            <th><a>Catalogue No</a></th>
                                            <th><a>DOP</a></th>
                                            <th><a>Unit Value</a></th>
                                            </tr>
                                            <?php $i = 1; ?>
                                            <?php foreach ($items as $exp) { ?>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $exp['assetscenter']; ?></td>
                                                <td><?php echo $exp['assetunit']; ?></td>
                                                <td><a href="index.php?action=approve_Disposal&id=<?php echo $exp['id']; ?>"><font color="DarkBlue"><?php echo $exp['identificationno']; ?></a></td>
                                                <td><?php echo $exp['itemCategory']; ?></td>
                                                <td><?php echo $exp['itemDescription']; ?></td>
                                                <td><?php echo $exp['assetsno']; ?></td>
                                                <td><?php echo $exp['catalogueno']; ?></td>
                                                <td><?php echo $exp['purchasedDate']; ?></td>
                                                <td align="right"><?php echo $exp['unitValue']; ?></td>
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
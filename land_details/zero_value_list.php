<?php include 'header1.php'; ?>
<div id="page">
    <div class="section table_section">
        <div class="title_wrapper">
            <h2>Total Zero List</h2>
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
                                            <table id="abc" cellpadding="1" cellspacing="0" width="100%" border="1" BORDERCOLOR=skyblue style="font-size:12px;">
                                                <tbody> 
                                                <th>S/N</th>
                                                <th><a>Assets Centre</a></th>
                                                <th><a>Assets Unit</a></th>                                                
                                                <th><a>Identification No</a></th>
                                                <th><a>District</a></th>
                                                <th><a>Category</a></th>                                                
                                                <th><a>Estimated Value</a></th>
												<th><a>Report Received</a></th>
                                                </tr>
                                                <?php $i = 1; ?>
                                                <?php foreach ($exps as $exp) { ?>																
                                                    <tr class=<?php
                                                    if ($i % 2) {
                                                        echo "first";
                                                    } else {
                                                        echo "second";
                                                    }
                                                    ?>>
                                                        <td><?php echo $i; ?></td>
                                                        <td><?php echo $exp[0]; ?></td>
                                                        <td><?php echo $exp[1]; ?></td>                                                        
                                                        <td><?php echo $exp[2]; ?></td>
                                                        <td><?php echo $exp[3]; ?></td>
                                                        <td><?php echo $exp[4]; ?></td>                                                        
                                                        <td><?php echo $exp[5]; ?></td>
														<td><?php echo $exp[6]; ?></td>
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
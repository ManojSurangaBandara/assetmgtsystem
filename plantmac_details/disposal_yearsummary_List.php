<?php
include 'header1.php';
?>
<div id="page">
    <div class="section table_section">
        <div class="title_wrapper">
            <h2>Plant & Machinery Year Disposal Summary</h2>
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
                                            <thead> 
											<tr> 
                                            <th><nobr>S/N</nobr></th>                                            
                                            <th><nobr>Description</nobr></th>
                                            <th><nobr>Catalogue No</nobr></th>
                                            <th><nobr>Quantity</nobr></th>
                                             </tr>
											 </thead> <tbody> 
                                                        <?php $i = 1; 
														$totvalue = 0; ?>
                                                        <?php foreach ($items as $exp) { ?>																
                                                            <tr>
                                                                <td><nobr><?php echo $i; ?></nobr></td>                                                                
                                                                <td><nobr><?php echo $exp['itemDescription']; ?></nobr></td>                                                               
                                                                <td><nobr><?php echo $exp['catalogueno']; ?></nobr></td>                                                                
                                                                <td align="right"><nobr><?php echo $exp['qty']; ?></nobr></td>
                                                            </tr>
                                                            <?php $i++; ?>
                                                        <?php } ?> 
                                                        </tbody>
																													
														
														</table>
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
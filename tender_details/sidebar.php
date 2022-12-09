<div id="sidebar">
    <div class="inner">
        <p>&nbsp;</p>
        <div class="section">
            <div class="section">
                <div class="title_wrapper">
                    <?php switch ($slidebartype) {
                        case 1:
                            ?>
                            <h2>Buyer Details</h2>
                            <span class="title_wrapper_left"></span>
                            <span class="title_wrapper_right"></span>
                            <?php break;
						case 2:
                            ?>
                            <h2>Tender Numbers</h2>
                            <span class="title_wrapper_left"></span>
                            <span class="title_wrapper_right"></span>
                            <?php break;
						case 3:
                            ?>
                            <h2>Tender Numbers</h2>
                            <span class="title_wrapper_left"></span>
                            <span class="title_wrapper_right"></span>
                            <?php break;}?>
                </div>
                <div class="section_content">
                    <div class="sct">
                        <div class="sct_left">
                            <div class="sct_right">
                                <div class="sct_left">
                                    <div class="sct_right">
                                        <ul class="sidebar_menu">
                                            <?php switch ($slidebartype) {
                                                case 1: 
                                                    if (empty($Items)) {
                                                        ?>
                                                        <img src="../pic/1.jpg" alt="A description of the picture" width="230" height="230" /> 
                                                        <?php
                                                    } else {
                                                        foreach ($Items as $Item) :
                                                            ?>
                                                            <li><a href="?index.php&action=Add_BuyerDetails&id=<?php echo $Item['id']; ?>" title="<?php echo $Item['nicno']; ?>"><?php echo $Item['nicno']; ?> </a></li>            
                                                        <?php endforeach; ?>
                                                        <?php
                                                    }
                                                    break;
												case 2: 
                                                    if (empty($Items)) {
                                                        ?>
                                                        <img src="../pic/1.jpg" alt="A description of the picture" width="230" height="230" /> 
                                                        <?php
                                                    } else {
                                                        foreach ($Items as $Item) :
                                                            ?>
                                                            <li><a href="?index.php&action=update_Tender_Details&id=<?php echo $Item['id']; ?>" title="<?php echo $Item['tenderno']; ?>"><?php echo $Item['tenderno']; ?> </a></li>            
                                                        <?php endforeach; ?>
                                                        <?php
                                                    }
                                                    break;
												case 3: 
                                                    if (empty($Items)) {
                                                        ?>
                                                        <img src="../pic/1.jpg" alt="A description of the picture" width="230" height="230" /> 
                                                        <?php
                                                    } else {
                                                        foreach ($Items as $Item) :
                                                            ?>
                                                            <li><a href="?index.php&action=display_Tender_Details&id=<?php echo $Item['id']; ?>" title="<?php echo $Item['tenderno']; ?>"><?php echo $Item['tenderno']; ?> </a></li>            
                                                        <?php endforeach; ?>
                                                        <?php
                                                    }
                                                    break;													
												default:
														?>
                                                    <img src="../pic/1.jpg" alt="A description of the picture" width="230" height="230" /> 
														<?php } ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <span class="scb"><span class="scb_left"></span><span class="scb_right"></span></span>
                </div>
            </div>
        </div>
<?php include '../view/quick_info.php'; ?>
    </div>
</div>
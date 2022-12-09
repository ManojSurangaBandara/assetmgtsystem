
<div class="section">
    <div class="section">
        <div class="title_wrapper">
            <?php
            switch ($slidebartype) {
                case 12:
                case 3:
				case 4:
                    ?>
                    <h2>Approval Rejected</h2>
                    <span class="title_wrapper_left"></span>
                    <span class="title_wrapper_right"></span>
                    <?php
                    break;
            }
            ?>
        </div>
        <div class="section_content">
            <div class="sct">
                <div class="sct_left">
                    <div class="sct_right">
                        <div class="sct_left">
                            <div class="sct_right">
                                <ul class="sidebar_menu">
                                    <?php
                                    switch ($slidebartype) {
                                         case 12:
                                                    if (empty($Items_Sub)) {
                                                        ?>
                                                        <!-- <img src="../pic/1.jpg" alt="A description of the picture" width="230" height="230" /> -->
                                                        <?php
                                                    } else {
                                                        foreach ($Items_Sub as $Item) :
                                                            ?>                                                            
                                                        <li><a href="?index.php&action=toBeApproveList&identificationno=<?php echo $Item['identificationno']; ?>" title="<?php echo $Item['identificationno']; ?>"><?php echo $Item['identificationno']; ?> </a></li>            
                                                        <?php endforeach; ?>
                                                        <?php
                                                    }
                                                    break;
                                        case 3: 
                                            if (empty($Items_Sub)) {
                                                ?>
                                                <!-- <img src="../pic/1.jpg" alt="A description of the picture" width="230" height="230" /> -->
                                                <?php
                                            } else {
                                                foreach ($Items_Sub as $Item) :
                                                    ?>
                                                    <li><a href="?index.php&action=update_Details&id=<?php echo $Item['id']; ?>" title="<?php echo $Item['identificationno']; ?>"><?php echo $Item['identificationno']; ?> </a></li>            
                                                <?php endforeach; ?>
                                                <?php
                                            }
                                            break;
										case 4: 
                                            if (empty($Items_Sub)) {
                                                ?>
                                                <!-- <img src="../pic/1.jpg" alt="A description of the picture" width="230" height="230" /> -->
                                                <?php
                                            } else {
                                                foreach ($Items_Sub as $Item) :
                                                    ?>
                                                    <li><a href="?index.php&action=upload_plan&id=<?php echo $Item['id']; ?>" title="<?php echo $Item['identificationno']; ?>"><?php echo $Item['identificationno']; ?> </a></li>            
                                                <?php endforeach; ?>
                                                <?php
                                            }
                                            break;
                                    }
                                    ?>
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

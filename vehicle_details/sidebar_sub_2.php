
<div class="section">
    <div class="section">
        <div class="title_wrapper">
            <?php
            switch ($slidebartype) {
                case 12:
                case 3:
				case 31:
                    ?>
                    <h2><?php echo $slideBar[17][$lang]?></h2>
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
                                                    if (empty($Items_Sub_2)) {
                                                        ?>
                                                       <!-- <img src="../pic/1.jpg" alt="A description of the picture" width="230" height="230" /> -->
                                                        <?php
                                                    } else {
                                                        foreach ($Items_Sub_2 as $Item) :
                                                            ?>
                                                            <li><a href="?index.php&action=toBeApproveList&identificationno=<?php echo $Item['identificationno']; ?>" title="<?php echo $Item['identificationno']; ?>"><?php echo $Item['identificationno']; ?> </a></li>            
                                                        <?php endforeach; ?>
                                                        <?php
                                                    }
                                                    break;
                                        case 3: 
                                            if (empty($Items_Sub_2)) {
                                                ?>
                                               <!-- <img src="../pic/1.jpg" alt="A description of the picture" width="230" height="230" /> -->
                                                <?php
                                            } else {
                                                foreach ($Items_Sub_2 as $Item) :
                                                    ?>
                                                    <li><a href="index.php?action=add_details_transfer&id=<?php echo $Item['id']; ?>&identificationno=<?php echo $Item['identificationno']; ?>" title="<?php echo $Item['identificationno']; ?>"><?php echo $Item['identificationno']; ?> </a></li> 
                                                <?php endforeach; ?>
                                                <?php
                                            }
                                            break;
									     case 31:
                                                    if (empty($Items_Sub)) {
                                                        ?>
                                                        <?php
                                                    } else {
                                                        foreach ($Items_Sub as $Item) :
                                                            ?>
                                                            <li><a href="?index.php&action=check_notconfirm_details&identificationno=<?php echo $Item[0]; ?>" title="<?php echo $Item[0]; ?>"><?php echo $Item[0]; ?> </a></li>            
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

<style>
.bigFont li{
font-size:14px;
font-weight: bold;
}
</style>
<div id="sidebar">
    <div class="inner">
        <div class="section">
            <div class="section">
                <div class="title_wrapper">
                    <?php
                    switch ($slidebartype) {
                        case 1:
                            ?>
                            <h2>Loss and Damage</h2>
                            <span class="title_wrapper_left"></span>
                            <span class="title_wrapper_right"></span>
                            <?php
                            break;
						case 2:
                            ?>
                            <h2>Loss and Damage</h2>
                            <span class="title_wrapper_left"></span>
                            <span class="title_wrapper_right"></span>
                            <?php
                            break;
                        default:
                            ?>
                            <h2>Loss and Damage</h2>
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
                                    <div class="sct_right" >
									<div id="nav">
                                        <ul class="sidebar_menu bigFont" id="sidebar1">
                                            <?php
                                            switch ($slidebartype) {
                                                case 1:
										?>
                                                    <img src="../pic/1.jpg" alt="A description of the picture" width="230" height="230" /> 
                                            <?php
                                                    break;
											case 2:

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
                    </div>	
                    <span class="scb"><span class="scb_left"></span><span class="scb_right"></span></span>
                </div>
            </div>
        </div>
	</div>
</div>
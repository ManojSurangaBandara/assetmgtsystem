<div id="sidebar">
    <div class="inner">
        <p>&nbsp;</p>
        <div class="section">
            <div class="section">
                <div class="title_wrapper">
					<h2>Videos</h2>
					<span class="title_wrapper_left"></span>
					<span class="title_wrapper_right"></span>
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
                                                case 1:
														?>
                                                        <img src="../pic/1.jpg" alt="A description of the picture" width="230" height="230" /> 
                                                        <?php
														break;
												case 2:
														?>
														<li><a href="?index.php&action=Add_Land_Details">Add Land Details</a></li>
														<li><a href="?index.php&action=Approve_Land_Details">Approve Land Details</a></li>
														<li><a href="?index.php&action=Not_Approve_Land_Details">Not Approve Land Details</a></li>
														<li><a href="?index.php&action=Inquery_Land_Details">Inquiry Land Details</a></li>
                                                    <?php
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
        <?php
        switch ($slidebartype) {
            case 12:
            case 3:
                include 'sidebar_sub.php';
                break;
        }
        ?>   
        <?php include '../view/quick_info.php'; ?>
		<P>

	</P>
    </div>
</div>
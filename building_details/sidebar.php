<div id="sidebar">
    <div class="inner">
        <p>&nbsp;</p>
        <div class="section">
            <div class="section">
                <div class="title_wrapper">
                    <?php switch ($slidebartype) {
                        case 11:
                            ?>
                            <h2><?php echo $slideBar[1][$lang]?></h2>
                            <span class="title_wrapper_left"></span>
                            <span class="title_wrapper_right"></span>
                            <?php break;
                        case 1:
                            ?>
                            <h2><?php echo $slideBar[2][$lang]?></h2>
                            <span class="title_wrapper_left"></span>
                            <span class="title_wrapper_right"></span>
							<?php break;
						case 3:
                            ?>
                            <h2><?php echo $slideBar[2][$lang]?></h2>
                            <span class="title_wrapper_left"></span>
                            <span class="title_wrapper_right"></span>
							<?php break;
						case 4:
                            ?>
                            <h2><?php echo $slideBar[2][$lang]?></h2>
                            <span class="title_wrapper_left"></span>
                            <span class="title_wrapper_right"></span>
                            <?php
                            break;
						case 8:
                            ?>
                            <h2><?php echo $slideBar[5][$lang]?></h2>
                            <span class="title_wrapper_left"></span>
                            <span class="title_wrapper_right"></span>
                            <?php
                            break;
						case 25:
                            ?>
                            <h2><?php echo $slideBar[6][$lang]?></h2>
                            <span class="title_wrapper_left"></span>
                            <span class="title_wrapper_right"></span>
                            <?php
                            break;
						case 30:
                            ?>
                            <h2>Summary List</h2>
                            <span class="title_wrapper_left"></span>
                            <span class="title_wrapper_right"></span>
                            <?php
                            break;
						default:
							?>
							<h2><?php echo $slideBar[0][$lang]?></h2>
                            <span class="title_wrapper_left"></span>
                            <span class="title_wrapper_right"></span>
							<?php break;
}
?>
                </div>
                <div class="section_content">
                    <div class="sct">
                        <div class="sct_left">
                            <div class="sct_right">
                                <div class="sct_left">
                                    <div class="sct_right">
                                        <ul class="sidebar_menu" id="sidebar1">
                                            <?php switch ($slidebartype) {
                                                case 11:
                                                    ?>
                                                    <li><a href="?index.php&action=Approved"><?php echo $slideBar[3][$lang]?></a></li> 
                                                    <li><a href="?index.php&action=Tobe_Approve"><?php echo $slideBar[2][$lang]?></a></li>
                                                    <?php
                                                    break;
                                                case 1:
                                                    foreach ($Items as $Item) :
                                                        ?>
                                                        <li><a href="?index.php&action=toBeApproveList&identificationno=<?php echo $Item['identificationno']; ?>" title="<?php echo $Item['identificationno']; ?>"><?php echo $Item['identificationno']; ?> </a></li>            
                                                    <?php endforeach; ?>
                                                    <?php
                                                    break;
                                                case 2:
                                                    foreach ($Items as $Item) :
                                                        ?>
                                                    <li><a href="?index.php&action=ApprovedList&identificationno=<?php echo $Item['identificationno']; ?>" title="<?php echo $Item['identificationno']; ?>"><?php echo $Item['identificationno']; ?> </a></li>        
                                                    <?php endforeach; ?>
                                                    <?php
                                                    break;
                                                case 3: //For Update Records
                                                    if (empty($Items)) {
                                                        ?>
                                                        <img src="<?php echo $logo; ?>" alt="A description of the picture" width="230" height="230" /> 
                                                        <?php
                                                    } else {
                                                        foreach ($Items as $Item) :
                                                            ?>
                                                            <li><a href="?index.php&action=update_Details&id=<?php echo $Item['id']; ?>" title="<?php echo $Item['identificationno']; ?>"><?php echo $Item['identificationno']; ?> </a></li>            
                                                        <?php endforeach; ?>
                                                        <?php
                                                    }
                                                    break;
													case 4: //For Update Records
                                                    if (empty($Items)) {
                                                        ?>
                                                        <img src="<?php echo $logo; ?>" alt="A description of the picture" width="230" height="230" /> 
                                                        <?php
                                                    } else {
                                                        foreach ($Items as $Item) :
                                                            ?>
                                                            <li><a href="?index.php&action=upload_plan&id=<?php echo $Item['id']; ?>&identificationno=<?php echo $Item['identificationno']; ?>" title="<?php echo $Item['identificationno']; ?>"><?php echo $Item['identificationno']; ?> </a></li>            
                                                        <?php endforeach; ?>
                                                        <?php
                                                    }
                                                    break;
                                                case 6:
                                                    foreach ($units as $unit) :
                                                        ?>
                                                        <li><a href="?index.php&action=Get_Issue_items_Units&unit=<?php echo $unit['place']; ?>"><?php echo $unit['place']; ?> </a></li>            
        <?php endforeach; ?>
        <?php
        break;
    case 7:
        foreach ($suppliers as $supplier) :
            ?>
                                                        <li><a href="?index.php&action=list_receipt_supplier&suppler=<?php echo $supplier['unitsource']; ?>"><?php echo $supplier['unitsource']; ?> </a></li>            
        <?php endforeach; ?>
                <?php break;
                case 8: //For Inquiry Records
                                                    if (empty($items)) {
                                                        ?>
                                                        <img src="<?php echo $logo; ?>" alt="A description of the picture" width="230" height="230" /> 
                                                        <?php
                                                    } else {
                                                        foreach ($items as $Item) :
                                                            ?>
                                                            <li><a href="?index.php&action=Inquiry_List_Details&assetunit=<?php echo $assetunit; ?>&searchby=<?php echo $searchby; ?>&search=<?php echo $search; ?>&identificationno=<?php echo $Item['identificationno']; ?>&inputField1=<?php echo $inputField1; ?>&inputField2=<?php echo $inputField2; ?>" title="<?php echo $Item['identificationno']; ?>"><?php echo $Item['identificationno']; ?> </a></li>            
                                                        <?php endforeach; ?>
                                                        <?php
                                                    }
                                                    break;
					case 25:
                                                    foreach ($Items as $Item) :
                                                        ?>
														<li><a href="?index.php&action=ModificationList&id=<?php echo $Item['id']; ?>" title="<?php echo $Item['identificationno']; ?>"><?php echo $Item['identificationno']; ?></a></li>           
                                                    <?php endforeach; ?>
                                                    <?php
                                                    break;
													case 26:
												
                                                        ?>
														    
                                                    <?php
                                                    break;
													case 30:
														?> 
														<li><a href="?index.php&action=List_summary">Group By Building Category</a></li>
                                                        <!--<li><a href="?index.php&action=List_summary2">Group By Item Category</a></li>
														<li><a href="?index.php&action=List_summary3">Group By Main Category</a></li>
														<li <?php if ($_SESSION['SESS_LEVEL'] > 5){ echo 'hidden' ;}?>><a href="?index.php&action=List_summary4_1">Group By Catalogue Number (Ignore Units)</a></li>
														<li <?php if ($_SESSION['SESS_LEVEL'] > 5){ echo 'hidden' ;}?>><a href="?index.php&action=List_summary5_1">Group By Item Category (Ignore Units)</a></li>
														<li <?php if ($_SESSION['SESS_LEVEL'] <> 1){ echo 'hidden' ;}?>><a href="?index.php&action=List_summary4">Group By Catalogue Number (Ignore Units, All Items)</a></li>
														<li <?php if ($_SESSION['SESS_LEVEL'] <> 1){ echo 'hidden' ;}?>><a href="?index.php&action=List_summary5">Group By Item Category (Ignore Units, All Items)</a></li>-->
														<li <?php if ($_SESSION['SESS_LEVEL'] > 5){ echo 'hidden' ;}?>><a href="?index.php&action=List_summary6">Group By Building Category To Date (Ignore Units)</a></li> 
														 <?php                                                     
                                                    break;
            default:
                ?>
                                                    <img src="<?php echo $logo; ?>" alt="A description of the picture" width="230" height="230" /> 
<?php } ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
										 <?php
					if ($slidebartype == 26) {
					    ?> 	
    <div class="easyui-panel" style="padding:5px">
        <ul id="tt" class="easyui-tree">
            <li>
                <span>Sri Lanka Army</span>
                <ul>
                    <?php 
					$tem = "";
					$tem2 = "";
					foreach ($items as $exp) { 
					 if ($exp['protocollevel1'] == 25) {
					 if ($tem <> $exp['protocoltext2']) { ?>	
					<li data-options="state:'closed'">                        
						<span><?php echo $exp['protocoltext2']; ?></span>
						<ul>
                            <li><?php echo $exp['unitName']; ?></li>
                        </ul>
                       <?php 
					   $tem = $exp['protocoltext2'];
					   } else {
						?>
						<ul>
                            <li><?php echo $exp['unitName']; ?></li>
                        </ul>   
						<?php   
					   } 
					 } else {
					 if ($tem <> $exp['protocoltext1']) { ?>	
					<li data-options="state:'closed'">                        
						<span><?php echo $exp['protocoltext1']; ?></span>
						<ul>
                            <li><?php echo $exp['unitName']; ?></li>
                        </ul>
                       <?php 
					   $tem = $exp['protocoltext1'];
					   } else {
						?>
						<ul>
                            <li><?php echo $exp['unitName']; ?></li>
                        </ul>   
						<?php   
					   } 
					} }?>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
							
				<?php		
					}
					?>
                    <span class="scb"><span class="scb_left"></span><span class="scb_right"></span></span>
                </div>
            </div>
        </div>
        <?php
        switch ($slidebartype) {
            case 1:
            case 3:
			case 4:
                include 'sidebar_sub.php';
                break;
        }
        ?> 
<?php include '../view/quick_info.php'; ?>
    <P>

	</P>

</div>
	</div>
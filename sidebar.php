<div id="sidebar">
    <div class="inner">
        <p>&nbsp;</p>
        <div class="section">
            <div class="section">
                <div class="title_wrapper">
                    <?php
                    switch ($slidebartype) {
                        case 1:
                            ?>
                            <h2><?php echo $slideBar[1][$lang]?></h2>
                            <span class="title_wrapper_left"></span>
                            <span class="title_wrapper_right"></span>
                            <?php
                            break;
                        case 2:
                            ?>
                            <h2><?php echo $slideBar[2][$lang]?></h2>
                            <span class="title_wrapper_left"></span>
                            <span class="title_wrapper_right"></span>
                            <?php
                            break;
                        case 3:
                            ?>
                            <h2><?php echo $slideBar[3][$lang]?></h2>
                            <span class="title_wrapper_left"></span>
                            <span class="title_wrapper_right"></span>
                            <?php
                            break;
						case 4:
                            ?>
                            <h2>Upload Vehicle Photo</h2>
                            <span class="title_wrapper_left"></span>
                            <span class="title_wrapper_right"></span>
                            <?php
                            break;
                        case 8:
                            ?>
                            <h2><?php echo $slideBar[4][$lang]?></h2>
                            <span class="title_wrapper_left"></span>
                            <span class="title_wrapper_right"></span>
                            <?php
                            break;
                        case 11:
                            ?>
                            <h2><?php echo $slideBar[5][$lang]?></h2>
                            <span class="title_wrapper_left"></span>
                            <span class="title_wrapper_right"></span>
                            <?php
                            break;
                        case 12:
                            ?>
                            <h2><?php echo $slideBar[3][$lang]?></h2>
                            <span class="title_wrapper_left"></span>
                            <span class="title_wrapper_right"></span>
                            <?php
                            break;
                        case 14:
                            ?>
                            <h2><?php echo $slideBar[8][$lang]?></h2>
                            <span class="title_wrapper_left"></span>
                            <span class="title_wrapper_right"></span>
                            <?php
                            break;
                        case 21:
                            ?>
                            <h2><?php echo $slideBar[10][$lang]?></h2>
                            <span class="title_wrapper_left"></span>
                            <span class="title_wrapper_right"></span>
                            <?php
                            break;
                        case 22:
                            ?>
                            <h2><?php echo $slideBar[12][$lang]?></h2>
                            <span class="title_wrapper_left"></span>
                            <span class="title_wrapper_right"></span>
                            <?php
                            break;
                        case 23:
                            ?>
                            <h2><?php echo $slideBar[13][$lang]?></h2>
                            <span class="title_wrapper_left"></span>
                            <span class="title_wrapper_right"></span>
                            <?php
                            break;
						case 25:
                            ?>
                            <h2><?php echo $slideBar[14][$lang]?></h2>
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
						case 32:
                            ?>
                            <h2>Lost and Damaged</h2>
                            <span class="title_wrapper_left"></span>
                            <span class="title_wrapper_right"></span>
                            <?php
                            break;
						case 33:
                            ?>
                            <h2>Ordinance Number</h2>
                            <span class="title_wrapper_left"></span>
                            <span class="title_wrapper_right"></span>
                            <?php
                            break;
                        default:
                            ?>
                            <h2><?php echo $slideBar[15][$lang]?></h2>
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
                                                case 1:
                                                    if ($_SESSION['SESS_LEVEL'] == 1) {
                                                        ?>
                                                        <li><a href="?index.php&action=Select_Items_For_Disposal"><?php echo $slideBar[21][$lang]?></a></li>
                                                        <li><a href="?index.php&action=Selected_Items_For_Disposal"><?php echo $slideBar[22][$lang]?></a></li>
                                                        <li><a href="?index.php&action=Confirm_Items_For_Disposal"><?php echo $slideBar[23][$lang]?></a></li> 
                                                        <li><a href="?index.php&action=approve_Items_For_Disposal"><?php echo $slideBar[24][$lang]?></a></li>
                                                        <li><a href="?index.php&action=Approve_Items_For_Disposal_List"><?php echo $slideBar[25][$lang]?></a></li>
														<li><a href="?index.php&action=approve_Items_For_Disposal_catlog">Approve Disposal- Item Wise </a></li>
                                                        <li><a href="?index.php&action=Disposal_List"><?php echo $slideBar[26][$lang]?></a></li>
                                                        <li><a href="?index.php&action=List_Inquiry&disposal=1"><?php echo $slideBar[27][$lang]?></a></li>
														<li><a href="index.php?action=disposal_inquiry_tree" class="sm4">Disposal Inquiry Tree - Tree</a></li>
														<li><a href="?index.php&action=select_items_for_send_ordinance">Send Items to Ordinance</a></li>
                                                        <?php
													} elseif ($_SESSION['SESS_LEVEL'] == 3) {
                                                        ?>
                                                        <li><a href="?index.php&action=approve_Items_For_Disposal"><?php echo $slideBar[24][$lang]?></a></li> 
                                                        <li><a href="?index.php&action=Approve_Items_For_Disposal_List"><?php echo $slideBar[25][$lang]?></a></li>
														<li><a href="?index.php&action=approve_Items_For_Disposal_catlog">Approve Disposal- Item Wise </a></li>	
                                                        <li><a href="?index.php&action=Disposal_List"><?php echo $slideBar[26][$lang]?></a></li>
                                                        <li><a href="?index.php&action=List_Inquiry&disposal=1"><?php echo $slideBar[27][$lang]?></a></li>
                                                        <?php
                                                    } elseif ($_SESSION['SESS_LEVEL'] == 5 || $_SESSION['SESS_LEVEL'] == 4) {
                                                        ?>
                                                        <li><a href="?index.php&action=approve_Items_For_Disposal"><?php echo $slideBar[24][$lang]?></a></li>
                                                        <li><a href="?index.php&action=Approve_Items_For_Disposal_List"><?php echo $slideBar[25][$lang]?></a></li>
														<li><a href="?index.php&action=approve_Items_For_Disposal_catlog">Approve Disposal- Item Wise </a></li>
                                                        <li><a href="?index.php&action=Disposal_List"><?php echo $slideBar[26][$lang]?></a></li>
                                                        <li><a href="?index.php&action=List_Inquiry&disposal=1"><?php echo $slideBar[27][$lang]?></a></li>
                                                        <?php
                                                    } elseif ($_SESSION['SESS_LEVEL'] == 6) {
                                                        ?>
                                                        <li><a href="?index.php&action=Select_Items_For_Disposal"><?php echo $slideBar[21][$lang]?></a></li>
                                                        <li><a href="?index.php&action=Selected_Items_For_Disposal"><?php echo $slideBar[22][$lang]?></a></li>
                                                        <li><a href="?index.php&action=Confirm_Items_For_Disposal"><?php echo $slideBar[23][$lang]?></a></li> 
                                                        <li><a href="?index.php&action=Disposal_List"><?php echo $slideBar[26][$lang]?></a></li>
                                                        <li><a href="?index.php&action=List_Inquiry&disposal=1"><?php echo $slideBar[27][$lang]?></a></li>
														<li><a href="?index.php&action=select_items_for_send_ordinance">Send Items to Ordinance</a></li>
                                                        <?php
                                                    } elseif ($_SESSION['SESS_LEVEL'] == 7) {
                                                        ?>
                                                        <li><a href="?index.php&action=Select_Items_For_Disposal"><?php echo $slideBar[21][$lang]?></a></li>
														<li><a href="?index.php&action=Selected_Items_For_Disposal"><?php echo $slideBar[22][$lang]?></a></li>
                                                        <li><a href="?index.php&action=Confirm_Items_For_Disposal"><?php echo $slideBar[23][$lang]?></a></li> 
                                                        <li><a href="?index.php&action=Disposal_List"><?php echo $slideBar[26][$lang]?></a></li>
                                                        <li><a href="?index.php&action=List_Inquiry&disposal=1"><?php echo $slideBar[27][$lang]?></a></li>
														<li><a href="?index.php&action=select_items_for_send_ordinance">Send Items to Ordinance</a></li>
                                                        <?php
                                                    } elseif ($_SESSION['SESS_LEVEL'] == 8) {
                                                        ?>
                                                        <li><a href="?index.php&action=Select_Items_For_Disposal"><?php echo $slideBar[21][$lang]?></a></li>
                                                        <li><a href="?index.php&action=Selected_Items_For_Disposal"><?php echo $slideBar[22][$lang]?></a></li>
                                                        <li><a href="?index.php&action=Disposal_List"><?php echo $slideBar[26][$lang]?></a></li>
                                                        <li><a href="?index.php&action=List_Inquiry&disposal=1"><?php echo $slideBar[27][$lang]?></a></li>
														<li><a href="?index.php&action=select_items_for_send_ordinance">Send Items to Ordinance</a></li>
                                                        <?php
                                                    }
                                                    break;
                                                case 3: //For Update Records
                                                    if (empty($Items)) {
                                                        ?>
                                                        <img src="../pic/1.jpg" alt="A description of the picture" width="230" height="230" /> 
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
                                                        <img src="../pic/1.jpg" alt="A description of the picture" width="230" height="230" /> 
                                                        <?php
                                                    } else {
                                                        foreach ($Items as $Item) :
                                                            ?>
                                                            <li><a href="?index.php&action=upload_plan&id=<?php echo $Item['id']; ?>&identificationno=<?php echo $Item['identificationno']; ?>" title="<?php echo $Item['identificationno']; ?>"><?php echo $Item['identificationno']; ?> </a></li>            
                                                        <?php endforeach; ?>
                                                        <?php
                                                    }
                                                    break;
                                                case 8: //For Inquiry Records
                                                    if (empty($items)) {
                                                        ?>
                                                        <img src="../pic/1.jpg" alt="A description of the picture" width="230" height="230" /> 
                                                        <?php
                                                    } else {
                                                        foreach ($items as $Item) :
                                                            ?>
                                                            <li><a href="?index.php&action=Inquiry_List_Details&assetunit=<?php echo $assetunit; ?>&searchby=<?php echo $searchby; ?>&search=<?php echo $search; ?>&identificationno=<?php echo $Item['identificationno']; ?>&inputField1=<?php echo $inputField1; ?>&inputField2=<?php echo $inputField2; ?>" title="<?php echo $Item['identificationno']; ?>"><?php echo $Item['identificationno']; ?> </a></li>            
                                                        <?php endforeach; ?>
                                                        <?php
                                                    }
                                                    break;
                                                case 11:
                                                    ?>
                                                    <li><a href="?index.php&action=Approved"><?php echo $slideBar[6][$lang]?></a></li> 
                                                    <li><a href="?index.php&action=Tobe_Approve"><?php echo $slideBar[3][$lang]?></a></li>
                                                    <?php
                                                    break;
                                                case 12:
                                                    foreach ($Items as $Item) :
                                                        ?>
                                                        <li><a href="?index.php&action=toBeApproveList&identificationno=<?php echo $Item['identificationno']; ?>" title="<?php echo $Item['identificationno']; ?>"><?php echo $Item['identificationno']; ?> </a></li>            
                                                    <?php endforeach; ?>
                                                    <?php
                                                    break;
                                                case 13:
                                                    foreach ($Items as $Item) :
                                                        ?>
                                                        <li><a href="?index.php&action=ApprovedList&identificationno=<?php echo $Item['identificationno']; ?>" title="<?php echo $Item['identificationno']; ?>"><?php echo $Item['identificationno']; ?> </a></li>
                                                    <?php endforeach; ?>
                                                    <?php
                                                    break;
                                                case 14: // selected list for Disposal
                                                    foreach ($Items as $Item) :
                                                        ?>
                                                        <li><a href="?index.php&action=Selected_Items_For_Disposal&id=<?php echo $Item['id']; ?>" title="<?php echo $Item['identificationno']; ?>"><?php echo $Item['identificationno']; ?> </a></li>
                                                    <?php endforeach; ?>
                                                    <?php
                                                    break;
                                                case 21:
                                                    foreach ($Items as $Item) :
                                                        ?>
                                                        <li><a href="?index.php&action=search_Disposal&id=<?php echo $Item['id']; ?>" title="<?php echo $Item['searchKey']; ?>"><?php echo $Item['searchKey']; ?></a></li>            
                                                    <?php endforeach; ?>
                                                    <?php
                                                    break;
                                                case 22:
                                                    foreach ($Items as $Item) :
                                                        ?>
                                                        <li><a href="?index.php&action=confirm_Disposal&id=<?php echo $Item['id']; ?>" title="<?php echo $Item['identificationno']; ?>"><?php echo $Item['identificationno']; ?></a></li>            
                                                    <?php endforeach; ?>
                                                    <?php
                                                    break;
                                                case 23:
                                                    foreach ($Items as $Item) :
                                                        ?>
                                                        <li><a href="?index.php&action=approve_Disposal&id=<?php echo $Item['id']; ?>&assetscenter=<?php echo $assetscenter; ?>&assetunit=<?php echo $assetunit; ?>" title="<?php echo $Item['identificationno']; ?>"><?php echo $Item['identificationno']; ?></a></li>            
                                                    <?php endforeach; ?>
                                                    <?php
                                                    break;
                                                case 24:
                                                    foreach ($Items as $Item) :
                                                        ?>
                                                        <li><a href="?index.php&action=DisposalList&identificationno=<?php echo $Item['identificationno']; ?>" title="<?php echo $Item['identificationno']; ?>"><?php echo $Item['identificationno']; ?></a></li>            
                                                    <?php endforeach; ?>
                                                    <?php
                                                    break;
												case 25:
                                                    foreach ($Items as $Item) :
                                                        ?>
														<li><a href="?index.php&action=ModificationList&id=<?php echo $Item['id']; ?>" title="<?php echo $Item['searchKey']; ?>"><?php echo $Item['searchKey']; ?></a></li>           
                                                    <?php endforeach; ?>
                                                    <?php
                                                    break;
												case 26:
												
                                                        ?>
														    
                                                    <?php
                                                    break;
												case 27:
												
                                                        ?>
														    
                                                    <?php
                                                    break;
												case 30:
														?> 
														<li><a href="?index.php&action=List_summary">Group By Catalogue Number</a></li>
                                                        <li><a href="?index.php&action=List_summary2">Group By Item Category</a></li>
														<li><a href="?index.php&action=List_summary3">Group By Main Category</a></li>
														<li><a href="?index.php&action=List_summary4_1">Group By Catalogue Number (Ignore Units)</a></li>
														<li><a href="?index.php&action=List_summary5_1">Group By Item Category (Ignore Units)</a></li>
														<li <?php if ($_SESSION['SESS_LEVEL'] <> 1){ echo 'hidden' ;}?>><a href="?index.php&action=List_summary4">Group By Catalogue Number (Ignore Units, All Items)</a></li>
														<li <?php if ($_SESSION['SESS_LEVEL'] <> 1){ echo 'hidden' ;}?>><a href="?index.php&action=List_summary5">Group By Item Category (Ignore Units, All Items)</a></li>
														<li <?php if ($_SESSION['SESS_LEVEL'] <> 1){ echo 'hidden' ;}?>><a href="?index.php&action=List_summary6">Group By Item Category to Date(Ignore Units, All Items)</a></li>
														<li <?php if ($_SESSION['SESS_LEVEL'] > 5){ echo 'hidden' ;}?>><a href="?index.php&action=List_summary_age">Group By Age(<5,5~10,11~15,15<)</a></li>
														 <?php                                                     
                                                    break;
													case 32:
                                                    if ($_SESSION['SESS_LEVEL'] == 1) {
														?> 
                                                        <li><a href="?index.php&action=Select_Items_For_loss">Select Lost & Damaged Items</a></li>
                                                        <li><a href="?index.php&action=Selected_Items_For_loss">Selected List Lost & Damaged</a></li>
                                                        <li><a href="?index.php&action=Confirm_Items_For_loss">Confirm Selected Lost & Damaged</a></li> 
                                                        <li><a href="?index.php&action=approve_Items_For_loss">Approve Comfirmed Lost & Damaged</a></li>
                                                        <li><a href="?index.php&action=loss_List">Lost & Damaged List</a></li>
                                                        <li><a href="?index.php&action=loss_List_Inquiry">Lost & Damaged Inquiry</a></li>
                                                        <?php 
													} elseif ($_SESSION['SESS_LEVEL'] == 3) {
                                                        ?>
                                                        <li><a href="?index.php&action=approve_Items_For_loss">Approve Comfirmed Lost & Damaged</a></li>
                                                        <li><a href="?index.php&action=loss_List">Lost & Damaged List</a></li>
                                                        <li><a href="?index.php&action=loss_List_Inquiry">Lost & Damaged Inquiry</a></li>
                                                        <?php	
                                                    } elseif ($_SESSION['SESS_LEVEL'] == 5 || $_SESSION['SESS_LEVEL'] == 4) {
                                                        ?>
                                                        <li><a href="?index.php&action=approve_Items_For_loss">Approve Comfirmed Lost & Damaged</a></li>
                                                        <li><a href="?index.php&action=loss_List">Lost & Damaged List</a></li>
                                                        <li><a href="?index.php&action=loss_List_Inquiry">Lost & Damaged Inquiry</a></li>
                                                        <?php
                                                    } elseif ($_SESSION['SESS_LEVEL'] == 6) {
                                       
														?>
                                                        <li><a href="?index.php&action=Select_Items_For_loss">Select Lost & Damaged Items</a></li>
                                                        <li><a href="?index.php&action=Selected_Items_For_loss">Selected List Lost & Damaged</a></li>
                                                         <li><a href="?index.php&action=Confirm_Items_For_loss">Confirm Selected Lost & Damaged</a></li> 
                                                        <li><a href="?index.php&action=loss_List">Lost & Damaged List</a></li>
                                                        <li><a href="?index.php&action=loss_List_Inquiry">Lost & Damaged Inquiry</a></li>
                                                        <?php
                                                    } elseif ($_SESSION['SESS_LEVEL'] == 7) {
														?>  
														<li><a href="?index.php&action=Select_Items_For_loss">Select Lost & Damaged Items</a></li>
                                                        <li><a href="?index.php&action=Selected_Items_For_loss">Selected List Lost & Damaged</a></li>
                                                        <li><a href="?index.php&action=Confirm_Items_For_loss">Confirm Selected Lost & Damaged</a></li>
                                                       <li><a href="?index.php&action=loss_List">Lost & Damaged List</a></li>
                                                        <li><a href="?index.php&action=loss_List_Inquiry">Lost & Damaged Inquiry</a></li>
                                                        <?php 
                                                    } elseif ($_SESSION['SESS_LEVEL'] == 8) {
														?>
                                                        <li><a href="?index.php&action=Select_Items_For_loss">Select Lost & Damaged Items</a></li>
														<li><a href="?index.php&action=Selected_Items_For_loss">Selected List Lost & Damaged</a></li>
                                                        <li><a href="?index.php&action=loss_List">Lost & Damaged List</a></li>
                                                        <li><a href="?index.php&action=loss_List_Inquiry">Lost & Damaged Inquiry</a></li>
                                                        <?php 
                                                    }
                                                    break;
												case 33:
												
                                                        ?>
														    
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
					<?php
					if ($slidebartype == 27) {
					    ?> 	
    <div class="easyui-panel" style="padding:5px">
        <ul id="tt2" class="easyui-tree">
            <li>
                <span>Vehicles</span>
                <ul>
                    <?php 
					$i=0;
					$j = 0;
					$tem = "";
					$tem2 = "";
					foreach ($items as $exp) { 
					 if ($tem <> $exp['mainCategory']) { 
					 if ($j<>0){
						 $j++;
						?> 
						</li>
						</ul>						
					 <?php }
					  $j++;
					 ?>	
					<li id="<?php echo 'z'.$j.$i ; ?>" data-options="state:'closed'">                        
						<span><?php echo $exp['mainCategory']; ?></span>
						<?php 
					   $tem = $exp['mainCategory'];
					   $i=0;
					   } 
						if ($tem2 <> $exp['itemCategory']) { 
						if ($i<>0) { ?>
							</li>
							</ul>
						 <?php
						}
						?>
						<ul>
                            <li id="<?php echo 'y'.$j.$i ; ?>" data-options="state:'closed'"><span><?php echo $exp['itemCategory']; ?></span>
                        
                       <?php 
					   $tem2 = $exp['itemCategory'];
					   } ?>
						<ul>
                            <li id="<?php echo 'x'.$j.$i ; ?>"><?php echo $exp['itemDescription']; ?></li>
                        </ul>   
						<?php   
					   $i++;
					} ?>
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
            case 12:
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
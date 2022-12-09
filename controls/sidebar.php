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
                            <h2>Fixed Assets Controls</h2>
                            <span class="title_wrapper_left"></span>
                            <span class="title_wrapper_right"></span>
                            <?php
                            break;
						case 2:
                            ?>
                            <h2>Fixed Assets Controls</h2>
                            <span class="title_wrapper_left"></span>
                            <span class="title_wrapper_right"></span>
                            <?php
                            break;
						case 5:
                            ?>
                            <h2>Orbat Controls</h2>
                            <span class="title_wrapper_left"></span>
                            <span class="title_wrapper_right"></span>
                            <?php
                            break;
						case 7:
                            ?>
                            <h2>Add Errors to Unit</h2>
                            <span class="title_wrapper_left"></span>
                            <span class="title_wrapper_right"></span>
                            <?php
                            break;
						case 8:
                            ?>
                            <h2>Cigas Controls</h2>
                            <span class="title_wrapper_left"></span>
                            <span class="title_wrapper_right"></span>
                            <?php
                            break;
						case 9:
                            ?>
                            <h2>Board Report Details</h2>
                            <span class="title_wrapper_left"></span>
                            <span class="title_wrapper_right"></span>
                            <?php
                            break;
						case 10:
                            ?>
                            <h2>Allocation (Scale) Details</h2>
                            <span class="title_wrapper_left"></span>
                            <span class="title_wrapper_right"></span>
                            <?php
                            break;
                        default:
                            ?>
                            <h2>Fixed Assets Controls</h2>
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
                                                    ?>
                                                    <img src="<?php echo $logo; ?>" alt="A description of the picture" width="230" height="230" />
                                                    <?php
                                                    break;
												case 2:
                                                    if (empty($Items)) {
                                                        ?>
                                                        <img src="<?php echo $logo; ?>" alt="A description of the picture" width="230" height="230" /> 
                                                        <?php
                                                    } else {
                                                        foreach ($Items as $Item) :
                                                            ?>
                                                            <li><a href="?index.php&action=Display_QuickInfos&id=<?php echo $Item['id']; ?>" title="<?php echo $Item['id']; ?>"><?php echo $Item['title']; ?> </a></li>            
                                                        <?php endforeach; ?>
                                                        <?php
                                                    }
                                                    break;
												case 5:
                                                    ?>  
														<li><a href="?index.php&action=orbat_addsf">Add SF HQ</a></li>
														<li><a href="?index.php&action=orbat_adddiv">Add Div</a></li>
														<li><a href="?index.php&action=orbat_addbde">Add Bde</a></li>
														<li><a href="?index.php&action=orbat_addunit">Add Units</a></li>                                                       
														<?php
													break;
												case 6:
												case 7:
												case 10:
												break;
												case 8:
                                                    ?>  
														<li hidden><a href="?index.php&action=cigas_units_display">Display Units</a></li>
														<li><a href="?index.php&action=cigas_item_display">Display Asset Items - 4</a></li>
														<li><a href="?index.php&action=cigas_item_display_fb">Display Asset Items-Dte Fin.</a></li>
														<li><a href="?index.php&action=cigas_plantmacdetails_display">Display Plant & Machinery</a></li>
														<li><a href="?index.php&action=cigas_officeequipments_display">Display Office Equipments</a></li>
														<li><a href="?index.php&action=cigas_vehicledetails_display">Display Vehicle Details</a></li>
														<li hidden><a href="?index.php&action=cigas_item_generate">Create Cigas Asset Code</a></li>
														<li><a href="?index.php&action=cigas_plantmacdetails_generate">Create Plant & Machinery Code -3</a></li>
														<li><a href="?index.php&action=cigas_officeequdetails_generate">Create Office Equipments Code -3</a></li>
														<li><a href="?index.php&action=cigas_vehicledetails_generate">Create Vehicles Code -3</a></li>
														<li hidden><a href="?index.php&action=cigas_vehicle_compare_SNT_system">Compare Vehicle S&T and System</a></li>
														<li hidden><a href="?index.php&action=cigas_vehicle_system_duplicates">System Vehicle Duplicate Details</a></li>
														<li hidden><a href="?index.php&action=cigas_vehicle_system_all">System Vehicles All</a></li>
														<li hidden><a href="?index.php&action=cigas_vehicle_snt_all">S & T Vehicles All</a></li>
														<li hidden><a href="?index.php&action=cigas_vehicle_system_duplicates_mark">System Vehicle Mark Duplicates</a></li>   														
														<li><a href="?index.php&action=cigas_nottransfer_list">Cigas Not Transfer List</a></li>
                                                        <li><a href="?index.php&action=cigas_2018_pruchase_list">Cigas 2018 Pruchase List</a></li>
														<li><a href="?index.php&action=cigas_item_generate_empty">Add new Assets Numbers to catelogue - 1</a></li>
														<li><a href="?index.php&action=cigas_item_generate_lastnumber">Add Last Assets Numbers to catelogue - 2</a></li>
                                                        <?php
													break;
												case 9:
														if (($_SESSION['SESS_LEVEL'] == 2) || ($_SESSION['SESS_LEVEL'] == 10) || ($_SESSION['SESS_LEVEL'] == 15) || ($_SESSION['SESS_LEVEL'] == 25)) {
														?>  
														<li><a href="?index.php&action=board_report_summary_details">Board Report Summary Details</a></li>													  														
														<?php 
													 } else {
														?>  
														<li><a href="?index.php&action=add_board_report_receving">Add Board Report Receiving</a></li>
														<li><a href="?index.php&action=board_report_notreceive_list">Board Report Not Receive List</a></li>
														<li><a href="?index.php&action=board_report_summary_details">Board Report Summary Details</a></li>
														<li><a href="?index.php&action=delete_board_report_server">Delete Board Report From Server</a></li>
														<li><a href="?index.php&action=add_board_report_observations">Add Board Report Observations</a></li>														
														<?php 
													 }
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
					if ($slidebartype == 6) {
					    ?> 	
    <div class="easyui-panel" style="padding:5px">
        <ul id="tt" class="easyui-tree">
            <li id="1">
                <span><a href="index.php?action=map_all">Sri Lanka Army</a></span>
                <ul>
                    <?php 
					$tem = "";
					$tem2 = "";
					foreach ($items as $exp) { 
					 if ($exp['protocollevel1'] == 25) {
					 if ($tem <> $exp['protocoltext2']) { ?>	
					<li data-options="state:'closed'" id="2">                        
						<span><a href="index.php?action=map_all_unit&unit=<?php echo $exp['protocoltext2']; ?>"><?php echo $exp['protocoltext2']; ?></a></span>
						<ul>
                            <li><a href="index.php?action=display_unitdetails_all&unit=<?php echo $exp['unitName']; ?>"><?php echo $exp['unitName']; ?></a></li>
                        </ul>
                       <?php 
					   $tem = $exp['protocoltext2'];
					   } else {
						?>
						<ul>
                            <li><a href="index.php?action=display_unitdetails_all&unit=<?php echo $exp['unitName']; ?>"><?php echo $exp['unitName']; ?></a></li>
                        </ul>   
						<?php   
					   } 
					 } else {
					 if ($tem <> $exp['protocoltext1']) { ?>	
					<li data-options="state:'closed'" id="3">                        
						<span><a href="index.php?action=map_all_unit&unit=<?php echo $exp['protocoltext1']; ?>"><?php echo $exp['protocoltext1']; ?></a></span>
						<ul>
                            <li><a href="index.php?action=display_unitdetails_all&unit=<?php echo $exp['unitName']; ?>"><?php echo $exp['unitName']; ?></a></li>
                        </ul>
                       <?php 
					   $tem = $exp['protocoltext1'];
					   } else {
						?>
						<ul>
                            <li><a href="index.php?action=display_unitdetails_all&unit=<?php echo $exp['unitName']; ?>"><?php echo $exp['unitName']; ?></a></li>
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
					if ($slidebartype == 7) {
					    ?> 	
    <div class="easyui-panel" style="padding:5px">
        <ul id="tt" class="easyui-tree">
            <li id="1">
                <span>Sri Lanka Army</a></span>
                <ul>
                    <?php 
					$tem = "";
					$tem2 = "";
					foreach ($items as $exp) { 
					 if ($exp['protocollevel1'] == 25) {
					 if ($tem <> $exp['protocoltext2']) { ?>	
					<li data-options="state:'closed'" id="2">                        
						<span><?php echo $exp['protocoltext2']; ?></a></span>
						<ul>
                            <li><a href="index.php?action=add_unit_error&unit=<?php echo $exp['unitName']; ?>"><?php echo $exp['unitName']; ?></a></li>
                        </ul>
                       <?php 
					   $tem = $exp['protocoltext2'];
					   } else {
						?>
						<ul>
                            <li><a href="index.php?action=add_unit_error&unit=<?php echo $exp['unitName']; ?>"><?php echo $exp['unitName']; ?></a></li>
                        </ul>   
						<?php   
					   } 
					 } else {
					 if ($tem <> $exp['protocoltext1']) { ?>	
					<li data-options="state:'closed'" id="3">                        
						<span><?php echo $exp['protocoltext1']; ?></a></span>
						<ul>
                            <li><a href="index.php?action=add_unit_error&unit=<?php echo $exp['unitName']; ?>"><?php echo $exp['unitName']; ?></a></li>
                        </ul>
                       <?php 
					   $tem = $exp['protocoltext1'];
					   } else {
						?>
						<ul>
                            <li><a href="index.php?action=add_unit_error&unit=<?php echo $exp['unitName']; ?>"><?php echo $exp['unitName']; ?></a></li>
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
					if ($slidebartype == 10) {
					    ?> 	
    <div class="easyui-panel" style="padding:5px">
        <ul id="tt" class="easyui-tree">
            <li id="1">
                <span><a href="index.php?action=map_all">Sri Lanka Army</a></span>
                <ul>
                    <?php 
					$tem = "";
					$tem2 = "";
					foreach ($items as $exp) { 
					 if ($exp['protocollevel1'] == 25) {
					 if ($tem <> $exp['protocoltext2']) { ?>	
					<li data-options="state:'closed'" id="2">                        
						<span><a href="index.php?action=map_all_unit&unit=<?php echo $exp['protocoltext2']; ?>"><?php echo $exp['protocoltext2']; ?></a></span>
						<ul>
                            <li><a href="index.php?action=display_unitdetails_all&unit=<?php echo $exp['unitName']; ?>"><?php echo $exp['unitName']; ?></a></li>
                        </ul>
                       <?php 
					   $tem = $exp['protocoltext2'];
					   } else {
						?>
						<ul>
                            <li><a href="index.php?action=display_unitdetails_all&unit=<?php echo $exp['unitName']; ?>"><?php echo $exp['unitName']; ?></a></li>
                        </ul>   
						<?php   
					   } 
					 } else {
					 if ($tem <> $exp['protocoltext1']) { ?>	
					<li data-options="state:'closed'" id="3">                        
						<span><a href="index.php?action=map_all_unit&unit=<?php echo $exp['protocoltext1']; ?>"><?php echo $exp['protocoltext1']; ?></a></span>
						<ul>
                            <li><a href="index.php?action=display_unitdetails_all&unit=<?php echo $exp['unitName']; ?>"><?php echo $exp['unitName']; ?></a></li>
                        </ul>
                       <?php 
					   $tem = $exp['protocoltext1'];
					   } else {
						?>
						<ul>
                            <li><a href="index.php?action=display_unitdetails_all&unit=<?php echo $exp['unitName']; ?>"><?php echo $exp['unitName']; ?></a></li>
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
        <?php include '../view/quick_info.php'; ?>
		<P>

	</P>
    </div>
</div>
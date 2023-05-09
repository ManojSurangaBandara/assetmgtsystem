    <body  onload=calendarSetup()>
        <div id="wrapper">
            <?php
            //Start session
            if (!isset($_SESSION['SESS_MEMBER_ID']) || (trim($_SESSION['SESS_MEMBER_ID']) == '') || !isset($_SESSION['SESS_PROGRAM']) || !(($_SESSION['SESS_PROGRAM']) == "AMS")) {
                header("location: ../php-login/access-denied.php");
                exit();
            }
            ?>
			 <table style="width:100%">
  <tr>
    <td>            <b><?php echo "User :  " . $_SESSION['SESS_FIRST_NAME'] . " |    "; ?><?php if ($_SESSION['SESS_LEVEL'] != 2 && $_SESSION['SESS_LEVEL'] != 10 && $_SESSION['SESS_LEVEL'] != 14)  { echo "Place : " . $_SESSION['SESS_PLACE'] . " |    ";} ?><input class="logbutton" type="button" onclick="location.href='../php-login/logout.php';" value="Logout"/></b>
            <?php $place = $_SESSION['SESS_PLACE']; ?></td>
	<td id="language" style="float: right;"><b>Language : </b><a href="javascript:greetVisitor(0)">English</a>&nbsp;&nbsp;<a href="javascript:greetVisitor(1)">සිංහල</a>&nbsp;&nbsp;<a href="javascript:greetVisitor(2)">தமிழ்</a></td>
  </tr>
</table> 

            <div id="head">

                <div id="menus_wrapper">
                    <div id="main_menu">
                        <ul>
                            <li <?php echo ($_SESSION['SESS_LEVEL'] == 17 || $_SESSION['SESS_LEVEL'] == 12)  ? 'hidden' : '';?>><a href="../land_details" <?php
                                if ($page == 1) {
                                    echo "class=selected";
                                }
                                ?>><span><span><?php echo $mainMenu[0][$lang] ?></span></span></a></li>
                            <li <?php echo ($_SESSION['SESS_LEVEL'] == 17 || $_SESSION['SESS_LEVEL'] == 12) ? 'hidden' : '';?>><a href="../building_details" <?php
                                if ($page == 2) {
                                    echo "class=selected";
                                }
                                ?>><span><span><?php echo $mainMenu[1][$lang] ?></span></span></a></li>				
                            <li <?php echo ($_SESSION['SESS_LEVEL'] == 17 || $_SESSION['SESS_LEVEL'] == 12) ? 'hidden' : '';?>><a href="../plantmac_details" <?php
                                if ($page == 3) {
                                    echo "class=selected";
                                }
                                ?>><span><span><?php echo $mainMenu[2][$lang] ?></span></span></a></li>
                            <li <?php echo ($_SESSION['SESS_LEVEL'] == 17 || $_SESSION['SESS_LEVEL'] == 12) ? 'hidden' : '';?>><a href="../offequip_details" <?php
                                if ($page == 4) {
                                    echo "class=selected";
                                }
                                ?>><span><span><?php echo $mainMenu[3][$lang] ?></span></span></a></li>
                            <li <?php echo ($_SESSION['SESS_LEVEL'] == 17 || $_SESSION['SESS_LEVEL'] == 12) ? 'hidden' : '';?>><a href="../vehicle_details" <?php
                                if ($page == 5) {
                                    echo "class=selected";
                                }
                                ?>><span><span><?php echo $mainMenu[4][$lang] ?></span></span></a></li>
 								<?php if ($_SESSION['SESS_LEVEL'] == 1 || $_SESSION['SESS_LEVEL'] == 2 || $_SESSION['SESS_LEVEL'] == 3 || $_SESSION['SESS_LEVEL'] == 4 || $_SESSION['SESS_LEVEL'] == 12|| $_SESSION['SESS_LEVEL'] == 17) { ?>
							<li><a href="../board_of_survey" <?php
                                    if ($page == 13) {
                                        echo "class=selected";
                                    }
                                    ?>> <span><span>Board of Survey</span></span></a></li>
								  <?php } ?>                           
							<li hidden><a href="../current_assets" <?php
                                    if ($page == 12) {
                                        echo "class=selected";
                                    }
                                    ?>> <span><span><?php echo $mainMenu[6][$lang] ?></span></span></a></li>
							
							<!-- <li><a href="../Reports_view" <?php
                                if ($page == 6) {
                                    echo "class=selected";
                                }
                                ?>> <span><span>Reports</span></span></a></li> -->
								<?php if ($_SESSION['SESS_LEVEL'] == 1 || $_SESSION['SESS_LEVEL'] == 9) { ?>				
                                <li hidden><a href="../tender_details" <?php
                                    if ($page == 9) {
                                        echo "class=selected";
                                    }
                                    ?>> <span><span><?php echo $mainMenu[5][$lang] ?></span></span></a></li>
                                <?php } ?>
                                <?php if ($_SESSION['SESS_LEVEL'] == 1 || $_SESSION['SESS_LEVEL'] == 0 || $_SESSION['SESS_LEVEL'] == 3 || $_SESSION['SESS_LEVEL'] == 4 || $_SESSION['SESS_LEVEL'] == 5) { ?>				
                                <li><a href="../php-login" <?php
                                    if ($page == 7) {
                                        echo "class=selected";
                                    }
                                    ?>> <span><span>User Controls</span></span></a></li>
                                <?php } ?>
                            <?php //if ($_SESSION['SESS_LEVEL'] == 1 || $_SESSION['SESS_LEVEL'] == 5) { ?>				
                                <li><a href="../controls" <?php
                                    if ($page == 8) {
                                        echo "class=selected";
                                    }
                                    ?>> <span><span>Controls</span></span></a></li>
                                <?php //} ?>
								<?php //if ($_SESSION['SESS_LEVEL'] == 1 || $_SESSION['SESS_LEVEL'] == 5) { ?>				
                                <li hidden><a href="../videos" <?php
                                    if ($page == 10) {
                                        echo "class=selected";
                                    }
                                    ?>> <span><span>Videos</span></span></a></li>
                                <?php //} ?>
								<?php if ($_SESSION['SESS_LEVEL'] == 1 || $_SESSION['SESS_LEVEL'] == 5 || $_SESSION['SESS_LEVEL'] == 16) { ?>				
                                <li><a href="../phpgrid" <?php
                                    if ($page == 11) {
                                        echo "class=selected";
								} 
                                    ?>> <span><span>Data Grids</span></span></a></li>
								<?php } ?>	
								 <?php if ($_SESSION['SESS_LEVEL'] == 1 || $_SESSION['SESS_LEVEL'] == 2 || $_SESSION['SESS_LEVEL'] == 3 || $_SESSION['SESS_LEVEL'] == 4 || $_SESSION['SESS_LEVEL'] == 13) { ?>
								<li <?php echo $_SESSION['SESS_LEVEL'] == 17 ? 'hidden' : '';?>><a href="../loss_damage" <?php
                                    if ($page == 14) {
                                        echo "class=selected";
                                    }
                                    ?>> <span><span>Loss and Damage</span></span></a></li>
								 <?php } ?>
                                 
                                 <?php if ($_SESSION['SESS_LEVEL'] == 1 || $_SESSION['SESS_LEVEL'] == 2 || $_SESSION['SESS_LEVEL'] == 3 || $_SESSION['SESS_LEVEL'] == 4 || $_SESSION['SESS_LEVEL'] == 13) { ?>
								<li <?php echo $_SESSION['SESS_LEVEL'] == 17 ? 'hidden' : '';?>><a href="../report_dos" <?php
                                    if ($page == 50) {
                                        echo "class=selected";
                                    }
                                    ?>> <span><span>Report DOS</span></span></a></li>
								 <?php } ?>	
                        </ul>
                    </div>
					




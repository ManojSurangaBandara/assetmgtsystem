<?php
	//Start session
	session_start();
	
	//Unset the variables stored in session
	unset($_SESSION['SESS_MEMBER_ID']);
	unset($_SESSION['SESS_FIRST_NAME']);
	unset($_SESSION['SESS_LAST_NAME']);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta http-equiv="imagetoolbar" content="no" />
        <title>Assets Management System</title>
       <link rel="shortcut icon" href="favicon.ico" 
		      type="favicon.icon" />
	   
	  <link media="screen" rel="stylesheet" type="text/css" href="../css/admin.css"  />
    </head>
  <body>
	<div id="wrapper">
		<div id="head">
			<div id="menus_wrapper">
				<div id="sec_menu">
					<ul>
						<li><a href="#" class="sm1">Log Out</a></li>
					</ul>
				</div>
			</div>
					<div id="content">
			<div id="page">
			<p>&nbsp;</p>
				<div class="inner">
					<div class="section">
						<div class="title_wrapper">
							<h2>Log Out</h2>
							<span class="title_wrapper_left"></span>
							<span class="title_wrapper_right"></span>
						</div>
						<div class="section_content">
							<div class="sct">
								<div class="sct_left">
									<div class="sct_right">
										<div class="sct_left">
											<div class="sct_right">
												<div class="dashboard_menu_wrapper">
												<p>&nbsp;</p>
												<p>&nbsp;</p>
												<p>&nbsp;</p>							
												<h1 align="center">Logout </h1>
												<p align="center">&nbsp;</p>
												<h4 align="center" class="err">You have been logged out.</h4>
												<p align="center">Click here to <a href="../index.php">Login</a></p>
												<p>&nbsp;</p>
												<p>&nbsp;</p>
												<p>&nbsp;</p>
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
			
			<div id="sidebar">
				<div class="inner">
<p>&nbsp;</p>
					<div class="section">
						<div class="title_wrapper">
							<h2>Assets Management</h2>
							<span class="title_wrapper_left"></span>
							<span class="title_wrapper_right"></span>
						</div>
						<!--[if !IE]>end title wrapper<![endif]-->
						<!--[if !IE]>start section content<![endif]-->
						<div class="section_content">
							<!--[if !IE]>start section content top<![endif]-->
							<div class="sct">
								<div class="sct_left">
									<div class="sct_right">
										<div class="sct_left">
											<div class="sct_right">
												<div class="photo_gallery">
														<div class="gal_top">
															<div class="gal_bottom">
																<div class="gal_left">
																	<div class="gal_right">
																		<img src="1.jpg" alt="A description of the picture" width="230" height="200" />
																	</div>
																</div>
															</div>
														</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<span class="scb"><span class="scb_left"></span><span class="scb_right"></span></span>
							<div class="section_content_footer">
								
								<span class="scf"></span>
							</div>
							<!--[if !IE]>end section content footer<![endif]-->
							
							
						</div>
						<!--[if !IE]>end section content<![endif]-->
					</div>
					<!--[if !IE]>end section<![endif]-->
					
					
					<!--[if !IE]>start quick info<![endif]-->
					<div class="quick_info">
						<div class="quick_info_top">
							<h2>Quick info</h2>
						</div>
						<div class="quick_info_content">
						
						</div>
						<span class="quick_info_bottom"></span>
					</div>
					<!--[if !IE]>end quick info<![endif]-->
					
					
				
				
				</div>
			</div>
			<!--[if !IE]>end sidebar<![endif]-->
			
			
			
			
		</div>


<?php include '../view/footer.php'; ?>

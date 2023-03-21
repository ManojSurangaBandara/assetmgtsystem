		<div id="content">
			<div id="page">
			<p>&nbsp;</p>
				<div class="inner">
					<div class="section">
						<div class="title_wrapper">
							<h2>Login</h2>
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
												<form id="loginForm" name="loginForm" method="post" action="./php-login/login-exec.php">
													
													  <table width="500" border="0" align="center" cellpadding="2" cellspacing="0" class="box">
														<tr>
														  <td width="112"><b>Login</b></td>
														  <td width="188"><input name="login" type="text" class="textfield" id="login" /></td>
														</tr>
														<tr>
														  <td><b>Password</b></td>
														  <td><input name="password" type="password" class="textfield" id="password" /></td>
														</tr>
														<tr>
														  <td>&nbsp;</td>
														  <td><input type="submit" name="Submit" value="Login" /></td>
														</tr>
														<?php 
														if (isset($_SESSION['ERRMSG_ARR'])) { ?>
														<tr bgcolor="#FF0000" style="color: white; font-weight:bold;">
														  <td>Warning !!!!</td>
														  <td><?php echo $_SESSION['ERRMSG_ARR']; 
														  unset($_SESSION['ERRMSG_ARR']);
														  ?></td>
														</tr>	
														<?php }
														?>
													  </table>
													  <input type="hidden" name="csrf_token" value="<?=$csrf_token?>">
													</form>
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
																		<img src="./pic/1.jpg" alt="A description of the picture" width="230" height="230" />
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
					<!-- <?php include './view/quick_info.php';?> -->
				</div>
			</div>	
		</div>

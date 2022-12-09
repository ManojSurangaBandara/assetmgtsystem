		<div id="content">
			<style>
		.info, .success, .warning, .error, .validation {
			border: 1px solid;
			margin: 10px 0px;
			padding: 15px 10px 15px 50px;
			background-repeat: no-repeat;
			background-position: 10px center;
		}
		.info {
			color: #00529B;
			background-color: #BDE5F8;
			font-size: 150%;
			background-image: url('../css/layout/site/forms/blue_ico.png');
		}
		.success {
			color: #4F8A10;
			background-color: #DFF2BF;
			background-image: url('img/success.png');
		}
		.warning {
			color: #9F6000;
			background-color: #FEEFB3;
			font-size: 150%;
			background-image: url('../css/layout/site/forms/yellow_ico.png');
		}
		.error{
			color: #D8000C;
			background-color: #FFBABA;
			font-size: 150%;
			background-image: url('../css/layout/site/forms/red_ico.png');
		}
		.validation{
			color: #D63301;
			background-color: #FFCCBA;
			background-image: url('img/validation.png');
		}
	</style>
			<div id="page">
			<p>&nbsp;</p>
				<div class="inner">
					<div class="section">
					<?php
						if ($unit['error_display'] == 1) {
							foreach ($errors as &$err) {
								$items = errorcodeDB::getDetailsBycode($err);
								$title = $items['title'];
								$details = $items['details'];
								?>
								<div class="error"><?php echo $title; ?></div>
								<div class="info"><?php echo $details; ?></div>
								<?php
							}
							?>
							<?php
						}
					?>
					</div>
					<div class="section">
					<?php
						if ($members['error_display'] == 1) {
							foreach ($errors_m as &$err) {
								$items = errorcodeDB::getDetailsBycode($err);
								$title = $items['title'];
								$details = $items['details'];
								?>
								<div class="error"><?php echo $title; ?></div>
								<div class="info"><?php echo $details; ?></div>
								<?php
							}
							?>
							<?php
						}
					?>
					</div>
					<div class="section">
					<?php
						if ($errordisplay == 1) {
								$title = $errortitle;
								$details = $errordetails;
								?>
								<div class="error"><?php echo $title; ?></div>
								<div class="info"><?php echo $details; ?></div>
							<?php
						}
					?>
					</div>	
					<div class="section">
					<?php
/* 						if ($errordisplay == 1 || $unit['error_display'] == 1)   {
								?>
							<div class="warning"><p>මෙම වැරදි හැකි ඉක්මණින් නිවැරදි කර වකඅම දැනුවත් කරන්න.</p></div>
							<?php
						} */
					?>
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
						<div class="section_content">
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
																		<img src="<?php echo $logo; ?>" alt="A description of the picture" width="230" height="230" />
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
						<!-- webim button <a href="/webim/client.php?locale=en&amp;style=original" target="_blank" onclick="if(navigator.userAgent.toLowerCase().indexOf('opera') != -1 &amp;&amp; window.event.preventDefault) window.event.preventDefault();this.newWindow = window.open('/webim/client.php?locale=en&amp;style=original&amp;url='+escape(document.location.href)+'&amp;referrer='+escape(document.referrer), 'webim', 'toolbar=0,scrollbars=0,location=0,status=1,menubar=0,width=640,height=480,resizable=1');this.newWindow.focus();this.newWindow.opener=window;return false;"><img src="/webim/b.php?i=simple&amp;lang=en" border="0" width="200" height="55" alt=""/></a><!-- / webim button -->
						<!--
						Skype 'Skype Me�!' button
						http://www.skype.com/go/skypebuttons
					
						<script type="text/javascript" src="http://download.skype.com/share/skypebuttons/js/skypeCheck.js"></script>
						<a href="skype:grip113a?call"><img src="http://download.skype.com/share/skypebuttons/buttons/call_blue_white_124x52.png" style="border: none;" width="124" height="52" alt="Skype Me�!" /></a>
							-->
						</div>
						<span class="quick_info_bottom"></span>
					</div>
					<!--[if !IE]>end quick info<![endif]-->
					
					
				
				
				</div>
			</div>
			<!--[if !IE]>end sidebar<![endif]-->
			
			
			
			
		</div>

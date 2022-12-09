<?php	
	include '../view/header1.php';
?>
<div id="sec_menu">
	<?php include("sub_menu.tpl");?>
</div>
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
							<div class="warning"><p>මෙම වැරදි හැකි ඉක්මණින් නිවැරදි කර වකඅම දැනුවත් කරන්න.</p></div>
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
							<div class="warning"><p>මෙම වැරදි හැකි ඉක්මණින් නිවැරදි කර වකඅම දැනුවත් කරන්න.</p></div>
							<?php
						}
					?>
					</div>					
				</div>
			</div>
<?php
include('sidebar.php');
include '../view/footer.php';
?>
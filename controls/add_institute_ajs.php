<?php	
	include '../view/header1_ajs.php';
?>
<div id="sec_menu">
	<?php //include("sub_menu.tpl");?>
</div>
<div id="page">
<div class="inner">
	<div class="section">
		<div class="section_content">
			<div class="sct">
				<div class="sct_left">
					<div class="sct_right">
						<div class="sct_left">
						<!-- app container will be here -->
						<!-- container of our app -->
						<div class="container" ng-app="myApp">
							 <!-- read products template -->
							<ng-include src="'institute/read_products.template.php'"></ng-include>
						</div> <!-- end container -->
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
  </div>
</div>
<?php
include('sidebar.php');
include '../view/footer_ajs.php';
?>
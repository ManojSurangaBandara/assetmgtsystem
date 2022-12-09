<?php include 'header1.php';?>
<script>	
$(document).ready(function () {
	$(document).on('click','#submit',function(){
		var querystring = {				 
			action: 'items_accumulation_pricess_scale_save'
		}
			$.get('index.php', querystring, processResponse);
			function processResponse(result) {
				$('#message').html('<li class="green"><span class="ico"></span><strong class="system_title">' + result + ' Records - Process Successfully Completed.</strong></li>');
				//alert(result);
			} 	 
	return false
	});	
}); 
</script>
<div id="page">
<div class="inner">
	<div class="section">
		<div class="section_content">
			<div class="sct">
				<div class="sct_left">
					<div class="sct_right">
						<div class="sct_left">
							<div class="title_wrapper">
								<h2>Items Accumulation Calculation Process - Allocation(Scale) and Present Status</h2>
								<span class="title_wrapper_left"></span>
								<span class="title_wrapper_right"></span>
							</div>
							<ul id="message" class="system_messages">
								<li class="blue"><span class="ico"></span><strong class="system_title">press "Start Process" Button to Start Process</strong></li>
							</ul>						   

						   <form name="add_form" method="post" id="add_form" action="index.php" class="add_form">								
								<div><input type="submit" name="submit" id="submit" value="Start Process"></div>									
                            </form> 
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
  </div>
</div>
</br>
<?php
include('sidebar.php');
include '../view/footer.php';
?>
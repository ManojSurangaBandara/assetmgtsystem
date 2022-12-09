<?php	
	include '../view/header1.php';
?>
<div id="sec_menu">
	<?php include("sub_menu.tpl");?>
</div>
<script>	
$(document).ready(function () {
			$('table').tablesorter({
			widgets        : ['stickyHeaders'],
			usNumberFormat : false,
			sortReset      : true,
			sortRestart    : true
		});	
}); 
</script>
<div id="page">
<div class="inner">
<div class="section table_section">
        <div class="section_content">
            <div class="sct">
                <div class="sct_left">
                    <div class="sct_right">
                        <div class="sct_left">
                            <div class="sct_right">  
								<div class="title_wrapper">
									<h2><?php echo $title; ?></h2>
									<span class="title_wrapper_left"></span>
									<span class="title_wrapper_right"></span>
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
  <?php
include('sidebar.php');

?>
</div>
<?php
include('sidebar.php');
include '../view/footer.php';
?>
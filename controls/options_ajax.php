<?php
include '../view/header1.php';
?>
<div id="sec_menu">
    <?php include("sub_menu.tpl"); ?>
</div>
<div id="page">
    <div class="inner">
        <div class="section">
            <div class="title_wrapper">
                <h2>
                    Options
                </h2>
                <span class="title_wrapper_left"></span>
                <span class="title_wrapper_right"></span>
            </div>
            <div class="section_content">
                <div class="sct">
                    <div class="sct_left">
                        <div class="sct_right">
                            <div class="sct_left">
                                <div class="sct_right">
									   <script>
											$(document).ready(function () {
												var displaytype = '<?php echo $displaytype; ?>';
											 $('input:radio[name=displaytype]:nth(' + displaytype +')').attr('checked',true);
											$('input[name=displaytype]:radio').change(function () {
													var i = $("input[name=displaytype]:checked").val();
													$.ajax({
														  url: 'index.php',
														  type: 'post',
														  data: 'action=formdisplaychange&i='+i
													   });
											});
										});
										</script>
										<div id="confirm" title="Confirm Destruction"></div>
										   <ul id="message" class="system_messages">
												<li class="blue"><span class="ico"></span><strong class="system_title">Enter Data and  press "Add Details" Button</strong></li>
											</ul>
									
									<a href="index.php?action=downloadmanual&file=manual"><button>Download User Manual</button></a>
									<object data="manual.pdf" type="application/pdf" width="700" height="400">
										<a href="data/test.pdf">Manual</a>
										</object>
										<p></p>
										   <form  hidden name="add_form" id="add_form" class="add_form"> 
                                                <input type="hidden" name="action" value="opctions" />
                                                 <div>  
                                                    <label for="displaytype" class="label">Form Display :</label>
                                                    <input type="radio" name="displaytype" value="0">List
													<input type="radio" name="displaytype" value="1">Accordion
													<input type="radio" name="displaytype" value="2">Tab
													</div> 
											</form>	
										
                                </div>
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
include '../view/footer.php';
?>

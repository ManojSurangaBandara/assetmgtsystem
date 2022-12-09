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
                    ADD - Institutes
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
                                    <ul class="system_messages">
                                        <?php
                                        switch ($error) {
                                            case '0':
                                                ?>
                                                <li class="blue"><span class="ico"></span><strong class="system_title">Enter Data and  press "Add Details" Button</strong></li>
                                                <?php
                                                break;
                                            case '1':
                                                ?>
                                                <li class="green"><span class="ico"></span><strong class="system_title">Data Successfully Saved.</strong></li>
                                                <?php
                                                break;
                                            case '2':
                                                ?>
                                                <li class="red"><span class="ico"></span><strong class="system_title">Data Error. Please Check Data !</strong></li>
                                                <?php
                                                break;
                                            case '3':
                                                ?>
                                                <li class="yellow"><span class="ico"></span><strong class="system_title">Assets Catalogue Number Already Entered !</strong></li>
                                                <?php
                                                break;
                                            case '5':
                                                ?>
                                                <li class="red"><span class="ico"></span><strong class="system_title">Error when Database Writing !</strong></li>
                                                <?php
                                                break;
                                            case '6':
                                                ?>
                                                <li class="green"><span class="ico"></span><strong class="system_title">Data Deleted</strong></li>
                                        <?php } ?>
                                    </ul>
									   <script type="text/javascript">
												   $(document).ready(function(){
														function showComment(){
														  $.ajax({
															type:"post",
															url:"index.php",
															data:"action=showcomment",
															success:function(data){
																 $("#comment").html(data);
															}
														  });
														}
									 
														showComment();
									 
									 
														$("#button").click(function(){
									 
															  var name=$("#name").val();
															  var message=$("#message").val();
									 
															  $.ajax({
																  type:"post",
																  url:"index.php",
																  data:"name="+name+"&message="+message+"&action=addcomment",
																  success:function(data){
																	showComment();
																	  
																  }
									 
															  });
									 
														});
												   });
										   </script>
											<form>
											
												   name : <input type="text" name="name" id="name"/>
												   </br>
												   message : <input type="text" name="message" id="message" />
												   </br>
												   <input type="button" value="Send Comment" id="button">
											</form>               
		<div id="info" />
               <ul id="comment"></ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
			<div id="Itmdiv">
			<div class="table_wrapper">
													
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

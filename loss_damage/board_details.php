<?php
include '../view/header2.php';
?>
<div id="sec_menu">
    <?php include("sub_menu.tpl"); ?>
</div>
	<script>
	$(function(){
			$('#dg').edatagrid({
				url: 'index.php?action=get_lost_damage_board&fileno=<?php echo $fileno; ?>',
				saveUrl: 'index.php?action=save_lost_damage_board&fileno=<?php echo $fileno; ?>',
				updateUrl: 'index.php?action=update_lost_damage_board',
				destroyUrl: 'index.php?action=destroy_lost_damage_board',
			});
	    function showSidebar(id) {
         var querystring = {
            id: id,
            action: 'showSidebar'
        }
		$.get('index.php', querystring, processResponse);
		function processResponse(result) {
				$('#sidebar1').empty();
                var item = $.parseJSON(result);
                var options = '';
                $.each(item, function(key, value) {
                    $("#sidebar1").append('<li id="' + value.fileno + '"><a href="index.php?action=get_board_details&fileno=' + value.fileno + '">' + value.fileno + '</a></li>');
                });
        } // end processData
    }
	
$("form#add_form").submit(function() {
    var formData = new FormData(this);
    $.ajax({
        url: window.location.pathname,
        type: 'POST',
        data: formData,
        async: false,
        success: function (data) {
			if (data == parseInt(data, 10)) {
				setMessage(data);
			} else {alert(data);}
/* 			if (data == '1') {
				setMessage(data);
			} else if (data == '3') {
				setMessage(data);						
			} else {
				setMessage(data);
			} */
        },
        cache: false,
        contentType: false,
        processData: false
    });

    return false;
});
			
			function setMessage(err)
        {
            switch (parseInt(err)) {
                case 0:
					$('#message').html('<li class="blue"><span class="ico"></span><strong class="system_title">Enter Data and  press "Add Details" Button</strong></li>');
					break;
				case 1:
                    $('#message').html('<li class="green"><span class="ico"></span><strong class="system_title">Data Successfully Saved.</strong></li>');
                    break;
                case 2:
                    $('#message').html('<li class="green"><span class="ico"></span><strong class="system_title">Data Successfully Updated.</strong></li>');
                    break;
                case 3:
                    $('#message').html('<li class="red"><span class="ico"></span><strong class="system_title">Data Error. Please Check Data !</strong></li>');
                    break;
                case 4:
                    $('#message').html('<li class="blue"><span class="ico"></span><strong class="system_title">Modify Data and Press Update Details Button.</strong></li>');
                    break;
                case 5:
                    $('#message').html('<li class="red"><span class="ico"></span><strong class="system_title">Data Error. Please Check Data !</strong></li>');
                    break;
                case 6:
                    $('#message').html('<li class="red"><span class="ico"></span><strong class="system_title">Error when Database Writing !</strong></li>');
                    break;
				case 7:
                    $('#message').html('<li class="green"><span class="ico"></span><strong class="system_title">Data Successfully Deleted.</strong></li>');
                    break;
				case 8:
                    $('#message').html('<li class="red"><span class="ico"></span><strong class="system_title">Data Error. Please Check Data !</strong></li>');
                    break;
				default:
					$('#message').html('<li class="red"><span class="ico"></span><strong class="system_title">Error when Database Writing !</strong></li>');
            }
        }
	showSidebar(0);	
	setMessage(0);
});
	</script>
<div id="page">
    <div class="inner">
        <div class="section">
			<?php 
				if (isset($fileno)) {
			?>
            <div class="title_wrapper">
                <h2>
                    ADD - Board Details - <?php echo $fileno; ?>
                </h2>
                <span class="title_wrapper_left"></span>
                <span class="title_wrapper_right"></span>
            </div>

		<div id="md"></div>
	<table id="dg" title="My Users" style="width:700px;height:250px"
			toolbar="#toolbar" pagination="true" idField="id"
			rownumbers="true" fitColumns="true" singleSelect="true">
		<thead>
			<tr>
				<th field="sno" width="15" editor="{type:'validatebox',options:{required:true}}">S No.</th>
				<th field="number" width="50" editor="{type:'validatebox',options:{required:true}}">Number</th>
				<th field="rank" width="50" editor="text">Rank</th>
				<th field="name" width="50" editor="text">Name</th>
				<th field="unit" width="50" editor="text">Unit</th>
				<th field="post" width="50" editor="text">Post</th>
			</tr>
		</thead>
	</table>
	<div id="toolbar">
		<a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:$('#dg').edatagrid('addRow')">New</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="javascript:$('#dg').edatagrid('destroyRow')">Destroy</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="javascript:$('#dg').edatagrid('saveRow')">Save</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:$('#dg').edatagrid('cancelRow')">Cancel</a>
	</div>
			<?php 
				}
			?>	
    </div>
        <div class="section">
            <div class="title_wrapper">
                <h2>
					මණ්ඩල වාර්තාව  -  <?php echo $fileno; ?>
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
                                    <div id="confirm" title="Confirm Destruction"></div>
                                    <ul id="message" class="system_messages">                                        
                                    </ul>
                                    <form name="add_form" method="post" id="add_form" action="index.php" class="add_form"> 
                                        <input type="hidden" name="action" value="add_board" />
                                        <input type="hidden" name="fileno" id="fileno" value="<?php echo $fileno; ?>" />
										<input type="hidden" name="board_letter" id="board_letter" value="<?php echo $board_letter; ?>" />
										<div><label for="name" class="label">අලාභයන් පිළිබඳ මණ්ඩල වාර්තාව :</label><input type="file" name="letter"  id="letter"/><p class="help-block">[valid file types - .pdf]</p></div>
										<div><input type="submit" name="submit" id="submit" value="Add Details"></div> 			
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











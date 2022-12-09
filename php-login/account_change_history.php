<?php
include '../view/header1.php';
?>
<div id="sec_menu">
    <?php include("sub_menu.tpl"); ?>
</div>
<script>	
$(document).ready(function () {
    $('#assetscenter').change(function() {
		getAsstUnit($(this).val(), "");
    });	
	$('#assetunit').on('change', function() {
		populatetable($(this).val(), "");
		$('#login').val("");
	});
	$("#userTable").on('dblclick','tr',function(e) {
	   $("html, body").animate({scrollTop: 0}, "slow");
	   var id = $(this).attr('id');
	   $('#login').val(id);
	   populatetable($('#assetunit').val(), id);
    });
	
	function populatetable(assetunit, login)
	{
		var querystring = {
			assetunit: assetunit,
			login: login,
			action: 'get_change_history'
		}
		$.get('index.php', querystring, processResponse);
		function processResponse(result) {
			var data = $.parseJSON(result);
			$('#userTable tr').not(':first').remove();
			var i = 1;
			$.each(data, function (key, value) {
				html = '<tr id="' + value.login + '"><td>' + i +
						'</td><td>' + value.assetunit +
						'</td><td>' + value.login +
						'</td><td>' + value.odate +
						'</td><td>' + value.operation +
						'</td><td>' + value.passwd +
						'</td><td>' + value.user + '</td></tr>';
				$('#userTable tr:last').after(html);
				i++;
			});
		}
	}
    function getAsstUnit(assetscenter, assetunit)
    {
        var querystring = {
            center: assetscenter,
            action: 'findAssetsUnitsByCenter_Ajax'
        }
        $.get('index.php', querystring, processResponse);
        function processResponse(result) {
            var numbers = $.parseJSON(result);
            var option = '<option></option>';
            for (var i = 0; i < numbers.length; i++) {
                option += '<option value="' + numbers[i] + '">' + numbers[i] + '</option>';
            }
            $('#assetunit').html(option);
            $('#assetunit option[value="' + assetunit + '"]').attr('selected', 'selected');
        } // end processData
    }
    ;
}); 
</script>
<div id="page">
				<div class="inner">
					<div class="section">
						<div class="title_wrapper">
							<h2>Account Change History</h2>
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
                                                <li class="blue"><span class="ico"></span><strong class="system_title">Enter Data and  press "Search" Button</strong></li>
                                                <?php
                                                break;
												} ?>
                                    </ul>
                                    <form name="frm_add" method="post" id="frm_add" action="index.php" class="search_form general_form"> 
                                        <input type="hidden" name="action" value="account_change_history" />
                                        
                                        <table width="100%" border="0">
                                            <td colspan="3">
                                                <table width="100%" border="0" class="listing form">
                                                    <tr>
                                                        <td width="30%"><label>Assets Center :</label></td>

                                                        <td width="70%">
                                                            <select name="assetscenter" id="assetscenter">
                                                                <option value=""></option>
                                                                <?php foreach ($assetsCenters as $center) { ?>
                                                                    <option value="<?php echo $center->getName(); ?>" <?php if ($assetscenter == $center->getName()) echo "selected = 'selected'"; ?>>
                                                                        <?php echo $center->getName(); ?>
                                                                    </option>
                                                                <?php } ?>
                                                            </select>
                                                            <?php echo $fields->getField('assetscenter')->getHTML(); ?><br /></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label>Assets Unit :</label></td>
                                                        <td width="70%">
                                                            <div id="Unitdiv">
                                                                <select name="assetunit" id="assetunit" onChange="getPresentUnitByUnit('index.php?action=findPresentUnitByUnit&unit=' + this.value)">
                                                                    <option value=""></option>
                                                                    <?php foreach ($assetunits as $unit) { ?>
                                                                        <option value="<?php echo $unit->getName(); ?>" <?php if ($assetunit == $unit->getName()) echo "selected = 'selected'"; ?>>
                                                                            <?php echo $unit->getName(); ?>
                                                                        </option>
                                                                    <?php } ?>
                                                                </select>

                                                            <?php echo $fields->getField('assetunit')->getHTML(); ?><br /></td>
                                                        </div>
                                                    </tr>
													 <tr>
                                                        <td width="30%"><label>Login Name :</label></td>                                                        
														<td width="70%">
														<input type="text" class="text" name="login"  id="login" value="<?php echo $login; ?>" style="width:125px;"/>
                                                            <?php echo $fields->getField('login')->getHTML(); ?><br /></td>
                                                    </tr>
                                                </table>
                                            </td>
                                            </tr>
                                        </table>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
			                <div class="section_content">
                    <div class="sct">
                        <div class="sct_left">
                            <div class="sct_right">
                                <div class="sct_left">
                                    <div class="sct_right">
                                                <div class="table_wrapper">
                                                    <div class="table_wrapper_inner">
                                                        <table id = "userTable" cellpadding="0" cellspacing="0" width="100%">
                                                            <tbody><tr>
                                                                    <th>&nbsp;</th>
                                                                    <th>Assets Unit</th>
                                                                    <th>Login Name</th>
                                                                    <th>Operation Date</th>
																	<th>Operation</th>
																	<th>Password</th>
																	<th>User</th>
                                                                </tr>
                                                                <?php $i = 1; ?>
                                                                <?php foreach ($exps as $exp) { ?>																
                                                                    <tr id = "<?php echo $exp['login']; ?>" 
																	class=<?php
                                                                    if ($i % 2) { echo "first";
                                                                    } else { echo "second";
                                                                    }
                                                                    ?>>
                                                                        <td><?php echo $i; ?></td>                                                                       
                                                                        <td><?php echo $exp['firstname']; ?></td>
                                                                        <td><?php echo $exp['centreName']; ?></td>
                                                                        <td ><?php echo $exp['place']; ?></td>
                                                                        <td ><?php echo $exp['login']; ?></td>
                                                                        <td ><?php if($exp['level'] == 15) {
																					echo $exp['place']."- 2";
																		} else if ($exp['level'] == 25) {
																					echo $exp['place']."- 2";
																		} else { echo $exp['level'];} ?></td>
																		<td><?php echo date('Y-m-d',strtotime('+30 days',strtotime($exp['pw_update']))) . PHP_EOL; ?></td>
                                                                        <td ><?php echo $exp['fail_attempts']; ?></td>
                                                                        <td ><?php echo $exp['user_email']; ?></td>
																		<td ><?php if($exp['deactive'] == 0) {
																					echo "Yes";
																		} else { echo "No";} ?></td>
                                                                    </tr>
                                                                    <?php $i++; ?>
                                                                <?php } ?>
                                                            </tbody></table>
                                                    </div>
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

<?php
include('sidebar.php');
include '../view/footer.php';
?>











<?php
include 'header1.php';
?>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
		<script src="../jquery/bootstrap-datepicker.js"></script>
		<script src="../jquery/jquery.notifyBar.js"></script>
		<link rel="stylesheet" href="../css/datepicker.css">
        <link media="screen" rel="stylesheet" type="text/css" href="../css/admin.css"  />
		<link href="../css/jquery.notifyBar.css"  rel="stylesheet" type="text/css" >
		<link href="../css/bootstrap-dialog.css" rel="stylesheet" type="text/css" />		
		<script src="../jquery/bootstrap-dialog.js"></script>
		<script src="../jquery/bootstrap.js"></script>
<style>
#data {
	<?php 
		switch ($fundtype) {
		case 0:
			?>
		background-color: #62C9F6;
		<?php
		break;
		case 1:
			?>	
		background-color: #FFE4B5;
		<?php 
		break;
		}
 ?> 
}
</style>
<script>	
$(document).ready(function () {
	var type = <?php echo $type ?>; 
	var fundtype = <?php echo $fundtype ?>;	
	var notapprived = 0;
/***************************************************************************************************/
	$("#sidebar1, #sidebar2").on("click", "li", function () {
		var querystring = {
            groupId:$(this).attr('id'),
			action: 'getDetailsGroupID'
        }
        $.get('index.php', querystring, processResponse);
        function processResponse(result) {
			var i;
			var newLine = "\r\n";
			var item = $.parseJSON(result);
           $.each(item, function(key, value) {
				if (key == 0) {
					$('#mainCategory').val(value.mainCategory);
					$('#itemCategory').val(value.itemCategory);
					$('#itemDescription').val(value.itemDescription);
					$('#catalogueno').val(value.catalogueno);
					$('#assetsno').val(value.assetsno);
					$('#classificationno').val(value.classificationno);
					$('#natureOwnership').val(value.natureOwnership);
					$('#ledgerno').val(value.ledgerno);
					$('#category').val(value.category);
					$('#ledgerFoliono').val(value.ledgerFoliono);
					$('#purchasedDate').val(value.purchasedDate);
					$('#quantity').val(value.quantity);
					$('#unitValue').val(value.unitValue);
					$('#receivedDate').val(value.receivedDate);
					$('#presentLocation').val(value.presentLocation);
					$('#Remarks').val(value.Remarks);
					$('#id').val(value.id);
					$('#groupId').val(value.groupId);
					$('#counterId').val(value.counterId);
					$('#identificationno').val(value.identificationno);
					$('#identificationnos').html("");
					$('#assetsno').val(value.assetsno);
					$('#newAssestno').val(value.newAssestno);
					$('#heading1').html("Approve - ");
					$('#heading2').html(value.identificationno);
					$("#notapprivedReason").val(value.notapprivedReason);					
					identificationnos = value.identificationno + '-' + value.eqptSriNo;
					i = key + 1;					
				} else{
					identificationnos += newLine + value.identificationno + '-' + value.eqptSriNo;
				i = key;
				}
				$('#identificationnos').html(identificationnos);
				if (value.notapprived == 1){
					$("#apprivedReason").show();
					$("#notapprivedReason").prop('disabled', false);
					notapprived = 1;
				} else {
					$("#apprivedReason").hide();
					setMessage(4);
					notapprived = 0;
				}
            });
				$('#identificationnos').height(i * 20.15);
			//$('#identificationnos').autogrow();
		$("#RejectBtn").show();
		$("#save").show();
		$("#resetBtn").show();
		} // end processData
		$("html, body").animate({scrollTop: 0}, "slow");
		return false;
	});
/***************************************************************************************************/
$( "#resetBtn" ).click(function() {
	form_Initalize();
	return false;
});
/***************************************************************************************************/
$( "#save" ).click(function() {
	if ($('#groupId').val() == 0){
			BootstrapDialog.show({
                type: BootstrapDialog.TYPE_DANGER,
                title: 'No Item Selected: ',
                message: 'First Select the Identification No. to Approve'
            });   
	} else {					
		var querystring = {
						groupId: $('#groupId').val(),
						action: 'approve_save_new'
						}
		$.get('index.php', querystring, processResponse);
		function processResponse(data) {
			if (data > 0) {
				$.notifyBar({ cssClass: "success", html: "Data has been Approved...!" });	// error, success, warning or custom CSS class
				setMessage(7);
				form_Initalize();
				showSidebar(1,1,fundtype);
				showSidebar(2,2,fundtype);
			} else {
				setMessage(5);
			} 
			} // end processData													
		$("html, body").animate({scrollTop: 0}, "slow");
	}
	return false;
});
/***************************************************************************************************/
$( "#RejectBtn" ).click(function() {
	if (notapprived == 0){
		$("#apprivedReason").show();
		$("#appriveDetails").hide();
		$("#notapprivedReason").prop('disabled', false);
		$("#save").hide();
		notapprived = 1;
	} else {
	BootstrapDialog.confirm('Are you sure you want to Reject this Record?', function(result){
	if(result) {					
		var querystring = {
						groupId: $('#groupId').val(),
						notapprivedReason: $('#notapprivedReason').val(),
						action: 'not_approve_save_new'
						}
		$.get('index.php', querystring, processResponse);
		function processResponse(data) {
			if (data > 0) {
				$.notifyBar({ cssClass: "warning", html: "Data has been Rejected...!" });	// error, success, warning or custom CSS class
				setMessage(7);
				form_Initalize();
				showSidebar(1,1,fundtype);
				showSidebar(2,2,fundtype);
			} else {
				setMessage(5);
			} 
			} // end processData													
		$("html, body").animate({scrollTop: 0}, "slow");
	}
			});
	}
	return false;
});
/***************************************************************************************************/ 
$('#identificationnos').focus(function() {
  $( this ).blur();
});
/***************************************************************************************************/
    function setMessage(err)
    {
        switch (err) {
            case 0:
                $('#message').html('<li class="blue"><span class="ico"></span><strong class="system_title">Approve කිරීමට අවශ්‍ය Identification අංකය තෝරා ගන්න.</strong></li>');
                break;
            case 1:
                $('#message').html('<li class="green"><span class="ico"></span><strong class="system_title">Data Successfully Saved.</strong></li>');
                break;
            case 2:
                $('#message').html('<li class="green"><span class="ico"></span><strong class="system_title">Data Successfully Updated.</strong></li>');
                break;
            case 3:
                $('#message').html('<li class="red"><span class="ico"></span><strong class="system_title">Assets Identification Number Already Entered</strong></li>');
                break;
            case 4:
                $('#message').html('<li class="blue"><span class="ico"></span><strong class="system_title">දත්තයන් නිවැරදිනම් Approve ද වැරදි දත්තයන් ඇතුලත් කර තිබේනම් Reject ද Button එක Click කරන්න.</strong></li>');
                break;
            case 5:
                $('#message').html('<li class="red"><span class="ico"></span><strong class="system_title">Data Error. Please Check Data !</strong></li>');
                break;
            case 6:
                $('#message').html('<li class="red"><span class="ico"></span><strong class="system_title">Error when Database Writing !</strong></li>');
                break;
			case 7:			
			$('#message').html('<li class="green"><span class="ico"></span><strong class="system_title">Data Successfully Rejectd.</strong></li>');
				break;
        }
    }
	
/***************************************************************************************************/	
    function showSidebar(i, id, fundtype)
    {
        var querystring = {
            id:id,
			fundtype:fundtype,
			action: 'showSidebar'
        }
        $.get('index.php', querystring, processResponse);
        function processResponse(result) {
			var item = $.parseJSON(result);
			$('#sidebar'+i).empty();
            if (item.length === 0 && i == 1) {
				$("#sidebar"+i).append('<img src="../pic/1.jpg" alt="A description of the picture" width="230" height="230" />');
			} else {
           $.each(item, function(key, value) {
				$("#sidebar"+i).append('<li id="' + value[1] + '"><a href="#">' + value[0] + '</a></li>');
            });
			}
        } // end processData
    };
/***************************************************************************************************/
	function form_Initalize()
	{
		$('#mainCategory').val("");
		$('#itemCategory').val("");
		$('#itemDescription').val("");
		$('#catalogueno').val("");
		$('#natureOwnership').val("");
		$('#ledgerno').val("");
		$('#category').val("");
		$('#assetsno').val("");
		$('#classificationno').val("");
		$('#ledgerFoliono').val("");
		$('#purchasedDate').val("");
		$('#quantity').val("");
		$('#unitValue').val("");
		$('#receivedDate').val("");
		$('#presentLocation').val("");
		$('#Remarks').val("");
		$('#id').val(0);
		$('#groupId').val(0);
		$('#counterId').val(0);
		$('#identificationno').val("");
		$('#identificationnos').html("");
		$('#assetsno').val("");
		$('#newAssestno').val("");
		$('#heading1').html("Approve - ");
		$('#heading2').html("")
		$("#RejectBtn").hide();
		$("#save").hide();
		$("#resetBtn").hide();
		$("#RejectBtn").hide();
		$('#identificationnos').height(20.15);
		$("#apprivedReason").hide();
		$("#appriveDetails").show();
		notapprived = 0;
		setMessage(0);
	};	
setMessage(0);
showSidebar(1,1,fundtype);
showSidebar(2,2,fundtype);
$("#save").hide();
$("#resetBtn").hide();
$("#RejectBtn").hide();
$("#apprivedReason").hide();
$("input, select").prop('disabled', true);
});
/***************************************************************************************************/
</script>
<div id="page">
    <div class="inner">
	<div class="title_wrapper">
		<h2><span id ="heading1">Approve -</span> Plant & Machinery Details - <span id ="heading2"></span></h2>
		<span class="title_wrapper_left"></span>
		<span class="title_wrapper_right"></span>
	</div>
	<div class="panel panel-primary">
	<ul class="system_messages" id="message"></ul>	
	<form role="form" id="data" name="data" method="post" action="index.php" data-toggle="validator">
	<input type="hidden" name="action" value="approve_save_new" />
	<input type="hidden" name="groupId" id="groupId" value="0" />
	<div class="panel-body" id="appriveDetails">
	   <div class="row">
			<div class="col-md-4">
				<div class="form-group">
					<label><?php echo $tList[2][$lang]?></label>
					<input name="mainCategory" type="text" id="mainCategory" class="form-control"/>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label><?php echo $tList[3][$lang]?></label>
					<input name="itemCategory" type="text" id="itemCategory" class="form-control"/>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label><?php echo $tList[4][$lang]?></label>
					<input name="itemDescription" type="text" id="itemDescription" class="form-control"/>
				</div>
			</div>
			</div>
			<div class="row">
			<div class="col-md-2">
				<div class="form-group">
					<label><?php echo $tList[5][$lang]?></label>
					<input name="catalogueno" type="text" id="catalogueno" class="form-control"/>
				</div>
			</div>

			<div class="col-md-2">
				<div class="form-group">
					<label>Assets Number</label>
					<input name="assetsno" type="text" id="assetsno" class="form-control"/>
				</div>
			</div>			
			<div class="col-md-2">
				<div class="form-group">
					<label>Classification No</label>
					<input name="newAssestno" type="text" id="newAssestno" class="form-control"/>
				</div>
			</div>			
			<div class="col-md-2">
				<div class="form-group"><label><?php echo $tList[7][$lang]?></label>                                     
					<input name="ledgerno" type="text" id="ledgerno" class="form-control"/>
                </div>
			</div>			
			<div class="col-md-2">
                <div class="form-group"><label><?php echo $tList[8][$lang]?></label>                                              
					<input name="ledgerFoliono" type="text" id="ledgerFoliono" class="form-control"/>
				</div>
			</div>			
			<div class="col-md-2">
				<div class="form-group">
					<label>Ownership</label>
					<input name="natureOwnership" type="text" id="natureOwnership" class="form-control"/>
				</div>
			</div>			
			
		</div>
			<div class="row">		
            <div class="col-md-2">
				<div class="form-group"><label><?php echo $tList[10][$lang]?></label>                                            
					<input name="purchasedDate" type="text" id="purchasedDate" class="form-control"/>
				</div>
            </div>
			<div class="col-md-2">
				<div class="form-group">
					<label><?php echo $tList[11][$lang]?></label>
					<input name="quantity" type="text" id="quantity" class="form-control"/>
				</div>
			</div>
				<div class="col-md-2">
				<div class="form-group">
					<label><?php echo $tList[13][$lang]?></label>
					<input name="unitValue" type="text" id="unitValue" class="form-control"/>
				</div>
				</div>
			<div class="col-md-2">
				<div class="form-group">
					<label><?php echo $tList[15][$lang]?></label>
					<input name="receivedDate" type="text" id="receivedDate" class="form-control"/>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label><?php echo $tList[16][$lang]?></label>
					<input name="presentLocation" type="text" id="presentLocation" class="form-control"/>
				</div>
			</div>                                      
 		</div>  
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label><?php echo $tList[18][$lang]?>/<?php echo $tList[9][$lang]?></label>
					<textarea name="identificationnos" id="identificationnos" class="form-control" rows="3"></textarea>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label><?php echo $tList[17][$lang]?></label>
					<input name="remarks" type="text" id="remarks" class="form-control"/>
				</div>
			</div>
		</div>			
    </div>
	<div class="panel-body" id="apprivedReason">	
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<label><?php echo $tList[19][$lang]?></label>
					<input name="notapprivedReason" type="text" id="notapprivedReason" class="form-control"/>
				</div>
			</div>
		</div>
	</div>
   <div class="panel-footer"> 
	<button type="submit" class="btn btn-primary" id="save" ><span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span> Approve</button>
	<button type="reset" class="btn btn-info" id="resetBtn"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span> Reset</button>
	<button class="btn btn-danger" id="RejectBtn"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Not Approve</button>
   </div>
  </form>
</div>
	</div>
</div>	
<?php
include('sidebar.php');
//include('sidebar_sub.php');
include '../view/footer.php';
?>











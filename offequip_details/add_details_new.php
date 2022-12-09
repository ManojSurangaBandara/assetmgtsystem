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
		background-color: #ebfafa;
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
	var min = 0;
	var max = 0;
    $('#mainCategory').change(function() {
        getitemCategory($(this).val(), "", type);
    });

    $('#itemCategory').change(function() {
        getitemDescription($('#mainCategory').val(), $(this).val(), "", type);
    });
	
    $('#itemDescription').change(function() {
        getitemCatalogueno($('#mainCategory').val(), $('#itemCategory').val(), $(this).val(), "", type);
    });

    $('#catalogueno').change(function() {
        getcatalogueDetails($(this).val());
    });
/***************************************************************************************************/	
	$('.date').datepicker({
		format: 'yyyy-mm-dd',
	}).on('changeDate', function (e) {
		$(this).datepicker('hide');
	});
/***************************************************************************************************/
    function getmainCategory(type)
    {
        var querystring = {
            type: type,
            action: 'getmainCategory'
        }
        $.get('index.php', querystring, processResponse);
        function processResponse(result) {
			var mainCategory = $.parseJSON(result);
            var option = '<option value="">---</option>';
            $.each(mainCategory, function(key, value) {
				option += '<option value="' + value.mainCategory + '">' + value.mainCategory + '</option>';
            });
            $('#mainCategory').html(option);
        } // end processData
    };
/***************************************************************************************************/
    function getitemCategory(mainCategory, itemCategory, type) {
        var querystring = {
            type: type,
			mainCategory: mainCategory,
            action: 'getitemCategory'
        }
        $.get('index.php', querystring, processResponse);
        function processResponse(result) {
			var item = $.parseJSON(result);
            var option = '<option value="">---</option>';
            $.each(item, function(key, value) {
                option += '<option value="' + value.itemCategory + '">' + value.itemCategory + '</option>';
            });
            $('#itemCategory').html(option);
            $('#itemCategory option[value="' + itemCategory + '"]').attr('selected', 'selected');
			//$('#itemDescription').html("");
			//$('#catalogueno').html("");
        } // end processData
    };
/***************************************************************************************************/
    function getitemDescription(mainCategory, itemCategory, itemDescription,  type) {
		var querystring = {
            type: type,
			mainCategory: mainCategory,
			itemCategory: itemCategory,
            action: 'getitemDescription'
        }
        $.get('index.php', querystring, processResponse);
        function processResponse(result) {
			var item = $.parseJSON(result);
            var option = '<option value="">---</option>';
            $.each(item, function(key, value) {
                option += '<option value="' + value.itemDescription + '">' + value.itemDescription + '</option>';
            });
            $('#itemDescription').html(option);
            $('#itemDescription option[value="' + itemDescription + '"]').attr('selected', 'selected');
			//$('#catalogueno').html("");
        } // end processData
    };
/***************************************************************************************************/
    function getitemCatalogueno(mainCategory, itemCategory, itemDescription, Catalogueno, type) {
        var querystring = {
            type: type,
			mainCategory: mainCategory,
			itemCategory: itemCategory,
			itemDescription: itemDescription,
            action: 'getitemCatalogueno'
        }
        $.get('index.php', querystring, processResponse);
        function processResponse(result) {
			var item = $.parseJSON(result);
            var option = '<option value="">---</option>>';
            $.each(item, function(key, value) {
                option += '<option value="' + value.catalogueno + '">' + value.catalogueno + '</option>';
            });
            $('#catalogueno').html(option);
            $('#catalogueno option[value="' + Catalogueno + '"]').attr('selected', 'selected');
        } // end processData
    };

/***************************************************************************************************/
   function getcatalogueDetails(catalogueno) {
	 	var querystring = {
			catalogueno: catalogueno,
			action: 'getcatalogueDetails'
		}
		$.get('index.php', querystring, processResponse);
		function processResponse(result) {
		var obj1 = $.parseJSON(result);
		$('#assetsno').val(obj1.assetsno);
		$('#newAssestno').val(obj1.newAssestno);
		$('#n_mainCategory').val(obj1.mainCategory);
		$('#n_itemCategory').val(obj1.itemCategory);
		$('#n_itemDescription').val(obj1.itemDescription);		
		min = obj1.minval;
		max = obj1.maxval;
		var range = (max == 0 && min == 0) ? "  Range Not Defined " : "  Range : " + min + " - " + max;
		$("#maxminval").html(range);		
		enable_disable_codebutton();
		}
	};
/***************************************************************************************************/
    function getpresentLocation()
    {
        var querystring = {
            action: 'getpresentLocation'
        }
        $.get('index.php', querystring, processResponse);
        function processResponse(result) {
			var item = $.parseJSON(result);
            var option = '<option value="<?php echo $assetunit; ?>"><?php echo $assetunit; ?></option>';
            $.each(item, function(key, value) {
				option += '<option value="' + value.locations + '">' + value.locations + '</option>';
            });
            $('#presentLocation').html(option);
        } // end processData
    };
	
$("#quantity, #catalogueno").on('change',function(){
	enable_disable_codebutton();
});
/***************************************************************************************************/
function enable_disable_codebutton()
    {
	var m = Math.floor(Number($('#catalogueno').val()));
	var n = Math.floor(Number($('#quantity').val()));
	if (n > 0 && m > 0 && $( "#generatedCode" ).hasClass( "disabled" )) {
		$("#generatedCode").removeClass( "disabled" );	
	} else {
  		if ($( "#generatedCode" ).hasClass( "disabled" )) {
		}  else { 
			$( "#generatedCode" ).addClass( "disabled" );
		}
	}

	};
/***************************************************************************************************/	
$("#generatedCode").on('click',function(){  
	generatedCode();
	return false
});
/***************************************************************************************************/
function generatedCode()
    {
	var querystring = {
			counterId: $('#counterId').val(),
			catalogueno: $('#catalogueno').val(),
			quantity : $('#quantity').val(),
			action: 'generatedCode'
		}
		$.get('index.php', querystring, processResponse);
        function processResponse(result) {
			var item = $.parseJSON(result);
            var option = "";
            $.each(item, function(key, value) {
				option += value + ' ';
            });
            $('#identificationnos').html(option);
        } // end processData
	};
/***************************************************************************************************/
	$("#sidebar1, #sidebar2").on("click", "li", function () {
		var querystring = {
            groupId:$(this).attr('id'),
			action: 'getDetailsGroupID'
        }
        $.get('index.php', querystring, processResponse);
        function processResponse(result) {
			var eqptSriNo;
			var item = $.parseJSON(result);
           $.each(item, function(key, value) {
				if (key == 0) {
					$('#mainCategory').val(value.mainCategory);
					getitemCategory(value.mainCategory, value.itemCategory, type);
					getitemDescription(value.mainCategory, value.itemCategory, value.itemDescription,  type);
					getitemCatalogueno(value.mainCategory, value.itemCategory, value.itemDescription, value.catalogueno, type)
					$('#natureOwnership').val(value.natureOwnership);
					$('#ledgerno').val(value.ledgerno);
					$('#category').val(value.category);
					$('#assetsno').val(value.assetsno);
					$('#classificationno').val(value.classificationno);
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
					$('#heading1').html("EDIT - ");
					$('#heading2').html(value.identificationno);					
					eqptSriNo = value.eqptSriNo;
					//identificationnos = value.identificationno;
				} else{
					eqptSriNo += ';' + value.eqptSriNo;
					//identificationnos += ' ' + value.identificationno;
				}
				$('#eqptSriNo').val(eqptSriNo);
				//$('#identificationnos').val(identificationnos);
				if (value.notapprived == 1){
					$('#message').html('<li class="red"><span class="ico"></span><strong class="system_title">' + value.notapprivedReason + '</strong></li>');
				} else {
					setMessage(4);
				}
            });
		enable_disable_codebutton()
		$("#deleteBtn").show();
		$("#save").html('<span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span> Update');
		} // end processData
		$("html, body").animate({scrollTop: 0}, "slow");
		$("input, select").prop('disabled', false);
		return false;
	});
/***************************************************************************************************/
	$("#sidebar3").on("click", "li", function () {
		var querystring = {
            id:$(this).attr('id'),
			action: 'getDetailsById'
        }
        $.get('index.php', querystring, processResponse);
        function processResponse(result) {
			var item = $.parseJSON(result);
			$('#mainCategory').val(item.mainCategory);
			getitemCategory(item.mainCategory, item.itemCategory, type);
			getitemDescription(item.mainCategory, item.itemCategory, item.itemDescription,  type);
			getitemCatalogueno(item.mainCategory, item.itemCategory, item.itemDescription, item.catalogueno, type)
			$('#natureOwnership').val(item.natureOwnership);
			$('#ledgerno').val(item.ledgerno);
			$('#category').val(item.category);
			$('#classificationno').val(item.classificationno);
			$('#ledgerFoliono').val(item.ledgerFoliono);
			$('#purchasedDate').val(item.purchasedDate);
			$('#quantity').val(1);
			$('#unitValue').val(item.unitValue);
			$('#receivedDate').val(item.receivedDate);
			$('#presentLocation').val("<?php echo $assetunit; ?>");
			$('#Remarks').val(item.Remarks);
			$('#eqptSriNo').val(item.eqptSriNo);
			$('#identificationnos').html("");
			$('#id').val(0);
			$('#groupId').val(0);
			$('#counterId').val(0);
			$('#identificationno').val("");
			$('#assetsno').val(item.assetsno);
			$('#newAssestno').val(item.newAssestno);
			$('#heading1').html("Add Transfer Details - ");
			$('#heading2').html(item.identificationno);
			$('#receiveFromUnits').val(item.id);			
			$("#save").html('<span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span> Save'); 
		} // end processData
		$("html, body").animate({scrollTop: 0}, "slow");
		$("input, select").prop('disabled', true);
		return false;		
	});	
$("form :input").change(function() {
	setMessage(0);
});
$( "#resetBtn" ).click(function() {
	form_Initalize();
	return false;
});
/***************************************************************************************************/
$( "#deleteBtn" ).click(function() {
	if ($('#groupId').val() == 0){
			BootstrapDialog.show({
                type: BootstrapDialog.TYPE_DANGER,
                title: 'No Item Selected: ',
                message: 'First Select the Identification No. to Delete'
            });   
	} else {
	BootstrapDialog.confirm('Are you sure you want to delete this Record?', function(result){
	if(result) {					
		var querystring = {
						groupId: $('#groupId').val(),
						action: 'deleteDetailsByGroupId'
						}
		$.get('index.php', querystring, processResponse);
		function processResponse(data) {
			alert(data);
			if (data > 0) {
				$.notifyBar({ cssClass: "warning", html: "Data has been delete...!" });	// error, success, warning or custom CSS class
				setMessage(7);
				form_Initalize();
				showSidebar(1,1,fundtype);
				showSidebar(2,2,fundtype);
				showSidebar(3,3,fundtype);
			} else {
				setMessage(7);
			} 
			} // end processData													
		$("html, body").animate({scrollTop: 0}, "slow");
	}
			});
	}
	return false;
});
/***************************************************************************************************/
    $("#data").validate({
		rules: {
            "mainCategory": { required: true },
            "itemCategory": { required: true },
            "itemDescription": {required: true },
            "catalogueno": { required: true },
            "natureOwnership": { required: true },
            "ledgerno": { required: true },
            "category": { required: true },
            "classificationno": { required: true },
            "ledgerFoliono": { required: true },
            "purchasedDate": { required: true },
            "quantity": { required: true },
            "unitValue": { required: true },
            "eqptSriNo": { required: true },
            "receivedDate": { required: true },
            "presentLocation": { required: true },
            "identificationnos": { required: true },
			"assetsno": { required: true },
			"newAssestno": { required: true }
        },
        //perform an AJAX post to ajax.php
        submitHandler: function() {
			$("input, select").prop('disabled', false);
			var formData = $("#data").serialize();
			$.post('index.php', formData, processData).error(errorResponse);
            function processData(result) {
				if (result == '1') {
                    $.notifyBar({ cssClass: "success", html: "Data has been Saved...!" });
					setMessage(1);
					showSidebar(1,1,fundtype);
					showSidebar(2,2,fundtype);
					showSidebar(3,3,fundtype);
					form_Initalize();
                } else if (result == '2') {
                    setMessage(2);
                } else if (result == '3') {
                    setMessage(3);
				} else {
                    setMessage(5);
                }
            } // end processData
            function errorResponse() {
                setMessage(6);              
            }
            $("html, body").animate({scrollTop: 0}, "slow");
            return false;
        }
    }); 
$('#identificationnos').focus(function() {
  $( this ).blur();
});
/***************************************************************************************************/
$("#unitValue").blur(function() {
	var unitValue = parseFloat($('#unitValue').val());
	if(max == 0 && min == 0){
	} else {	
		if (unitValue >= parseFloat(min) && unitValue <= parseFloat(max)) {

		} else {
			$.notifyBar({ cssClass: "error", html: "Please Check Unit Value...!" });	// error, success, warning or custom CSS class
			//alert("Please Check Unit Value");	
		}
	}
	});
/***************************************************************************************************/
    function setMessage(err)
    {
        switch (err) {
            case 0:
                $('#message').html('<li class="blue"><span class="ico"></span><strong class="system_title">Enter Data and press - Save - Button</strong></li>');
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
                $('#message').html('<li class="blue"><span class="ico"></span><strong class="system_title">Modify Data and Press Update Button.</strong></li>');
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
		$("input, select").prop('disabled', false);
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
		$('#eqptSriNo').val("");
		$('#assetsno').val("");
		$('#newAssestno').val("");
		$('#heading1').html("ADD - ");
		$('#heading2').html("")
		$("#deleteBtn").hide();
		$('#receiveFromUnits').val(0);
		$("#save").html('<span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span> Save');	
	};	
getmainCategory(type);
getpresentLocation();
setMessage(0);
showSidebar(1,1,fundtype);
showSidebar(2,2,fundtype);
showSidebar(3,3,fundtype);
$("#deleteBtn").hide();
});
/***************************************************************************************************/
function isNumberKey(evt){
	var charCode = (evt.which) ? evt.which : event.keyCode
	if (charCode > 31 && (charCode != 46 &&(charCode < 48 || charCode > 57)))
		return false;
	return true;
}
/***************************************************************************************************/
</script>
<div id="page">
    <div class="inner">
	<div class="title_wrapper">
		<h2><span id ="heading1">ADD -</span> Office Equipment Details - <span id ="heading2">New</span></h2>
		<span class="title_wrapper_left"></span>
		<span class="title_wrapper_right"></span>
	</div>
	<div class="panel panel-primary">
	<ul class="system_messages" id="message"></ul>	
	<form role="form" id="data" name="data" method="post" action="index.php" data-toggle="validator">
	<input type="hidden" name="action" value="add_detail_new_save" />
	<input type="hidden" name="id" id="id" value="0" />
	<input type="hidden" name="groupId" id="groupId" value="0" />
	<input type="hidden" name="counterId" id="counterId" value="0" />
	<input type="hidden" name="identificationno" id="identificationno" value="0" />
	<input type="hidden" name="assetsno" id="assetsno" value="" />
	<input type="hidden" name="newAssestno" id="newAssestno" value="" />
	<input type="hidden" name="receiveFromUnits" id="receiveFromUnits" value="0" />
	<input type="hidden" name="fundtype" id="fundtype" value="<?php echo $fundtype; ?>" />
	<div class="panel-body">
	   <div class="row">
			<div class="col-md-3">
				<div class="form-group">
					<label><?php echo $tList[2][$lang]?></label>
					<select id="mainCategory" name="mainCategory" class="form-control">
						<option value="">---</option>
					</select>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label><?php echo $tList[3][$lang]?></label>
					<select class="form-control" id="itemCategory" name="itemCategory">
						<option value="">--</option>
					</select>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label><?php echo $tList[4][$lang]?></label>
					<select class="form-control" id="itemDescription" name="itemDescription">
						<option value="">--</option>
					</select>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label><?php echo $tList[5][$lang]?></label>
					<select class="form-control" id="catalogueno" name="catalogueno">
						<option value="">--</option>
					</select>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-3">
				<div class="form-group"><label><?php echo $tList[33][$lang]?></label>
					<select class="form-control" id="natureOwnership" name="natureOwnership">
						<option value=""></option>
						<option value="DONATION">DONATION</option>																
						<option value="PURCHASE">PURCHASE</option>
					</select>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group"><label><?php echo $tList[7][$lang]?></label>                                     
					<input name="ledgerno" type="text" id="ledgerno" class="form-control" placeholder="Enter ..." value="" style="text-transform:uppercase"/>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group"><label><?php echo $tList[8][$lang]?></label>                                              
					<input name="ledgerFoliono" type="text" id="ledgerFoliono" class="form-control" placeholder="Enter ..." value="" style="text-transform:uppercase"/>
				</div>
            </div>
            <div class="col-md-3">
				<div class="form-group"><label><?php echo $tList[10][$lang]?></label>                                            
					<input name="purchasedDate" type="text" id="purchasedDate" size="25" class="form-control date" placeholder="" value=""  autocomplete="off"/>
				</div>
            </div>
            </div>
		<div class="row">
			<div class="col-md-3">
				<div class="form-group">
					<label><?php echo $tList[11][$lang]?></label>
					<input name="quantity" type="text" onkeypress="return isNumberKey(event)" id="quantity" class="form-control" placeholder="Enter ..." value=""  autocomplete="off"/>
				</div>
			</div>
				<div class="col-md-3">
				<div class="form-group">
					<label><?php echo $tList[13][$lang]?></label>
					<input name="unitValue" type="text" onkeypress="return isNumberKey(event)" id="unitValue" class="form-control" placeholder="Enter ..." value=""  autocomplete="off"/><span name="maxminval"  id="maxminval"></span>
				</div>
			</div><div class="col-md-6">
				<div class="form-group"><label><?php echo $tList[9][$lang]?><span style="color:blue;"> (ප්‍රමාණය එකකට වඩා ඇත්නම් Serial No අතර ";‍‍‍‍" යොදන්න.)</span></label>
					<input name="eqptSriNo" type="text" id="eqptSriNo" class="form-control" placeholder="Enter ..." value="" autocomplete="off" style="text-transform:uppercase"/>
				</div>
			</div>                                       
 		</div>  
		<div class="row">
			<div class="col-md-3">
				<div class="form-group">
					<label><?php echo $tList[15][$lang]?></label>
					<input name="receivedDate" type="text" id="receivedDate" class="form-control date" placeholder="" value="" autocomplete="off"/>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label><?php echo $tList[16][$lang]?></label>
					<select class="form-control" id="presentLocation" name="presentLocation">
						<option value="<?php echo $assetunit; ?>"><?php echo $assetunit; ?></option>
					</select>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label><?php echo $tList[17][$lang]?></label>
					<input name="remarks" type="text" id="remarks" class="form-control" placeholder="" value="" autocomplete="off" style="text-transform:uppercase"/>
				</div>
			</div>
		</div> 
		<div class="row">
			<div class="col-md-2">
				<div class="form-group">
					<button class="btn btn-info disabled" id="generatedCode"><span class="glyphicon" aria-hidden="true"></span>Generate Number</button>
				</div>
			</div>
			<div class="col-md-10">
				<div class="form-group">
					<label><?php echo $tList[18][$lang]?></label>
					<textarea name="identificationnos" id="identificationnos" class="form-control" rows="3" placeholder="Enter ..."></textarea>
				</div>
			</div>
		</div>	
    </div>
   <div class="panel-footer"> 
	<button type="submit" class="btn btn-primary" id="save"><span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span> Save</button>
	<button type="reset" class="btn btn-info" id="resetBtn"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span> Reset</button>
	<button class="btn btn-danger" id="deleteBtn"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Delete</button>
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











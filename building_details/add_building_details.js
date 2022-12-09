$(document).ready(function() {

    $('#assetscenter').change(function() {
        getAsstUnit($(this).val(), "");
    });

    $('#province').change(function() {
        getDistrict($(this).val(), "");
    });

    $('#district').change(function() {
        getdsDivision($(this).val(), "")
    });

    $('#dsDivision').change(function() {
        getgsDivision($(this).val(), "")
    });

    $('#category').change(function() {
        var querystring = {
            category: $(this).val(),
            action: 'findAssetsnoByCategory_Ajax'
        }
        $.get('index.php', querystring, processResponse);
        function processResponse(result) {
            var numbers = $.parseJSON(result);
            $('#assetsno').val(numbers[0]);
            $('#classificationno').val(numbers[1]);
        } // end processData
    });
	
    $("#button").click(
            function(e) {
                //alert($('#id').val());
                codegenerate();
                e.preventDefault();
            }
    );

    $('#identificationno').focus(function() {
        codegenerate();
    });

    function codegenerate()
    {
        var querystring = {
            id: $('#id').val(),
            assetsUnit: $('#assetunit').val(),
            assetsno: $('#assetsno').val(),
            district: $('#district').val(),
            ownership: $('#ownership').val(),
            counterID: $('#counterID').val(),
            action: 'generateCode_Ajax'
        }

        $.get('index.php', querystring, processResponse);
        function processResponse(result) {
            $('#identificationno').val(result);
        } // end processData	
    }

	
    $('#sidebar1, #sidebar2').delegate('li', 'click', function() {
		var id = $(this).attr('id');
        $.ajax({
            type: "GET",
            url: "index.php",
            data: "action=update_Details_Ajax&id=" + id,
            success: function(result) { 				
				var item = $.parseJSON(result);
				$('#title span h2').text(item.identificationno);
				$('#submit').prop('value', 'Update Building Details');
                setMessage(4);
                $("#assetscenter").val(item.assetscenter);
                getAsstUnit(item.assetscenter, item.assetunit);
                $("#province").val(item.province);
                getDistrict(item.province, item.district);
                getdsDivision(item.district, item.dsDivision);
                getgsDivision(item.dsDivision, item.gsDivision);
                $('#category').val(item.buildingCategory);
                $('#assetsno').val(item.assetsno);
                $('#classificationno').val(item.classificationno);
				$('#landName').val(item.landname);
				$('#ownerName').val(item.ownerName);
				$('#buildingType').val(item.buildingType);
				$('#rentAndRate').val(item.rentAndRate);
				$('#ownership').val(item.ownership);
				$('#natureOwnership').val(item.natureOwnership);
				$('#regOwnerName').val(item.regOwnerName);
				$('#identificationno').val(item.identificationno);
				$('#buildingno').val(item.buildingno);
				$('#planno').val(item.planno);
				$('#plandate').val(item.plandate);
				$('#areaMeasure').val(item.areaMeasure);
				$('#area').val(item.area);
				$('#feets').val(item.feets);
				$('#constructionCost').val(item.constructionCost);
				$('#additionsValue').val(item.additionsValue);
				$('#alterationValue').val(item.alterationValue);
				$('#acquisitionInstitute').val(item.acquisitionInstitute);
				$('#acquisitiondate').val(item.acquisitiondate);
				$('#remarks').val(item.remarks);
                $('#notapprived').val(item.notapprived);
                $('#notapprivedReason').val(item.notapprivedReason);
                $('#identificationnoTem').val(item.identificationno);
                $('#id').val(item.id);
                $('#counterID').val(item.counterID); 
				$('#update').show();
				if (item.notapprived == 1) {
					$('#notapprove').show();
				} else {
					$('#notapprove').hide();
				}
            }

        });
    });
	
		$("#update").click(
            function(e) {
							if ($('#id').val() != 0) {
								$("#confirm").html("<p>Are you sure you want to Delete this record? " + $('#identificationno').val() + $('#id').val() +"</p>");
								var id=$('#id').val();												
								$("#confirm").dialog({
								resizable: false,
								modal: true,
								height: 200,
								width: 400,								
								buttons: {
								"Confirm": function () {
									var querystring = {
													id: id,
													action: 'delete_Detail_Ajax'
												}
												
												$.get('index.php', querystring, processResponse);
												function processResponse(data) {
													//
													if (data=='1') {
														$('#message').html('<li class="green"><span class="ico"></span><strong class="system_title">Data Successfully Deleted.</strong></li>');
														showSidebar(3);
														showSidebar2(4);
														$('#update').hide();
														$('#notapprove').hide();
													} else {
														$('#message').html('<li class="red"><span class="ico"></span><strong class="system_title">Data Error. Please Check Data !</strong></li>');
													}
													} // end processData													
												$("html, body").animate({scrollTop: 0}, "slow");
												$(this).dialog('close');
												},
								"Cancel": function () {
									$(this).dialog('close');
									}
								} 
								});
								e.preventDefault();
									
								} });
								
	showSidebar(3);
    showSidebar2(4);
	$('#update').hide();
	$('#notapprove').hide();
	setMessage(0);	
}); // end ready
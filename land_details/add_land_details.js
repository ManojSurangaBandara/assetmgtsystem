$(document).ready(function() {
    $('.date').datepicker({dateFormat: 'yy-mm-dd',
        maxDate: '0',
		changeMonth : true,
        changeYear: true});

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

    function setMessage(err)
    {
        switch (err) {
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
                $('#message').html('<li class="blue"><span class="ico"></span><strong class="system_title">Modify Data and Press Update Land Details Button.</strong></li>');
                break;
            case 5:
                $('#message').html('<li class="red"><span class="ico"></span><strong class="system_title">Data Error. Please Check Data !</strong></li>');
                break;
            case 6:
                $('#message').html('<li class="red"><span class="ico"></span><strong class="system_title">Error when Database Writing !</strong></li>');
                break;
        }
    }
    //validation rules
    $("#add_form").validate({
        rules: {
            "assetscenter": {
                required: true
            },
            "assetunit": {
                required: true
            },
            "province": {
                required: true
            },
            "district": {
                required: true
            },
            "dsDivision": {
                required: true
            },
            "gsDivision": {
                required: true
            },
            "category": {
                required: true
            },
            "assetsno": {
                required: true
            },
            "classificationno": {
                required: true
            },
            "natureOwnership": {
                required: true
            },
            "ownership": {
                required: true
            },
            "landname": {
                required: true
            },
            "register": {
                required: true
            },
            "planno": {
                required: true
            },
            "deedno": {
                required: true
            },
            "deeddate": {
                required: true
            },
            "landNature": {
                required: true
            },
            "areaMeasure": {
                required: true
            },
            "estimatedValue": {
                required: true,
                number: true
            },
            "remarks": {
                required: true
            },
            "identificationno": {
                required: true
            }
        },
        //perform an AJAX post to ajax.php
        submitHandler: function() {

            var formData = $("#add_form").serialize();
            $.post('index.php', formData, processData).error(errorResponse);
            function processData(data) {
                if (data == '1') {
                    setMessage(1);
                    $('#id').val(0);
                    showSidebar(3);
                    showSidebar2(4);
                    $('#landname').val("");
                    $('#register').val("");
                    $('#planno').val("");
                    $('#deedno').val("");
                    $('#deeddate').val("");
                    $('#landNature').val("");
                    $('#estimatedValue').val("");
                    $('#remarks').val("");
                    $('#identificationno').val("");
                    $('#title span h2').text('Add Land Details');
                    $('#submit').prop('value', 'Add Land Details');
					$('#update').hide();
					$('#notapprove').hide();
                } else if (data == '2') {
                    setMessage(2);
                    $("#submit").prop('value', 'Add Buyer Details');
                } else if (data == '3') {
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

    function showSidebar(id)
    {
        $.ajax({
            type: "GET",
            url: "index.php",
            data: "action=showSidebar&id=" + id,
            success: function(result) {
                $('#sidebar1').empty();
                var item = $.parseJSON(result);
                var options = '';
                $.each(item, function(key, value) {
                    $("#sidebar1").append('<li id="' + value.id + '"><a href="#">' + value.identificationno + '</a></li>');
                });
            }
        });
    }
    function showSidebar2(id)
    {
        $.ajax({
            type: "GET",
            url: "index.php",
            data: "action=showSidebar&id=" + id,
            success: function(result) {
                $('#sidebar2').empty();
                var item = $.parseJSON(result);
                var options = '';
                $.each(item, function(key, value) {
                    $("#sidebar2").append('<li id="' + value.id + '"><a href="#">' + value.identificationno + '</a></li>');
                });
            }
        });

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
            var option = '';
            for (var i = 0; i < numbers.length; i++) {
                option += '<option value="' + numbers[i] + '">' + numbers[i] + '</option>';
            }
            $('#assetunit').html(option);
            $('#assetunit option[value="' + assetunit + '"]').attr('selected', 'selected');
        } // end processData
    }
    ;
    function getDistrict(province, dist)
    {
        var querystring = {
            province: province,
            action: 'findDistrictByProvince_Ajax'
        }
        $.get('index.php', querystring, processResponse);
        function processResponse(result) {
            var item = $.parseJSON(result);
            var option = '<option></option>';
            $.each(item, function(key, value) {
                option += '<option value="' + value + '">' + value + '</option>';
            });
            $('#district').html(option);
            $('#district option[value="' + dist + '"]').attr('selected', 'selected');
        } // end processData
    }
    ;
    function getdsDivision(district, ds) {
        var querystring = {
            district: district,
            action: 'findDSByDistrict_Ajax'
        }
        $.get('index.php', querystring, processResponse);
        function processResponse(result) {
            var numbers = $.parseJSON(result);
            var option = '<option></option>';
            for (var i = 0; i < numbers.length; i++) {
                option += '<option value="' + numbers[i] + '">' + numbers[i] + '</option>';
            }
            $('#dsDivision').html(option);
            $('#dsDivision option[value="' + ds + '"]').attr('selected', 'selected');
        } // end processData
    }
    ;
    function getgsDivision(gsDivision, gs) {
        var querystring = {
            dsDivision: gsDivision,
            action: 'findGSByDS_Ajax'
        }
        $.get('index.php', querystring, processResponse);
        function processResponse(result) {
            var numbers = $.parseJSON(result);
            var option = '<option></option>';
            for (var i = 0; i < numbers.length; i++) {
                option += '<option value="' + numbers[i] + '">' + numbers[i] + '</option>';
            }
            $('#gsDivision').html(option);
            $('#gsDivision option[value="' + gs + '"]').attr('selected', 'selected');
        } // end processData
    }
    ;
    function getLastCountID() {
        var querystring = {
            action: 'getLastCountID_Ajax'
        }
        $.get('index.php', querystring, processResponse);
        function processResponse(result) {
            var numbers = $.parseJSON(result);
            var option = '<option></option>';
            for (var i = 0; i < numbers.length; i++) {
                option += '<option value="' + numbers[i] + '">' + numbers[i] + '</option>';
            }
            $('#gsDivision').html(option);
            $('#gsDivision option[value="' + gs + '"]').attr('selected', 'selected');
        } // end processData
    }
    ;
    $('#sidebar1, #sidebar2').delegate('li', 'click', function() {
        var id = $(this).attr('id');
        $.ajax({
            type: "GET",
            url: "index.php",
            data: "action=update_Details_Ajax&id=" + id,
            success: function(result) {
                var item = $.parseJSON(result);
                $('#title span h2').text(item.identificationno);
                $('#submit').prop('value', 'Update Land Details');
                setMessage(4);
                // $('#message').html('<li class="blue"><span class="ico"></span><strong class="system_title">Modify Data and Press Update Land Details Button.</strong></li>');
                $("#assetscenter").val(item.assetscenter);
                getAsstUnit(item.assetscenter, item.assetunit);
                $("#province").val(item.province);
                getDistrict(item.province, item.district);
                getdsDivision(item.district, item.dsDivision);
                getgsDivision(item.dsDivision, item.gsDivision);
                $('#category').val(item.category);
                $('#assetsno').val(item.assetsno);
                $('#classificationno').val(item.classificationno);
                $('#identificationno').val(item.identificationno);
                $('#register').val(item.register);
                $('#landname').val(item.landname);
                $('#natureOwnership').val(item.natureOwnership);
                $('#ownership').val(item.ownership);
                $('#planno').val(item.planno);
                $('#deedno').val(item.deedno);
                $('#deeddate').val(item.deeddate);
                $('#landNature').val(item.landNature);
                $('#areaMeasure').val(item.areaMeasure);
                $('#area').val(item.area);
                $('#acre').val(item.acre);
                $('#rood').val(item.rood);
                $('#parch').val(item.parch);
                $('#estimatedValue').val(item.estimatedValue);
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
    $(document).on("keypress", ".text", function(e) {
        if (e.which == 13) {
            return false; // prevent the button click from happening
        }
    });
	    $("#update").click(
            function(e) {
							if ($('#id').val() != 0) {
								$("#confirm").html("<p>Are you sure you want to Delete this record? " + $('#identificationno').val() + "</p>");
								var id=$('#id').val();												
								$("#confirm").dialog({
								resizable: false,
								modal: true,
								height: 150,
								width: 400,								
								buttons: {
								"Confirm": function () {
									//$(this).dialog('close');
									//alert($('#id').val());
									var querystring = {
													id: id,
													action: 'delete_LandDetail_Ajax'
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
}); // end ready
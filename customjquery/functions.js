    $('.date').datepicker({dateFormat: 'yy-mm-dd',
        maxDate: '0',
		changeMonth : true,
        changeYear: true});
    
$(".text").keypress(function(event) {
        if(event.keyCode == 13) { 
        textboxes = $("input.text");
        debugger;
        currentBoxNumber = textboxes.index(this);
        if (textboxes[currentBoxNumber + 1] != null) {
            nextBox = textboxes[currentBoxNumber + 1]
            nextBox.focus();
            nextBox.select();
            event.preventDefault();
            return false 
            }
        }
    });
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
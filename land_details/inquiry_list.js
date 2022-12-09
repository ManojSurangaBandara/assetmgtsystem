$(document).ready(function() {
	$('.date').datepicker({dateFormat: 'yy-mm-dd',
        maxDate: '0',
        changeMonth: true,
        changeYear: true});
    $('#assetscenter').change(function() {
        getAsstUnit($(this).val(), "");
    });
    $('#searchby').change(function() {

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
            var option = '<option value=""></option>';
            for (var i = 0; i < numbers.length; i++) {
                option += '<option value="' + numbers[i] + '">' + numbers[i] + '</option>';
            }
            $('#assetunit').html(option);
            $('#assetunit option[value="' + assetunit + '"]').attr('selected', 'selected');
        } // end processData
    }
    ;
    $("#submit").click(
            function(e) {
                $("#newtable").find("tr:gt(0)").remove();
                var formData = $("#add_form").serialize();
                $.post('index.php', formData, processData);
                function processData(data) {
                    var obj1 = $.parseJSON(data);
                    var abc = '';
                    for (var i = 0; i < obj1.length; i++) {
                        abc = '<tr class="rows" id="' + obj1[i].id + '"><td>' + (i + 1) + '</td><td><a>' + obj1[i].identificationno + '</a></td><td>' + obj1[i].category + '</td><td>' + obj1[i].district + '</td><td>' + obj1[i].dsDivision + '</td><td>' + obj1[i].gsDivision + '</td><td>' + obj1[i].deedno + '</td><td>' + obj1[i].landname + '</td><td>' + obj1[i].area + '</td><td>' + obj1[i].acquisitiondate + '</td><td>' + obj1[i].estimatedValue + '</td></tr>';
                        $('#newtable tr:last').after(abc);
                    }
                } // end processData
				//if ($("#ExpToExcel").prop('checked')){ 

    //window.open('data:application/vnd.ms-excel,' + encodeURIComponent($('#dvData').html()));
			
					// $("#newtable").table2excel({
					//		exclude: ".noExl",
					//		name: "Excel Document Name"
					//	});
		//		}
		//window.open('print_list.php');
                e.preventDefault();
            });
	$("#ExpToExcel").click(function (e) {
    window.open('data:application/vnd.ms-excel,' + encodeURIComponent($('#dvData').html()));
    e.preventDefault();
});

    $("#newtable").delegate("tr.rows", "dblclick", function() {
        var qstring = {
            action: 'getLabels_Ajax'
        }
        $.get('index.php', qstring, pResponse);
        var labels;
        if ($.cookie('lang') === null || $.cookie('lang') === "") {
            var lang = 0;
        } else {
            var lang = $.cookie('lang');
        }
        function pResponse(data) {
            labels = $.parseJSON(data);
            //alert(labels);
        }
        var id = $(this).attr('id');
        var querystring = {
            id: id,
            action: 'toBeApproveList_Ajax'
        }
        $.get('index.php', querystring, processResponse);
        function processResponse(data) {
            var item = $.parseJSON(data);
            var content = '<h3>' + item.identificationno + '</h3>';
			content += "<table cellpadding='1' cellspacing='0' width='100%' border='1' BORDERCOLOR=skyblue>";
            content += '<tr><td>' + labels[0][lang] + '</td><td>' + item.assetscenter + '</td></tr>';
            content += '<tr><td>' + labels[1][lang] + '</td><td>' + item.assetunit + '</td></tr>';
            content += '<tr><td>' + labels[2][lang] + '</td><td>' + item.province + '</td></tr>';
            content += '<tr><td>' + labels[3][lang] + '</td><td>' + item.district + '</td></tr>';
            content += '<tr><td>' + labels[4][lang] + '</td><td>' + item.dsDivision + '</td></tr>';
            content += '<tr><td>' + labels[5][lang] + '</td><td>' + item.gsDivision + '</td></tr>';
            content += '<tr><td>' + labels[6][lang] + '</td><td>' + item.category + '</td></tr>';
            content += '<tr><td>' + labels[7][lang] + '</td><td>' + item.assetsno + "/" + item.classificationno + '</td></tr>';
            content += '<tr><td>' + labels[22][lang] + '</td><td>' + item.identificationno + '</td></tr>';
            content += '<tr><td>' + labels[10][lang] + '</td><td>' + item.register + '</td></tr>';
            content += '<tr><td>' + labels[11][lang] + '</td><td>' + item.landname + '</td></tr>';
            content += '<tr><td>' + labels[8][lang] + '</td><td>' + item.natureOwnership + '</td></tr>';
            content += '<tr><td>' + labels[9][lang] + '</td><td>' + item.ownership + '</td></tr>';
            content += '<tr><td>' + labels[12][lang] + '</td><td>' + item.planno + '</td></tr>';
            content += '<tr><td>' + labels[13][lang] + '</td><td>' + item.deedno + '</td></tr>';
            content += '<tr><td>' + labels[14][lang] + '</td><td>' + item.deeddate + '</td></tr>';
            content += '<tr><td>' + labels[15][lang] + '</td><td>' + item.landNature + '</td></tr>';
            content += '<tr><td>' + labels[16][lang] + '</td><td>' + item.areaMeasure + '</td></tr>';
            content += '<tr><td>' + labels[17][lang] + '</td><td>' + item.area + '</td></tr>';
            content += '<tr><td>' + labels[18][lang] + '</td><td>' + item.estimatedValue + '</td></tr>';
            content += '<tr><td>' + labels[20][lang] + '</td><td>' + item.acquisitiondate + '</td></tr>';
            content += '<tr><td>' + labels[21][lang] + '</td><td>' + item.remarks + '</td></tr>';
            content += "</table>"

            $('#confirm').html(content);
            //$("#confirm").html('<form name="add_form" method="post" id="add_form" action="index.php" class="add_form"><input id="random-input-box" style="width: 99px;" value="' +obj1.identificationno+'" disabled="disabled" /></form>');
            //$('#confirm').append( '<tr><td>' + 'result' +  obj1.identificationno + '</td></tr>' );
            $("#confirm").dialog({
                resizable: false,
                modal: true,
                height: 600,
                width: 500,
                buttons: {
                    "Exit": function() {
                        $(this).dialog('close');
                    }
                }
            });
        }
    });
}); // end ready
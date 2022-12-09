<?php include 'header1.php'; ?>
<script>
$(document).ready(function() {

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
</script>
<div id="page">
<div id="confirm" title="Land Details"></div>
    <div class="section table_section">
        <div class="title_wrapper">
            <h2><?php echo $subMenu[0][$lang]?></h2>
            <span class="title_wrapper_left"></span>
            <span class="title_wrapper_right"></span>
        </div>
        <div class="section_content">
            <div class="sct">
                <div class="sct_left">
                    <div class="sct_right">
                        <div class="sct_left">
                            <div class="sct_right">
                                <fieldset>
                                   
                                        <div class="table_wrapper_inner">
                                            <table id="newtable" cellpadding="1" cellspacing="0" width="100%" border="1" BORDERCOLOR=skyblue style="font-size:12px;">
                                                <tbody> 
                                                <th>SNo</th>
                                                <th><a>Identification No.</a></th>
                                                <th><a>Category Name</a></th>
                                                <th><a>District</a></th>
                                                <th><a>DS Division</a></th>
                                                <th><a>GS Division</a></th>
                                                <th><a>Deed Number</a></th>
                                                <th><a>Land Name</a></th>
                                                <th><a>Area</a></th>
                                                <th><a>DOR</a></th>
                                                <th><a>Value</a></th>
                                                </tr>
                                                <?php $i = 1; ?>
                                                <?php foreach ($items as $exp) { ?>																
                                                    <tr class="rows" id="<?php echo $exp['id'];?>">
                                                        <td><?php echo $i; ?></td>
                                                        <td><a><?php echo $exp['identificationno']; ?></a></td>
                                                        <td><?php echo $exp['category']; ?></td>
                                                        <td><?php echo $exp['district']; ?></td>
                                                        <td><?php echo $exp['dsDivision']; ?></td>
                                                        <td><?php echo $exp['gsDivision']; ?></td>
                                                        <td><?php echo $exp['deedno']; ?></td>
                                                        <td><?php echo $exp['landname']; ?></td>
                                                        <td><?php echo $exp['area']; ?></td>
                                                        <td><?php echo $exp['acquisitiondate']; ?></td>
                                                        <td><?php echo $exp['estimatedValue']; ?></td>
                                                    </tr>
                                                    <?php $i++; ?>
                                                <?php } ?> 
                                                </tbody></table>
                                        </div>
                                    
                                </fieldset>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <span class="scb"><span class="scb_left"></span><span class="scb_right"></span></span>						
        </div>
    </div>

</div>
<?php
//include('sidebar.php');
include '../view/footer.php';
?>
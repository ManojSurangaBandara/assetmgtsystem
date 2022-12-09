<?php
include '../view/header1.php';
?>
<div id="sec_menu">
    <?php include("sub_menu.tpl"); ?>
</div>
<script>	
$(document).ready(function () {
$(".savebttn").click(function(){
  // Holds the product ID of the clicked element
	var id = $(this).attr('id');
	var dggs = $('#dggs_'+id').val();
	alert(dggs);
/* 	var protocoltext1 = $('#protocoltext1_'+id).val();
	var protocoltext2 = $('#protocoltext2_'+id).val();
	var protocollevel1 = $('#protocollevel1_'+id).val();
	var protocollevel2 = $('#protocollevel2_'+id).val();
	var protocollevel3 = $('#protocollevel3_'+id).val();
	var protocollevel4 = $('#protocollevel4_'+id).val();
	var protocollevel5 = $('#protocollevel5_'+id).val();
	var querystring = {
			id: id,
			protocoltext1: protocoltext1,
			protocoltext2: protocoltext2,
			protocollevel1: protocollevel1,
			protocollevel2: protocollevel2,
			protocollevel3: protocollevel3,
			protocollevel4: protocollevel4,
			protocollevel5: protocollevel5,
			action: 'Add_protocol_ajax_save'
		}
		$.get('index.php', querystring, processResponse);
	 function processResponse(result) {
		$('#protocollevel5_'+id).val(result);
		//alert(result);
		} */
	return false
});
}); 
</script>
        <style>
            th
            {
                background-color: blue;
                color: white;
                text-align: center;
                vertical-align: bottom;
                height: 150px;
                padding-bottom: 3px;
                padding-left: 5px;
                padding-right: 5px;
            }

            .verticalText
            {
                text-align: center;
                vertical-align: middle;
                width: 20px;
                margin: 0px;
                padding: 0px;
                padding-left: 3px;
                padding-right: 3px;
                padding-top: 10px;
                white-space: nowrap;
                -webkit-transform: rotate(-90deg); 
                -moz-transform: rotate(-90deg);                 
            };
        </style>
<script>	
$(document).ready(function() {
		$('table').tablesorter({
			widgets        : ['stickyHeaders'],
			usNumberFormat : false,
			sortReset      : true,
			sortRestart    : true
		});	
});
</script>
<div id="page">
    <div class="inner">
        <div class="section">
            <div class="title_wrapper">
                <h2>
                    ADD - PSOs Allow List
                </h2>
                <span class="title_wrapper_left"></span>
                <span class="title_wrapper_right"></span>
            </div>
			<div id="Itmdiv">
		<div class="table_wrapper">
			<div class="table_wrapper_inner">
				<table cellpadding="0" cellspacing="0" width="100%" >
				<tr>
					<th><div class="verticalText">S No.</div></th>
					<th><div class="verticalText">Main Category</div></th>
					<th><div class="verticalText">Item Category</div></th>
					<th><div class="verticalText">dggs</div></th>
					<th><div class="verticalText">ag</div></th>
					<th><div class="verticalText">qmg</div></th>
					<th><div class="verticalText">mgo</div></th>
					<th><div class="verticalText">dginf</div></th>
					<th><div class="verticalText">logcomd</div></th>
					<th><div class="verticalText">cef</div></th>
					<th><div class="verticalText">cso</div></th>
					<th><div class="verticalText">dgsports</div></th>
					<th><div class="verticalText">dgahs</div></th>
					<th><div class="verticalText">Save</div></th>
				</tr><tbody>
				<?php $i = 1; ?>
				<?php foreach($exps as $exp) { ?>																
				<tr class=<?php if ($i % 2) {
								echo "first";
								} else {
								echo "second";
								}?>>
					<td><?php echo $i; ?></td>
					<td><?php echo $exp['mainCategory']; ?></td>
					<td><?php echo $exp['itemCategory']; ?></td>
					<td>
					<form name="add_form" id="add_form" class="add_form" action="." method="post">
						<input type="checkbox" name="dggs_<?php echo $exp['id']; ?>" id="dggs_<?php echo $exp['id']; ?>" value="<?php echo $exp['dggs']; ?>"></td>
						<td><input type="checkbox" name="ag_<?php echo $exp['id']; ?>" id="ag_<?php echo $exp['id']; ?>" value="<?php echo $exp['ag']; ?>"></td>
						<td><input type="checkbox" name="qmg_<?php echo $exp['id']; ?>" id="qmg_<?php echo $exp['id']; ?>" value="<?php echo $exp['qmg']; ?>"></td>
						<td><input type="checkbox" name="mgo_<?php echo $exp['id']; ?>" id="mgo_<?php echo $exp['id']; ?>" value="<?php echo $exp['mgo']; ?>"></td>
						<td><input type="checkbox" name="dginf_<?php echo $exp['id']; ?>" id="dginf_<?php echo $exp['id']; ?>" value="<?php echo $exp['dginf']; ?>"></td>
						<td><input type="checkbox" name="logcomd_<?php echo $exp['id']; ?>" id="logcomd_<?php echo $exp['id']; ?>" value="<?php echo $exp['logcomd']; ?>"></td>
						<td><input type="checkbox" name="cef_<?php echo $exp['id']; ?>" id="cef_<?php echo $exp['id']; ?>" value="<?php echo $exp['cef']; ?>"></td>
						<td><input type="checkbox" name="cso_<?php echo $exp['id']; ?>" id="cso_<?php echo $exp['id']; ?>" value="<?php echo $exp['cso']; ?>"></td>
						<td><input type="checkbox" name="dgsports_<?php echo $exp['id']; ?>" id="dgsports_<?php echo $exp['id']; ?>" value="<?php echo $exp['dgsports']; ?>"></td>
						<td><input type="checkbox" name="dgahs_<?php echo $exp['id']; ?>" id="dgahs_<?php echo $exp['id']; ?>" value="<?php echo $exp['dgahs']; ?>"></td>
						<td><input class = "savebttn" id = "<?php echo $exp['id']; ?>" name="submit" type="submit" value="Save"/>
					</form>
					</td>
				</tr>
				<?php $i++; ?>
				<?php }  ?>
			  </tbody>
			  </table>
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











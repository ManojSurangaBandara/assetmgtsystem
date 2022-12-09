<?php include 'header1.php';?>
<script>	
$(document).ready(function () {
$(".savebttn").click(function(){
  // Holds the product ID of the clicked element
	var id = $(this).attr('id');
	var unitNameSinhala = $('#unitNameSinhala_'+id).val();
	var unitNameSinhalaFull = $('#unitNameSinhalaFull_'+id).val();
	var unitnameEnglishFull = $('#unitnameEnglishFull_'+id).val();
	var querystring = {
			id: id,
			unitNameSinhala: unitNameSinhala,
			unitNameSinhalaFull: unitNameSinhalaFull,
			unitnameEnglishFull: unitnameEnglishFull,
			action: 'add_unitNameSinhala_save'
		}
		$.get('index.php', querystring, processResponse);
	 function processResponse(result) {
		//alert(result);
		}
	return false
});
}); 
</script>
<style>
input[type="text"] {
     width: 100%; 
     box-sizing: border-box;
     -webkit-box-sizing:border-box;
     -moz-box-sizing: border-box;
}
</style>
<div id="page">

        <div class="section">
            <div class="title_wrapper">
                <h2>
                    ADD - Units Sinhala Names
                </h2>
                <span class="title_wrapper_left"></span>
                <span class="title_wrapper_right"></span>
            </div>
			<div id="Itmdiv">
		<div class="table_wrapper">
			<div class="table_wrapper_inner">
			                                        <div id="wrap">
										<div id="table-container">
				<table id="maintable" class="tablesorter" cellpadding="0" cellspacing="0" width="100%" >
				    <colgroup>
					   <col span="1" style="width: 5%;">
					   <col span="1" style="width: 15%;">
					   <col span="1" style="width: 15%;">
					   <col span="1" style="width: 30%;">
					   <col span="1" style="width: 30%;">
					   <col span="1" style="width: 5%;">
					</colgroup>				
				<thead>
				<tr>
					<th>S No.</th>
					<th>Unit</th>
					<th>Unit Name Sinhala</th>
					<th>Unit Name Sinhala Full</th>
					<th>Unit Name English Full</th>
					<th></th>
				</tr>
				</thead>
				<tbody>
				<?php $i = 1; ?>
				<?php foreach($exps as $exp) { ?>																
				<tr class=<?php if ($i % 2) {
								echo "first";
								} else {
								echo "second";
								}?>>
					<td><?php echo $i; ?></td>
					<td><?php echo $exp['unitName']; ?></td>
					<form name="add_form" id="add_form" class="add_form" action="." method="post">
						<input type="hidden" name="action" id="action" value="add_unitNameSinhala" />									
						<input type="hidden" name="id" id="id" value="<?php echo $exp['SN']; ?>"/>
						<td><input type="text" name="unitNameSinhala_<?php echo $exp['SN']; ?>" id="unitNameSinhala_<?php echo $exp['SN']; ?>" value="<?php echo $exp['unitNameSinhala']; ?>"></td>
						<td><input type="text" name="unitNameSinhalaFull_<?php echo $exp['SN']; ?>" id="unitNameSinhalaFull_<?php echo $exp['SN']; ?>" value="<?php echo $exp['unitNameSinhalaFull']; ?>"></td>
						<td><input type="text" name="unitnameEnglishFull_<?php echo $exp['SN']; ?>" id="unitnameEnglishFull_<?php echo $exp['SN']; ?>" value="<?php echo $exp['unitnameEnglishFull']; ?>"></td>
						<td><input class = "savebttn" id = "<?php echo $exp['SN']; ?>" name="submit" type="submit" value="Save"/></td>
					</form>
				</tr>
				<?php $i++; ?>
				<?php }  ?>
			  </tbody>
			  </table>
			  <div id="bottom_anchor"></div>
			  </div>
                                        </div>
			  </div>
			  </div>
		</div>
        </div>


</div>
<script>
function moveScroll(){
    var scroll = $(window).scrollTop();
    var anchor_top = $("#maintable").offset().top;
    var anchor_bottom = $("#bottom_anchor").offset().top;
    if (scroll>anchor_top && scroll<anchor_bottom) {
    clone_table = $("#clone");
    if(clone_table.length == 0){
        clone_table = $("#maintable").clone();
        clone_table.attr('id', 'clone');
        clone_table.css({position:'fixed',
                 'pointer-events': 'none',
                 top:0});
        clone_table.width($("#maintable").width());
        $("#table-container").append(clone_table);
        $("#clone").css({visibility:'hidden'});
        $("#clone thead").css({'visibility':'visible','pointer-events':'auto'});
    }
    } else {
    $("#clone").remove();
    }
}
$(window).scroll(moveScroll); 
</script>
<style>
body { height: 1000px; }
thead{
    background-color:white;
}
</style>
<?php
//include('sidebar.php');
include '../view/footer.php';
?>











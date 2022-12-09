<?php include 'header5.php';?>
<script>
    jQuery(document).ready(function () {
$(".nr").click(function() {
	var $row = $(this).closest("tr");
	var $tds = $row.find("td:nth-child(1)");
	$.each($tds, function() {                
		$("#dam_catalogueno").val($(this).text());
	});
	var $tds = $row.find("td:nth-child(3)");
	$.each($tds, function() {                
		$("#dam_itemDescription").val($(this).text());
	});
});

$(".s_nr").click(function() {
	var $row = $(this).closest("tr");
	var $tds = $row.find("td:nth-child(1)");
	$.each($tds, function() {                
		$("#scale_catalogueno").val($(this).text());
	});
	var $tds = $row.find("td:nth-child(3)");
	$.each($tds, function() {                
		$("#scale_itemDescription").val($(this).text());
	});
});
$("#savebttn").click(function(){
	var scale_catalogueno= $("#scale_catalogueno").prop('value');
	var dam_catalogueno= $("#dam_catalogueno").prop('value');
	var querystring = {
			dam_catalogueno: dam_catalogueno,
			scale_catalogueno: scale_catalogueno, 			
			action: 'scale_catalogue_save'
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
#col-1 {
  position: relative;
  width: 50%;
  float: left;
  height: 100%;
}

#col-2 {
  position: relative;
  width: 50%;
  float: left;
  height: 100%;
}
</style>
<div id="page">
    <div class="section table_section">
        <form action="." method="post" id="search_Expendable__form">
            <input type="hidden" name="action" value="scale_catalogue"/>
            <table width="100%" border="0">
                <tr>
                    <td>
                        <b>Search Item Word:</b>
                    </td>
                    <td>
                        <input type="text" class="text" name="search"  id="search" list="searchs" value="<?php echo $search; ?>"/>
                    </td>
                    <td>  
                        <input type="submit" value="Search" />
                    </td>
                </tr>
            </table>
        </form>
<div id="col-1">
        <div class="title_wrapper">
            <h2>DAM Assets Details List</h2>
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
                                    <input type="text" class="text" name="dam_catalogueno"  id="dam_catalogueno" style='width:110px;background:khaki'/>
									<input type="text" class="text" name="dam_itemDescription"  id="dam_itemDescription" style='width:500px;background:khaki'/>
									<div class="table_wrapper_inner">
                                        <table id="abc" class="tablesorter" cellpadding="1" cellspacing="0" width="100%" border="1" BORDERCOLOR=skyblue style="font-size:11px;">
											<thead>
											<tr>
											<th>Catalogue No</th>
                                            <th>Item Category</th>
                                            <th>Description</th>
											<th>Scale cat. No.</th>                                            
											</tr>
											</thead>
											<tbody>
                                                        <?php $i = 1; ?>
                                                        <?php foreach ($items as $exp) { ?>																
                                                            <tr class="nr">
																<td><nobr><?php echo $exp['catalogueno']; ?></nobr></td>
                                                                <td><?php echo $exp['itemCategory']; ?></nobr></td>
                                                                <td><?php echo $exp['itemDescription']; ?></td>
																<td><?php echo $exp['scale_catalogueno']; ?></td> 																
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
				<div id="col-2">
        <div class="title_wrapper">
            <h2>Scale Assets Details List</h2>
            <span class="title_wrapper_left"></span>
            <span class="title_wrapper_right"></span>
        </div>
		<div class="section_content">
            <div class="sct">
                <div class="sct_left">
                    <div class="sct_right">
                        <div class="sct_left">
                            <div class="sct_right">
							        <input type="text" class="text" name="scale_catalogueno"  id="scale_catalogueno" style='width:110px;background:khaki'/>
									<input type="text" class="text" name="scale_itemDescription"  id="scale_itemDescription" style='width:400px;background:khaki'/>
                                    <input type="submit" value="Add Cataloguenos" id="savebttn"/>
									<div class="table_wrapper_inner">
                                        <table id="abc" class="tablesorter" cellpadding="1" cellspacing="0" width="100%" border="1" BORDERCOLOR=skyblue style="font-size:11px;">
											<thead>
											<tr>
											<th>Catalogue No</th>
                                            <th>Item Category</th>
                                            <th>Description</th>
											<th>DAM cat. No.</th>                                            
											</tr>
											</thead>
											<tbody>
                                                        <?php $i = 1; ?>
                                                        <?php foreach ($items_s as $exp) { ?>																
                                                            <tr class="s_nr">
																<td><?php echo $exp['catalogueno']; ?></td>
                                                                <td><?php echo $exp['itemCategory']; ?></td>
                                                                <td><?php echo $exp['itemDescription']; ?></td>
																<td><?php echo $exp['dam_catalogueno']; ?></td>																
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

                                                        </div>
                                                        <?php
//include('sidebar.php');
                                                        include '../view/footer.php';
                                                        ?>